<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('status');

        $blog = Blog::orderBy('id','desc')->paginate(25);
        if(!empty($query)){
            if($query==='published'){
                $blog = Blog::orderBy('id','desc')->where('status', true)->paginate(25);
            }
            if($query==='unpublished'){
                $blog = Blog::orderBy('id','desc')->where('status', false)->paginate(25);
            }
        }

        return view('admin.pages.blog.index')->with('blogs', $blog);
    }

    public function create()
    {
        return view('admin.pages.blog.create')
            ->with('categories', Content::get());
    }

    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->status = false;

        $request->validate([
            'detail' => 'required',
            'slug' => 'required|unique:blogs',
            'category_id' => 'required',
            'banner' => 'required',
            'title' => 'required',
            'desc' => 'required',
        ]);

        $banner = "";
        if ($request->hasFile('banner')) {

            $allowedfileExtension = ['jpg', 'png', 'bmp', 'jpeg'];

            $photo = $request->file('banner');

//            $filename = $photo->getClientOriginalName();


            $extension = $photo->getClientOriginalExtension();

            $extension = strtolower($extension);

            $size = $photo->getSize();

            if ($size > 600000) {
                return back()->withErrors(array('message'=>"This passport is too large. Compress and try again"))->withInput($request->input());
            }

            $time = Carbon::now();

            $check = in_array(strtolower($extension), $allowedfileExtension);

            $filename = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

            if ($check) {

                $directory = 'data/blog/img/' . date_format($time, 'Y') . '/' . date_format($time, 'm');
                $banner = $directory . '/' . $filename;

                $photo->storeAs($directory, $filename, 'public');

//              release memory... lol
//              ini_set('memory_limit', $limit);

            } else {

                return back()->withErrors(array('message' => 'Your passport must be of types : jpeg,bmp,png,jpg.'))->withInput($request->input());

            }
        }

        $blog->banner = $banner;
        $blog->slug = str_replace(' ', '-', $request->input('slug'));
        $blog->title = $request->input('title');
        $blog->desc = $request->input('desc');
        $blog->detail = $request->input('detail');
        $blog->category_id = $request->input('category_id');
        $blog->tags = $request->input('tags');
        $blog->keywords = $request->input('keywords');
        $blog->user_id = $request->input('user_id');
        $blog->hits = 0;
        $blog->save();

        return redirect(route('blog.index'))->withMessage('New Unpublished Article Post Created Successfully.');
    }

    public function show(Blog $blog)
    {
        if(!empty($blog)){
            return view('admin.pages.blog.show')
                ->with('categories', Category::all())
                ->with('blog', $blog)
                ->with('person', Auth::user());
        }else{
            return back();
        }
    }

    public function edit(Blog $blog)
    {
        if(!empty($blog)){
            return view('admin.pages.blog.edit')
                ->with('blog', $blog)
                ->with('categories', Content::get());
        }
        return back();

    }

    public function toggle(Blog $blog){
        if(!empty($blog)){
            $msg = "";
            if($blog->status){
                $blog->status = false;
                $msg = "Blog - $blog->title Unpublished";
            }else{
                $blog->status = true;
                $msg = "Blog - $blog->title Published";
            }
            $blog->update();
            return back()->withMessage($msg);
        }
        return back();
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->all();

        $request->validate([
            'detail' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'tags' => 'required',
        ]);

        if ($request->hasFile('banner')) {

            $allowedfileExtension = ['jpg', 'png', 'bmp', 'jpeg'];

            $photo = $request->file('banner');

//            $filename = $photo->getClientOriginalName();


            $extension = $photo->getClientOriginalExtension();

            $extension = strtolower($extension);

            $size = $photo->getSize();

            if ($size > 600000) {
                return back()->withErrors(array('message'=>"This passport is too large. Compress and try again"))->withInput($request->input());
            }

            $time = Carbon::now();

            $check = in_array(strtolower($extension), $allowedfileExtension);

            $filename = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

            if ($check) {

                $directory = 'data/blog/img/' . date_format($time, 'Y') . '/' . date_format($time, 'm');
                $data['banner'] = $directory . '/' . $filename;

                $photo->storeAs($directory, $filename, 'public');

//              release memory... lol
//              ini_set('memory_limit', $limit);

            } else {

                return back()->withErrors(array('message' => 'Your passport must be of types : jpeg,bmp,png,jpg.'))->withInput($request->input());

            }
        }

        if($blog->update($data)){
            return back()->withMessage('Article Updated.');
        }else{
            return back()->withErrors(array('message'=>'Unable to Complete. Try again later'))->withInput($request->input());
        }
    }

    public function destroy(Blog $blog)
    {
        if(count($blog)>0){
            if($blog->delete()){
                return back()->withMessage('Blog List Updated');
            }else{
                return back();
            }
        }else{
            return back();
        }
    }

    public function unpublish(Blog $blog){
        $data['status'] = false;
        if(Auth::user()->who >= 3){
            if($blog->update($data)){
                return back()->withMessage('Article Un-Published');
            }else{
                return back()->withMessage('Article Could Not Be Un-Published');
            }
        }else{
            return back()->withMessage('Article Could Not Be Un-Published');
        }

    }

    public function publish(Blog $blog){
        $data['status'] = true;
        if(Auth::user()->who >= 3){
            if($blog->update($data)){
                return back()->withMessage('Article Published');
            }else{
                return back()->withMessage('Article Could Not Be Published');
            }
        }else{
            return back()->withMessage('Article Could Not Be Published');
        }

    }
}
