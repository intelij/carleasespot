<?php
$this->get('/resendmail', 'Auth\RegisterController@resend_mail')->name('resend.mail');
$this->get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
$this->group(['namespace' => 'Frontend'], function () {
    $this->get('/', 'IndexController@index')->name('home');
    $this->resource('users', 'UserController');

    $this->get('/lease/{id}', 'ListingController@get_lease')->name('lease');
    $this->get('/buy/{id}', 'ListingController@get_buy')->name('buy');
    $this->post('/lease', 'ListingController@post_lease')->name('post_lease');
    $this->post('/newslettersignup', 'NewsletterSignupController@store')->name('newslettersignup');
    $this->get('/listing/{id}', 'ListingController@show')->name('listings.show');
     $this->get('profile/{id}', 'UserController@get_profile')->name('get_profile');
     $this->get('/review/{id}', 'ListingController@get_review')->name('get_review');
	 $this->post('/review', 'ListingController@post_review')->name('post_review');
     $this->post('/excel_upload', 'ListingController@upload_excel');
$this->post('list_favorite', 'ListingController@list_favorite')->name('list_favorite');
    $this->group(['middleware' => 'auth'], function () {
        $this->get('/profile', 'UserController@profile')->name('profile');
        $this->get('/update_profile', 'UserController@get_update_profile')->name('update_profile');
        $this->resource('listings', 'ListingController', array('except' => array('show','get_states','getmodel')));
        $this->get('getmodel/{make}', 'ListingController@getmodel')->name('getmodel');
        $this->resource('inquiries', 'InquiryController');
        $this->get('get_states/{data}', 'ListingController@get_states')->name('get_states');
        $this->get('dealer_featured_listings', 'ListingController@dealer_featured_listings')->name('listings.dealer_featured_listings');
        $this->get('dealer_inactive_listings', 'ListingController@dealer_inactive_listings')->name('listings.dealer_inactive_listings');
        $this->get('dealer_inquiries', 'InquiryController@dealer_inquiries')->name('dealer_inquiries');
    });
});
$this->group(['namespace' => 'Backend', 'prefix' => 'admin'], function () {
    $this->get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    $this->post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    $this->post('logout', 'Auth\AdminLoginController@postLogout')->name('admin.logout');
    $this->post('make_models', 'VehicleMakeController@make_models')->name('make_models');

    $this->post('model_trims', 'VehicleMakeController@model_trims')->name('model_trims');

    //Get Make information from edmunds and update it
    $this->post('update_makes', 'VehicleMakeController@update_makes')->name('update_makes');

    //Get Model information from edmunds and update it
    $this->post('update_models', 'VehicleModelController@update_models')->name('update_models');

    //Get Trim and Car Features information from edmunds and update it
    $this->post('update_trims', 'VehicleTrimController@update_trims')->name('update_trims');

    //Get Trim and Car Features information from edmunds and update it
    $this->post('update_trim_name', 'VehicleTrimController@update_trim_name')->name('update_trim_name');

    $this->group(['middleware' => 'admin'], function (){
        $this->get('/', 'DashboardController@index')->name('admin.dashboard');
        $this->resource('dealers', 'DealerController',['names' => 'admin.dealers']);
 $this->post('top_dealers', 'DealerController@top_dealers')->name('top_dealers');
$this->get('newdealers', 'DealerController@newdealers')->name('admin.newdealers');
$this->get('admin/dealers/activate/{id}', 'DealerController@activate')->name('admin.dealers.activate');
$this->get('admin/dealers/deactivate/{id}', 'DealerController@deactivate')->name('admin.dealers.deactivate');
$this->resource('customers', 'CustomerController',['names' => 'admin.customers']);
$this->get('admin/customers/activate/{id}', 'CustomerController@activate')->name('admin.customers.activate');
$this->get('newcustomers', 'CustomerController@newcustomers')->name('admin.newcustomers');
        $this->resource('makes', 'VehicleMakeController',['names' => 'admin.makes']);
        $this->resource('models', 'VehicleModelController',['names' => 'admin.models']);
        $this->post('models/store_image', 'VehicleModelController@store_image')->name('admin.models.store_image');
        $this->resource('trims', 'VehicleTrimController',['names' => 'admin.trims']);
        $this->get('trims/detail/{id}', 'VehicleTrimController@detail')->name('admin.trims.detail');
        $this->get('trims/upload/{id}', 'VehicleTrimController@upload_image')->name('admin.trims.upload');
        $this->any('trims/store_image/{id}', 'VehicleTrimController@store_image')->name('admin.trims.upload_image');
        $this->resource('listings', 'ListingController',['names' => 'admin.listings']);
        $this->get('get_list', 'ListingController@getList');
        $this->resource('inquiries', 'InquiryController',['names' => 'admin.inquiries']);
        $this->resource('newsletter_signups', 'NewsletterSignupController',['names' => 'admin.newsletter_signups']);
        $this->resource('car_images', 'CarImageController',['names' => 'admin.car_images']);
        $this->get('terms', 'TermsController@index',['names' => 'admin.terms']);
 $this->get('terms/create', 'TermsController@create')->name('admin.terms.create');
  $this->post('terms/create', 'TermsController@store');
 $this->get('terms/create/{id}', 'TermsController@edit')->name('admin.terms.edit');
 $this->post('terms/create/{id}', 'TermsController@update');
 $this->get('terms/delete/{id}', 'TermsController@destroy')->name('admin.terms.destroy');
 $this->get('terms/archive', 'TermsController@archive')->name('admin.terms.archive');
 $this->get('policies', 'PoliciesController@index',['names' => 'admin.policies']);
 $this->get('policies/create', 'PoliciesController@create')->name('admin.policies.create');
  $this->post('policies/create', 'PoliciesController@store');
 $this->get('policies/create/{id}', 'PoliciesController@edit')->name('admin.policies.edit');
 $this->post('policies/create/{id}', 'PoliciesController@update');
 $this->get('policies/delete/{id}', 'PoliciesController@destroy')->name('admin.policies.destroy');
 $this->get('policies/archive', 'PoliciesController@archive')->name('admin.policies.archive');
        $this->post('toggle_featured', 'ListingController@toggle_featured')->name('toggle_featured');
        $this->post('toggle_top', 'ListingController@toggle_top')->name('toggle_top');
        $this->post('toggle_status', 'ListingController@toggle_status')->name('toggle_status');
        $this->post('toggle_make', 'VehicleMakeController@toggle_make')->name('toggle_make');
        $this->post('toggle_model', 'VehicleModelController@toggle_model')->name('toggle_model');
         $this->get('inquiry/archive', 'InquiryController@archive')->name('inquiry.archive');
 $this->get('inquiry/print/{id}', 'InquiryController@print')->name('inquiry.print');
		$this->post('addarchive', 'InquiryController@addarchive')->name('addarchive');

        $this->get('profile', 'AdminController@get_profile')->name('admin_profile');
        $this->post('profile', 'AdminController@post_profile')->name('update_admin_profile');
        $this->post('reorder_images', 'CarImageController@reorder_images')->name('reorder_images');
        $this->resource('upload_excel', 'ExcelController',['names' => 'admin.upload_excel']);
        $this->post('postExcel','ExcelController@upload');
    });
});
$this->get('/customerverify/{code}', 'Customer\RegisterController@activateUser')->name('activate.customer');
$this->group(['namespace' => 'Customer', 'prefix' => 'customer'], function () {
    $this->get('login', 'LoginController@showLoginForm')->name('customer.login');
	  $this->post('login', 'LoginController@login')->name('customer.postlogin');
	$this->get('register', 'RegisterController@signup')->name('customer.signup');
    $this->post('register', 'RegisterController@register')->name('customer.register');
    $this->post('logout', 'LoginController@postLogout')->name('admin.logout');
 $this->get('/', 'CustomerController@profile')->name('customer.profile');
	   $this->get('update_profile', 'CustomerController@get_update_profile')->name('customer.update_profile');
	   $this->get('show_profile/{user}', 'CustomerController@get_update_profile')->name('customer.show');
	   $this->get('get_update_profile', 'CustomerController@get_update_profile')->name('customer.get_update_profile');
	    $this->post('update_profile', 'CustomerController@update')->name('customer.update_profile');
		 $this->get('show_fav', 'CustomerController@favorites')->name('customer.favorites');

});
Route::get('/listings_common', function () {
    return view('frontend.listings.listings_common');
})->name('listings_common');

/*Route::get('/index', function () {
    return view('index');
});*/

Route::get('/aboutus', function () {
    return view('frontend.about.index');
});
// Route::get('/comparison', function () {
//     return view('frontend.comparison.index');
// });

Route::get('/comparison', 'GeneralController@comparison');
Route::get('/detail', 'GeneralController@detail');
Route::get('/terms', 'GeneralController@terms');
Route::get('/policies', 'GeneralController@policies');
Route::get('/login', function () {
    return view('login');
});
Route::get('/make/{id}', 'GeneralController@modelShow')->name('frontend.make');
Route::get('/model/{id}/{type?}', 'GeneralController@trimShow')->name('frontend.model');
Route::get('/carType/{id}', 'GeneralController@modelwithCarType')->name('frontend.carType');
/* Route::get('/register', function () {
    return view('register');
}); */
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/reviewdetails', function () {
    return view('frontend.reviews.details');
});
Route::get('/reviews', function () {
    return view('frontend.reviews.index');
});
Route::get('/search', 'GeneralController@search');

Route::get('/search2', function () {
    return view('search2');
});
Route::get('/sellyourcar', function () {
    return view('sellyourcar');
});
Route::get('/howworks', function () {
    return view('frontend.howworks.index');
});

Auth::routes();
Route::get('register', 'Auth\RegisterController@signup')->name('register');
//Route::post('register', 'Auth\RegisterController@register')->middleware('auth');

