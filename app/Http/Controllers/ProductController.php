<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\ColorSet;
use App\Models\Maker;
use App\Models\Product;
use App\Models\Size;
use App\Models\SizeSet;
use App\Traits\General\Utility;
use App\Traits\General\Uuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends MyController
{
    use Uuid;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->where('active', true)->paginate(25);
        return view('admin.pages.product.index')
            ->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $uuid = (string)Str::uuid();
        return view('admin.pages.product.create')
            ->with([
                'uuid' => $uuid,
                'makers' => Maker::get(),
                'categories' => Category::select(['uuid','name'])->get(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate fields

        $product = new Product();


        if($request->input('is_new') === 'on'){
            $product->is_new = true;
        }

        $product->old_price = $request->input('old_price');
        if(!is_numeric($request->input('old_price'))){
            $product->old_price = null;
        }

        $product->uuid = $request->input('uuid');
        $product->active = true;

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->maker_id = $request->input('maker_id');

        $product->details = $request->input('details');
        $product->view_count = 0;

        if($product->save()){
            return redirect(route('product.index'))->withMessage('New Product Added.');
        }else{
            return back()->withErrors(array('error'=>'Unable to Complete! Try again.'))->withInput($request->input());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if(!empty($product)){
            return view('admin.pages.product.show')
                ->with(['product'=> $product,'makers'=> Maker::get(), 'categories'=> Category::all() ]);
        }else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if(!empty($product)){
            return view('admin.pages.product.edit')
                ->with('product', $product)
                ->with('makers', Maker::get())
                ->with('categories', Category::all());
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if(!empty($product)){

            $data = $request->all();

            if($request->input('isnew') === 'on'){
                $data['is_new'] = true;
            }else{
                $data['is_new'] = false;
            }

            if ($request->hasFile('pic1')) {

                $allowedfileExtension = ['jpg', 'png', 'bmp', 'jpeg'];

                $photo = $request->file('pic1');

//            $filename = $photo->getClientOriginalName();


                $extension = $photo->getClientOriginalExtension();

                $extension = strtolower($extension);

                $size = $photo->getSize();

//            return $size;

                if ($size > 600000) {
                    return back()->withErrors(array('message'=>"This passport is too large. Compress and try again"))->withInput($request->input());
                }

                $time = Carbon::now();

                $check = in_array(strtolower($extension), $allowedfileExtension);

                $filename = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

                if ($check) {

                    $directory = 'data/product/' . date_format($time, 'Y') . '/' . date_format($time, 'm');
                    $data['pic1'] = $directory . '/' . $filename;

                    $photo->storeAs($directory, $filename, 'public');

                    if(!empty($product->pic1)){
//                    @unlink(public_path($teacher->passport))
                        if(file_exists($product->pic1)){
                            unlink($product->pic1);
                        }
                    }

//              release memory... lol
//              ini_set('memory_limit', $limit);

                } else {

                    return back()->withErrors(array('message' => 'Your passport must be of types : jpeg,bmp,png,jpg.'))->withInput($request->input());

                }
            }
            if ($request->hasFile('pic2')) {

                $allowedfileExtension = ['jpg', 'png', 'bmp', 'jpeg'];

                $photo = $request->file('pic2');

//            $filename = $photo->getClientOriginalName();


                $extension = $photo->getClientOriginalExtension();

                $extension = strtolower($extension);

                $size = $photo->getSize();

//            return $size;

                if ($size > 600000) {
                    return back()->withErrors(array('message'=>"This passport is too large. Compress and try again"))->withInput($request->input());
                }

                $time = Carbon::now();

                $check = in_array(strtolower($extension), $allowedfileExtension);

                $filename = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

                if ($check) {

                    $directory = 'data/product/' . date_format($time, 'Y') . '/' . date_format($time, 'm');
                    $data['pic2'] = $directory . '/' . $filename;

                    $photo->storeAs($directory, $filename, 'public');

                    if(!empty($product->pic2)){
//                    @unlink(public_path($teacher->passport))
                        if(file_exists($product->pic2)){
                            unlink($product->pic2);
                        }
                    }

//              release memory... lol
//              ini_set('memory_limit', $limit);

                } else {

                    return back()->withErrors(array('message' => 'Your passport must be of types : jpeg,bmp,png,jpg.'))->withInput($request->input());

                }
            }
            if ($request->hasFile('pic3')) {

                $allowedfileExtension = ['jpg', 'png', 'bmp', 'jpeg'];

                $photo = $request->file('pic3');

//            $filename = $photo->getClientOriginalName();


                $extension = $photo->getClientOriginalExtension();

                $extension = strtolower($extension);

                $size = $photo->getSize();

//            return $size;

                if ($size > 600000) {
                    return back()->withErrors(array('message'=>"This passport is too large. Compress and try again"))->withInput($request->input());
                }

                $time = Carbon::now();

                $check = in_array(strtolower($extension), $allowedfileExtension);

                $filename = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

                if ($check) {

                    $directory = 'data/product/' . date_format($time, 'Y') . '/' . date_format($time, 'm');
                    $data['pic3'] = $directory . '/' . $filename;

                    $photo->storeAs($directory, $filename, 'public');

                    if(!empty($product->pic3)){
//                    @unlink(public_path($teacher->passport))
                        if(file_exists($product->pic3)){
                            unlink($product->pic3);
                        }
                    }

//              release memory... lol
//              ini_set('memory_limit', $limit);

                } else {

                    return back()->withErrors(array('message' => 'Your passport must be of types : jpeg,bmp,png,jpg.'))->withInput($request->input());

                }
            }

            if($product->update($data)){
                return back()->withMessage('Update Successful');
            }else{
                return back()->withErrors(array('error'=>'Unable to complete'));
            }

        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


    public function disable(Product $product){
        if(!empty($product)){
            $data['active'] = false;
            if($product->update($data)){
                return back()->withMessage('Product Disabled');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }

    public function pop($uuid){
        $product = Product::where('uuid', $uuid)->first();
        if(!empty($product)){
            $msg = "Item - $product->name - Removed";
            $product->active = false;
            $product->update();
            return redirect()->route('product.index')->withMessage($msg);

        }

        return back()->withErrors(['Resource not found']);
    }

    public function enable(Product $product){
        if(!empty($product)){
            $data['active'] = true;
            if($product->update($data)){
                return back()->withMessage('Product Enabled');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }

    public function feature(Product $product){
        if(!empty($product)){
            $data['featured'] = false;
            if($product->update($data)){
                return back()->withMessage('Product is no longer featured.');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }

    public function defeature(Product $product){
        if(!empty($product)){
            $data['featured'] = true;
            if($product->update($data)){
                return back()->withMessage('Product is now featured.');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }

    public function addToCart(Request $request, $uuid){
        $qty = $request->input('item_qty');
        if(empty($qty)){
            $qty = 1;
        }
        if(!empty($uuid)){
            $product = Product::where('uuid', $uuid)->where('active', true)->first();
            $key = "my_cart_list";

            if(!empty($product)){
                //check if empty
                $cartItems = $request->session()->get($key);
                $store = true;
                if(!empty($cartItems)){
                    //check if already exist
                    foreach ($cartItems as $item){
                        if($item['uuid']===$uuid){
                            $store = false;
                        }
                    }
                    if($store){
                        $request->session()->push($key, [
                            'uuid'=>$product->uuid,
                            'price'=>floatval($product->price),
                            'total_price'=>$qty*floatval($product->price),
                            'qty'=>$qty,
                            'img'=>$product->onePic,
                            'name'=>$product->name,
                            'details'=>$product->details,
                        ]);
                    }

                }else{
                    $request->session()->put($key, [
                        [
                            'uuid'=>$product->uuid,
                            'price'=>floatval($product->price),
                            'total_price'=>$qty*floatval($product->price),
                            'qty'=>$qty,
                            'img'=>$product->onePic,
                            'name'=>$product->name,
                            'details'=>$product->details,
                        ]
                    ]);
                }

                if($store){
                    return [
                        'success'=>true,
                        'product'=>[
                            'uuid'=>$product->uuid,
                            'remove_url'=>route('cart.remove', $product->uuid),
                            'img_url'=>url($product->onePic),
                            'name'=>$product->name,
                            'details'=>$product->details,
                            'price'=>floatval($product->price),
                            'total_price'=>$qty*floatval($product->price),
                            'qty'=>$qty,
                            'total_items'=>count($request->session()->get($key))
                        ]
                    ];
                }


            }

        }

    }

    public function removeFromCart(Request $request, $uuid){
        if(!empty($uuid)) {
            $product = Product::where('uuid', $uuid)->where('active', true)->first();
            $key = "my_cart_list";

            if(!empty($product)){
                //check if empty
                $cartItems = $request->session()->get($key);
                $remove = false;
                $qty = null;
                $updated = array();
                if(!empty($cartItems)){
                    //check if already exist

                    foreach ($cartItems as $pos=>$item){
                        if($item['uuid']===$uuid){
                            $remove = true;
                            //delete from position
                            $qty = $item['qty'];

                        }else{
                            array_push($updated, $item);
                        }
                    }

                    $request->session()->put($key, $updated);

                    if($remove){
                        return [
                            'success'=>true,
                            'product'=>[
                                'uuid'=>$product->uuid,
                                'remove_url'=>route('cart.remove', $product->uuid),
                                'img_url'=>url($product->getpic1()),
                                'name'=>$product->name,
                                'details'=>$product->details,
                                'price'=>floatval($product->price),
                                'total_price'=>$qty*floatval($product->price),
                                'qty'=>$qty,
                                'total_items'=>count($updated)
                            ]
                        ];
                    }

                }
            }

        }
    }

    public function updateCartItem(Request $request, $uuid, $flow){
        if(!empty($uuid)) {
            $product = Product::where('uuid', $uuid)->where('active', true)->first();
            $key = "my_cart_list";

            if(!empty($product)){
                //check if empty
                $cartItems = $request->session()->get($key);
                $update = false;
                $updated = array();
                $subtotal = 0;
                $cur_qty = 0;
                if(!empty($cartItems)){
                    //check if already exist

                    foreach ($cartItems as $pos=>$item){
                        if($item['uuid']===$uuid){
                            $update = true;
                            //delete from position
                            $qty = intval($item['qty']);
                            if($flow==='plus'){
                                $qty++;
                            }else{
                                if($qty!==1){
                                    $qty--;
                                }
                            }
                            $item['qty'] = $qty;
                            $cur_qty = $qty;
                            $item['total_price'] = $qty*floatval($product->price);
                        }

                        $subtotal += floatval($item['total_price']);

                        array_push($updated, $item);
                    }

                    if($update){
                        //update cart
                        $request->session()->put($key, $updated);


                        return [
                            'success'=>true,
                            'product'=>[
                                'uuid'=>$product->uuid,
                                'remove_url'=>route('cart.remove', $product->uuid),
                                'img_url'=>url($product->getpic1()),
                                'name'=>$product->name,
                                'details'=>$product->details,
                                'price'=>floatval($product->price),
                                'total_price'=>$cur_qty*floatval($product->price),
                                'qty'=>$cur_qty,
                                'total_items'=>count($updated),
                                'cart_subtotal'=>$subtotal
                            ]
                        ];
                    }

                }
            }

        }
    }

    public function flushSession(Request $request){
        $key = "my_cart_list";

        $request->session()->forget($key);


        return $request->session()->get('my_cart_list');
    }

    public function testSession(Request $request){
        return $request->session()->get('my_cart_list');
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');
        if(empty($keyword)){
            return redirect()->route('view.products');
        }
        $products = Product::orderBy('view_count','desc')
            ->where('active', true)
            ->where('details', 'like', "%".$keyword."%")
            ->orWhere('name', 'like', "%".$keyword."%")
            ->orWhere('price', 'like', "%".$keyword."%")
            ->orWhereHas('category', function (Builder $builder) use ($keyword) {
                $builder->where('name', 'like', "%".$keyword."%");})
            ->orWhereHas('producer', function (Builder $builder) use ($keyword) {
                $builder->where('name', 'like', "%".$keyword."%");})
            ->get();

        $shown = "Search results for $keyword";

        $recents = Product::orderBy('created_at', 'desc')->where('active', true)->take(3)->get();
        $makers = Maker::where('active', true)->get();
        return view('pages.product.index')
            ->with('recents', $recents)
            ->with('makers', $makers)
            ->with('keyword', $keyword)
            ->with('shown', $shown)
            ->with('products', $products);
    }

    public function addAttribute(Request $request, $uuid){

        //check logic
        $product = Product::where('uuid', $uuid)->first();
        if(empty($product)){
            return back()->withErrors(['Unable to complete']);
        }
        $type = $request->input('type');
        if(empty($type)){
            return back()->withErrors(['Unable to complete']);
        }

        if($type==='size'){

            $size = new Size();
            $size->uuid = $this->setUuid();
            $size->name = $request->input('a_title');
            $size->measure = $request->input('a_value');
            $size->save();

            $size_set = new SizeSet();
            $size_set->uuid = $this->setUuid();
            $size_set->size_id = $size->uuid;
            $size_set->product_id = $product->uuid;
            $size_set->qty = 0; //set number of quantity available
            $size_set->current = true;
            $size_set->save();

            return back()->withMessage(ucwords($type). " attribute added to ". $product->name);
        }elseif ($type==='color'){

            $color = new Color();
            $color->uuid = $this->setUuid();
            $color->name = $request->input('a_title');
            $color->result = $request->input('a_color');
            $color->save();

            $color_set = new ColorSet();
            $color_set->uuid = $this->setUuid();
            $color_set->color_id = $color->uuid;
            $color_set->product_id = $product->uuid;
            $color_set->qty = 0;
            $color_set->current = true;
            $color_set->save();

            return back()->withMessage(ucwords($type). " attribute added to ". $product->name);
        }else{
            return back()->withErrors(['Unable to complete']);
        }

        //business logic



    }
}
