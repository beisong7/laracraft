<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Content;
use App\Models\Maker;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $length = Category::where('active', true)->select(['id'])->get()->count();
        $blogs = Blog::orderBy('id','desc')->where('status', true)->take(3)->get();
        $trends = Product::orderBy('view_count','desc')->where('active', true)->take(8)->get();
        $latest = Product::orderBy('id','desc')->where('active', true)->take(8)->get();
        $sliders = Slider::where('active', true)->inRandomOrder()->take(4)->get();
        return view('pages.home.index')
            ->with(
                [
                    'blogs'=>$blogs,
                    'sliders'=>$sliders,
                    'length'=>$length,
                    'trends'=>$trends,
                    'latest'=>$latest
                ]
            );
    }

    public function contact_us(){
        return view('pages.contact.index');
    }

    public  function blogTagView($tag){
        $blogs = Blog::where('status', true)
            ->where('tags', 'like', "%".$tag."%")
            ->paginate(20);

            $contents = Content::where('active', true)->get();
            $recent = Blog::orderBy('created_at', 'desc')->where('status', true)->take(3)->get();
            return view('pages.blog.index')
                ->with('paginated', 'yes')
                ->with('extra', "tags - $tag")
                ->with('recents', $recent)
                ->with('contents', $contents)
                ->with('blogs', $blogs);


    }

    public function blogs(){
        $blogs = Blog::where('status', true)->paginate(20);
            $contents = Content::where('active', true)->get();
            $recent = Blog::orderBy('created_at', 'desc')->where('status', true)->take(3)->get();
            return view('pages.blog.index')
                ->with('paginated', 'yes')
                ->with('recents', $recent)
                ->with('contents', $contents)
                ->with('blogs', $blogs);


    }

    public function products(Request $request){


        $catName = $request->input('category');
        $prodName = $request->input('maker');
        $latest = $request->input('latest');
        $shown = null;
        if(!empty($catName)){
            $products = Product::orderBy('view_count','desc')->whereHas('category', function (Builder $builder) use ($catName) {
                $builder->where('name', $catName);
            })->where('active', true)->paginate(20);
            $shown = $catName;

        }elseif (!empty($prodName)){
            $products = Product::orderBy('view_count','desc')->whereHas('producer', function (Builder $builder) use ($prodName) {
                $builder->where('name', $prodName);
            })->where('active', true)->paginate(20);
            $shown = "Manufacturer | $prodName";
        }elseif (!empty($latest)){
            $products = Product::orderBy('id','desc')->where('active', true)->paginate(20);
            $shown = "New Arrivals";
        }
        else{
            $products = Product::orderBy('view_count','desc')->where('active', true)->paginate(20);
            $shown = "All Categories";
        }



        $recents = Product::orderBy('created_at', 'desc')->where('active', true)->take(3)->get();
        $makers = Maker::where('active', true)->get();

        return view('pages.product.index')
            ->with('recents', $recents)
            ->with('makers', $makers)
            ->with('shown', $shown)
            ->with('products', $products);
    }

    public function productShow($uuid){
        $product = Product::where('uuid', $uuid)->where('active', true)->first();
        if(!empty($product)){
            //increase count
            $product->view_count = !empty($product->view_count)?$product->view_count+1:1;
            $product->update();
            return view('pages.product.show')->with('product', $product);
        }
        return back()->withErrors(['Item not found']);
    }

    public function news_subscribe(Request $request){
        $email = $request->input('email');

        $exist = Subscriber::where('email', $email)->first();
        if(empty($exist)){
            $subscribe = new Subscriber();
            $subscribe->email = $email;
            $subscribe->status = true;
            $subscribe->save();

        }
        return ['success'=>true];
    }

    public function blogsView(Request $request, $slug){
        $blog = Blog::where('status', true)->where('slug', $slug)->first();
        if(!empty($blog)){
            $contents = Content::where('active', true)->get();
            $recent = Blog::orderBy('created_at', 'desc')->where('status', true)->take(3)->get();
            $blog->hits = $blog->hits + 1;
            $blog->update();
            return view('pages.blog.show')
                ->with('recents', $recent)
                ->with('contents', $contents)
                ->with('blog', $blog);
        }
        return redirect()->route('blog');
    }

    public function login(Request $request){
        if(Auth::guard('customer')->check()){
           return redirect()->route('home');
        }
        return view('pages.auth.login');
    }

    public function register(Request $request){
        if(Auth::guard('customer')->check()){
           return redirect()->route('home');
        }
        return view('pages.auth.register');
    }

    public function review(Request $request, $uuid){
        $product = Product::where('uuid', $uuid)->where('active', true)->first();
        if(!empty($product)){

            $encrypt = $request->input('summed');
            if(!empty($encrypt)){
                $verify = $request->input('verify');
                try{
                    $encrypt = decrypt($encrypt);
                }catch (\Exception $e){

                }

                if(intval($encrypt)===intval($verify)){
                    $review = new Review();
                    $review->active = false;
                    $review->uuid = uniqid('Rv', false);
                    $review->product_key = $product->uuid;
                    $review->email = $request->input('email');
                    if(Auth::guard('customer')->check()){
                        $review->customer_id = Auth::guard('customer')->user()->uuid;
                    }
                    $review->name = $request->input('name');
                    $review->info = $request->input('info');
                    $review->time = time();
                    $review->flags = 0;
                    $review->save();

                    @mail(env('SITE_EMAIL', ''), 'New Review', "A new product review has been sent by ".$review->email.". Kindly attend to it and activate it");
                }
            }

            return back()->withMessage('Your review has been Added');

        }

        return back()->withErrors(['No Product Selected'])->withInput($request->input());

    }
}
