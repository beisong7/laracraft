<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>'admin'], function () {

    Route::prefix('cms')->group(function () {

        Route::get('dashboard', 'ConsoleController@dashboard')->name('cms.dashboard');


        Route::resource('mfr', 'MakerController');
        Route::resource('product', 'ProductController');

        Route::resource('page', 'PageController');
        Route::get('page/{uuid}/publish', 'PageController@publish')->name('page.publish');
        Route::get('page/{uuid}/un-publish', 'PageController@unpublish')->name('page.unpublished');

        //product routes
        Route::get('product/{uuid}/pop', 'ProductController@pop')->name('product.pop');
        Route::post('product/add/attribute/{uuid}', 'ProductController@addAttribute')->name('product.add.attribute');

        //Blog routes
        Route::get('blog/{uuid}/pop', 'BlogController@pop')->name('blog.pop');
        Route::get('blog/{blog}/toggle', 'BlogController@toggle')->name('blog.toggle');
        Route::get('content/{uuid}/pop', 'ContentController@pop')->name('content.pop');
        Route::get('maker/{uuid}/pop', 'MakerController@pop')->name('maker.pop');

        Route::resource('category', 'CategoryController');
        Route::get('category/{uuid}/pop', 'CategoryController@pop')->name('category.pop');

        Route::resource('category_group', 'CategoryGroupController');
        Route::get('category_group/{uuid}/pop', 'CategoryGroupController@pop')->name('category_group.pop');

        Route::resource('content', 'ContentController');
//        Route::resource('partner', 'PartnerController');
        Route::resource('user', 'UserController');
        Route::resource('message', 'MessageController');
        Route::resource('booking', 'BookingController');
        Route::resource('blog', 'BlogController');
        Route::resource('maker', 'MakerController');

        Route::get('mfr/disable/{maker}', 'MakerController@disable')->name('mfr.disable');
        Route::get('mfr/enable/{maker}', 'MakerController@enable')->name('mfr.enable');

        Route::get('product/disable/{product}', 'ProductController@disable')->name('product.disable');
        Route::get('product/enable/{product}', 'ProductController@enable')->name('product.enable');

        Route::get('category/disable/{category}', 'CategoryController@disable')->name('category.disable');
        Route::get('category/enable/{category}', 'CategoryController@enable')->name('category.enable');

        Route::get('product/feature/{product}', 'ProductController@feature')->name('product.feature');
        Route::get('product/defeature/{product}', 'ProductController@defeature')->name('product.defeature');

        Route::post('post/img/store/{uuid}', 'ImageUploadController@uploadImages')->name('uploadStore');
        Route::post('post/img/delete/{uuid}', 'ImageUploadController@deleteImage')->name('uploadDelete');
        Route::get('modify/img/delete/{uuid}', 'ImageUploadController@popSingleImage')->name('upload-delete');


        Route::get('customers/list', 'CustomerController@listCustomers')->name('customer.list');
        Route::get('customers/toggle/{uuid}', 'CustomerController@toggleStatus')->name('customer.toggle_active');


        Route::get('review/index/{type}', 'ReviewController@index')->name('reviews.made');
        Route::get('review/toggle/{type}', 'ReviewController@toggle')->name('review.toggle');

        //=============================================
        Route::get('manage/sliders/index', 'SliderController@sliders')->name('slider.index');
        Route::get('manage/sliders/create', 'SliderController@create')->name('slider.new');
        Route::get('manage/sliders/show/{id}', 'SliderController@show')->name('slider.show');
        Route::get('manage/sliders/toggle/{id}', 'SliderController@toggle')->name('slider.toggle');
        Route::post('manage/sliders/store', 'SliderController@store')->name('slider.store');
        Route::post('manage/sliders/update/{id}', 'SliderController@update')->name('slider.update');

        Route::post('post/slider/store/{uuid}', 'SliderController@uploadImages')->name('uploadSlider');
        Route::post('post/slider/delete/{uuid}', 'SliderController@deleteImage')->name('sliderDelete');
        Route::get('modify/slider/delete/{uuid}', 'SliderController@popSingleImage')->name('slider-delete');
        //=============================================

    });
});


Route::group(['middleware'=>'monitor'], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('register', 'HomeController@register')->name('contact.signup');
    Route::get('/login', 'HomeController@login')->name('contact.entry');
    Route::post('/login', 'CustomerController@authenticate')->name('contact.login');
    Route::post('/register', 'CustomerController@register')->name('contact.register');
    Route::get('/activate/{token}', 'CustomerController@activate')->name('account.activate');

    Route::get('client/forgot/password', 'CustomerController@mailReset')->name('client.request_password'); //page to reset client password
    Route::post('client/reset_password', 'CustomerController@mailResetPass')->name('client.reset_password'); //page after sending mail

    Route::get('client/password/{email}/reset/{token}', 'CustomerController@PasswordReset')->name('client.reset_pass_page');
    Route::post('client/fix/lost/password/{secret}', 'CustomerController@resetAccForgotPass')->name('client.reset.pass');

    Route::get('/cms-admin', 'AdminController@signingin')->name('cms.signin');

    Route::get('forgot/password', 'AdminController@mailReset')->name('cms_reset_password'); //page to reset password
    Route::post('/reset_password', 'AdminController@mailResetPass')->name('reset_user_password'); //page after sending mail

    Route::get('password/{email}/reset/{token}', 'AdminController@PasswordReset')->name('update.password');
    Route::post('/fix/lost/password/{uuid}/{token}', 'AdminController@resetAccForgotPass')->name('reset.lost.pass');


    Route::post('/validate-cms-admin', 'AdminController@authenticate')->name('cms.login');
    Route::post('/stop-cms-admin', 'AdminController@logout')->name('cms.logout');
    Route::get('/customer-logout', 'CustomerActionController@customerLogout')->name('customer.logout');

    Route::post('newsletter', 'HomeController@news_subscribe')->name('subscribe');

    Route::get('/modal/productID/{pid}', 'HomeController@showmodal')->name('modal.show');
    Route::get('cart/add/{pid}', 'ProductController@addToCart')->name('cart.add');
    Route::get('cart/remove/{pid}', 'ProductController@removeFromCart')->name('cart.remove');
    Route::get('cart/update/qty/{pid}/{flow}', 'ProductController@updateCartItem')->name('cart.qty.update');

    //Preview order
    Route::post('cart/complete', 'CartController@store')->name('complete.order');

    //start Payment
    Route::get('/start-order-payment', function (){
        return redirect()->route('cart');
    });
    Route::post('start-order-payment', 'Payment\RaveController@initialize')->name('pay');
    //backend payment completion
//    Route::post('rave/callback', 'Payment\RaveController@callback')->name('callback');
    Route::get('rave/callback', 'Payment\RaveController@callback')->name('callback');


    Route::get('booking/payment', 'BookingController@startPayment')->name('payment.startup');

    Route::post('contact/submit', 'MessageController@contact_us')->name('contact.submit');
    Route::get('booking/preview/{book_uuid}', 'BookingController@preview')->name('view.order');

    Route::get('shopping-list', 'CartController@shopping_list')->name('cart');
    Route::post('shopping-order', 'CartController@shopping_order')->name('shopping.order');
    Route::get('s/page/{slug}', 'PageController@seepage')->name('see.page');



// find all user views below

    /**
     * ============================================================== *
     */
    Route::get('/product', 'HomeController@products')->name('view.products');
    Route::get('preview/product/{uuid}', 'HomeController@productShow')->name('preview.product');
    Route::post('review/product/{uuid}', 'HomeController@review')->name('review.product');
    Route::post('search/product', 'ProductController@search')->name('find.item');
    Route::get('/category/{uuid}', 'HomeController@category')->name('view.category');
//Route::get('/product', 'CategoryController@index')->name('view.products');
    Route::get('/products/{uuid}', 'HomeController@productName')->name('view.product');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/partners', 'HomeController@partners')->name('partners');
    Route::get('/topartner/{uuid}', 'HomeController@topartner')->name('topartner');
    Route::get('/resellers', 'HomeController@outlets')->name('resellers');
    Route::get('/manufacturers', 'HomeController@mfrs')->name('mfrs');
    Route::get('/skincenter', 'HomeController@skincenter')->name('skincenter');
    Route::get('/makequote', 'HomeController@makequote')->name('makequote');
    Route::post('/quote/store', 'HomeController@storeQuote')->name('quote.store');
    Route::get('/newsletter', 'HomeController@newsLetter')->name('newsletter');
    Route::get('/contact-us', 'HomeController@contact_us')->name('contact-us');
    Route::get('/blog', 'HomeController@blogs')->name('blog');
    Route::get('/blog/{slug}/view', 'HomeController@blogsView')->name('blog.view');
    Route::get('/tag/article/{tag}', 'HomeController@blogTagView')->name('article.tag');


    Route::prefix('customer')->group(function () {
        Route::get('account', 'CustomerActionController@account')->name('customer.account');
        Route::get('orders', 'CustomerActionController@orders')->name('customer.orders');
        Route::get('profile', 'CustomerActionController@profile')->name('customer.profile');
        Route::get('wish-list', 'CustomerActionController@myWishList')->name('customer.wishList');
        Route::post('add-to-wish-list/{prod_id}', 'CustomerActionController@addWish')->name('customer.addToWish');
        Route::get('remove-from-wish-list/{item_id}', 'CustomerActionController@popWish')->name('customer.pop_wish');

        Route::get('booking-drop/{item_id}', 'CustomerActionController@dropOrder')->name('customer.drop_order');
        Route::get('booking-view/{item_id}', 'CustomerActionController@viewOrder')->name('customer.view_order');

        Route::get('review-view', 'CustomerActionController@viewReview')->name('customer.reviews');
    });
});


Route::get('artisans/m/{name}', 'ArtisanController@migrate');
Route::get('artisans/db/{name}', 'ArtisanController@seed');

Route::get('my-session', 'ProductController@testSession');
Route::get('my-session/empty', 'ProductController@flushSession');







