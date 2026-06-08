<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('blogs/view/{rec_id}', 'BlogsController@view')->name('blogs.view');	
	Route::get('portfolios/view/{rec_id}', 'PortfoliosController@view')->name('portfolios.view');	
	Route::get('services/view/{rec_id}', 'ServicesController@view')->name('services.view');	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');

/**
 * All routes which requires auth
 */
Route::middleware(['auth'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Blogs Controller */
	Route::get('blogs', 'BlogsController@index')->name('blogs.index');
	Route::get('blogs/index/{filter?}/{filtervalue?}', 'BlogsController@index')->name('blogs.index');	
	Route::get('blogs/add', 'BlogsController@add')->name('blogs.add');
	Route::post('blogs/add', 'BlogsController@store')->name('blogs.store');
		
	Route::any('blogs/edit/{rec_id}', 'BlogsController@edit')->name('blogs.edit');	
	Route::get('blogs/delete/{rec_id}', 'BlogsController@delete');

/* routes for CompanyProfiles Controller */
	Route::get('companyprofiles', 'CompanyProfilesController@index')->name('companyprofiles.index');
	Route::get('companyprofiles/index/{filter?}/{filtervalue?}', 'CompanyProfilesController@index')->name('companyprofiles.index');	
	Route::get('companyprofiles/view/{rec_id}', 'CompanyProfilesController@view')->name('companyprofiles.view');
	Route::get('companyprofiles/masterdetail/{rec_id}', 'CompanyProfilesController@masterDetail')->name('companyprofiles.masterdetail');	
	Route::get('companyprofiles/add', 'CompanyProfilesController@add')->name('companyprofiles.add');
	Route::post('companyprofiles/add', 'CompanyProfilesController@store')->name('companyprofiles.store');
		
	Route::any('companyprofiles/edit/{rec_id}', 'CompanyProfilesController@edit')->name('companyprofiles.edit');	
	Route::get('companyprofiles/delete/{rec_id}', 'CompanyProfilesController@delete');

/* routes for ContactMessages Controller */
	Route::get('contactmessages', 'ContactMessagesController@index')->name('contactmessages.index');
	Route::get('contactmessages/index/{filter?}/{filtervalue?}', 'ContactMessagesController@index')->name('contactmessages.index');	
	Route::get('contactmessages/view/{rec_id}', 'ContactMessagesController@view')->name('contactmessages.view');	
	Route::get('contactmessages/add', 'ContactMessagesController@add')->name('contactmessages.add');
	Route::post('contactmessages/add', 'ContactMessagesController@store')->name('contactmessages.store');
		
	Route::any('contactmessages/edit/{rec_id}', 'ContactMessagesController@edit')->name('contactmessages.edit');	
	Route::get('contactmessages/delete/{rec_id}', 'ContactMessagesController@delete');

/* routes for Galleries Controller */
	Route::get('galleries', 'GalleriesController@index')->name('galleries.index');
	Route::get('galleries/index/{filter?}/{filtervalue?}', 'GalleriesController@index')->name('galleries.index');	
	Route::get('galleries/view/{rec_id}', 'GalleriesController@view')->name('galleries.view');	
	Route::get('galleries/add', 'GalleriesController@add')->name('galleries.add');
	Route::post('galleries/add', 'GalleriesController@store')->name('galleries.store');
		
	Route::any('galleries/edit/{rec_id}', 'GalleriesController@edit')->name('galleries.edit');	
	Route::get('galleries/delete/{rec_id}', 'GalleriesController@delete');

/* routes for GalleryCategories Controller */
	Route::get('gallerycategories', 'GalleryCategoriesController@index')->name('gallerycategories.index');
	Route::get('gallerycategories/index/{filter?}/{filtervalue?}', 'GalleryCategoriesController@index')->name('gallerycategories.index');	
	Route::get('gallerycategories/view/{rec_id}', 'GalleryCategoriesController@view')->name('gallerycategories.view');
	Route::get('gallerycategories/masterdetail/{rec_id}', 'GalleryCategoriesController@masterDetail')->name('gallerycategories.masterdetail');	
	Route::get('gallerycategories/add', 'GalleryCategoriesController@add')->name('gallerycategories.add');
	Route::post('gallerycategories/add', 'GalleryCategoriesController@store')->name('gallerycategories.store');
		
	Route::any('gallerycategories/edit/{rec_id}', 'GalleryCategoriesController@edit')->name('gallerycategories.edit');	
	Route::get('gallerycategories/delete/{rec_id}', 'GalleryCategoriesController@delete');

/* routes for HeroBanners Controller */
	Route::get('herobanners', 'HeroBannersController@index')->name('herobanners.index');
	Route::get('herobanners/index/{filter?}/{filtervalue?}', 'HeroBannersController@index')->name('herobanners.index');	
	Route::get('herobanners/view/{rec_id}', 'HeroBannersController@view')->name('herobanners.view');	
	Route::get('herobanners/add', 'HeroBannersController@add')->name('herobanners.add');
	Route::post('herobanners/add', 'HeroBannersController@store')->name('herobanners.store');
		
	Route::any('herobanners/edit/{rec_id}', 'HeroBannersController@edit')->name('herobanners.edit');	
	Route::get('herobanners/delete/{rec_id}', 'HeroBannersController@delete');

/* routes for PortfolioCategories Controller */
	Route::get('portfoliocategories', 'PortfolioCategoriesController@index')->name('portfoliocategories.index');
	Route::get('portfoliocategories/index/{filter?}/{filtervalue?}', 'PortfolioCategoriesController@index')->name('portfoliocategories.index');	
	Route::get('portfoliocategories/view/{rec_id}', 'PortfolioCategoriesController@view')->name('portfoliocategories.view');
	Route::get('portfoliocategories/masterdetail/{rec_id}', 'PortfolioCategoriesController@masterDetail')->name('portfoliocategories.masterdetail');	
	Route::get('portfoliocategories/add', 'PortfolioCategoriesController@add')->name('portfoliocategories.add');
	Route::post('portfoliocategories/add', 'PortfolioCategoriesController@store')->name('portfoliocategories.store');
		
	Route::any('portfoliocategories/edit/{rec_id}', 'PortfolioCategoriesController@edit')->name('portfoliocategories.edit');	
	Route::get('portfoliocategories/delete/{rec_id}', 'PortfolioCategoriesController@delete');

/* routes for Portfolios Controller */
	Route::get('portfolios', 'PortfoliosController@index')->name('portfolios.index');
	Route::get('portfolios/index/{filter?}/{filtervalue?}', 'PortfoliosController@index')->name('portfolios.index');	
	Route::get('portfolios/add', 'PortfoliosController@add')->name('portfolios.add');
	Route::post('portfolios/add', 'PortfoliosController@store')->name('portfolios.store');
		
	Route::any('portfolios/edit/{rec_id}', 'PortfoliosController@edit')->name('portfolios.edit');	
	Route::get('portfolios/delete/{rec_id}', 'PortfoliosController@delete');

/* routes for SeoSettings Controller */
	Route::get('seosettings', 'SeoSettingsController@index')->name('seosettings.index');
	Route::get('seosettings/index/{filter?}/{filtervalue?}', 'SeoSettingsController@index')->name('seosettings.index');	
	Route::get('seosettings/view/{rec_id}', 'SeoSettingsController@view')->name('seosettings.view');	
	Route::get('seosettings/add', 'SeoSettingsController@add')->name('seosettings.add');
	Route::post('seosettings/add', 'SeoSettingsController@store')->name('seosettings.store');
		
	Route::any('seosettings/edit/{rec_id}', 'SeoSettingsController@edit')->name('seosettings.edit');	
	Route::get('seosettings/delete/{rec_id}', 'SeoSettingsController@delete');

/* routes for Services Controller */
	Route::get('services', 'ServicesController@index')->name('services.index');
	Route::get('services/index/{filter?}/{filtervalue?}', 'ServicesController@index')->name('services.index');	
	Route::get('services/add', 'ServicesController@add')->name('services.add');
	Route::post('services/add', 'ServicesController@store')->name('services.store');
		
	Route::any('services/edit/{rec_id}', 'ServicesController@edit')->name('services.edit');	
	Route::get('services/delete/{rec_id}', 'ServicesController@delete');

/* routes for SocialMedias Controller */
	Route::get('socialmedias', 'SocialMediasController@index')->name('socialmedias.index');
	Route::get('socialmedias/index/{filter?}/{filtervalue?}', 'SocialMediasController@index')->name('socialmedias.index');	
	Route::get('socialmedias/view/{rec_id}', 'SocialMediasController@view')->name('socialmedias.view');	
	Route::get('socialmedias/add', 'SocialMediasController@add')->name('socialmedias.add');
	Route::post('socialmedias/add', 'SocialMediasController@store')->name('socialmedias.store');
		
	Route::any('socialmedias/edit/{rec_id}', 'SocialMediasController@edit')->name('socialmedias.edit');	
	Route::get('socialmedias/delete/{rec_id}', 'SocialMediasController@delete');

/* routes for Teams Controller */
	Route::get('teams', 'TeamsController@index')->name('teams.index');
	Route::get('teams/index/{filter?}/{filtervalue?}', 'TeamsController@index')->name('teams.index');	
	Route::get('teams/view/{rec_id}', 'TeamsController@view')->name('teams.view');	
	Route::get('teams/add', 'TeamsController@add')->name('teams.add');
	Route::post('teams/add', 'TeamsController@store')->name('teams.store');
		
	Route::any('teams/edit/{rec_id}', 'TeamsController@edit')->name('teams.edit');	
	Route::get('teams/delete/{rec_id}', 'TeamsController@delete');

/* routes for Testimonials Controller */
	Route::get('testimonials', 'TestimonialsController@index')->name('testimonials.index');
	Route::get('testimonials/index/{filter?}/{filtervalue?}', 'TestimonialsController@index')->name('testimonials.index');	
	Route::get('testimonials/view/{rec_id}', 'TestimonialsController@view')->name('testimonials.view');	
	Route::get('testimonials/add', 'TestimonialsController@add')->name('testimonials.add');
	Route::post('testimonials/add', 'TestimonialsController@store')->name('testimonials.store');
		
	Route::any('testimonials/edit/{rec_id}', 'TestimonialsController@edit')->name('testimonials.edit');	
	Route::get('testimonials/delete/{rec_id}', 'TestimonialsController@delete');

/* routes for Users Controller */
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index');	
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/add', 'UsersController@store')->name('users.store');
		
	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');	
	Route::get('users/delete/{rec_id}', 'UsersController@delete');

/* routes for WebsiteSettings Controller */
	Route::get('websitesettings', 'WebsiteSettingsController@index')->name('websitesettings.index');
	Route::get('websitesettings/index/{filter?}/{filtervalue?}', 'WebsiteSettingsController@index')->name('websitesettings.index');	
	Route::get('websitesettings/view/{rec_id}', 'WebsiteSettingsController@view')->name('websitesettings.view');	
	Route::get('websitesettings/add', 'WebsiteSettingsController@add')->name('websitesettings.add');
	Route::post('websitesettings/add', 'WebsiteSettingsController@store')->name('websitesettings.store');
		
	Route::any('websitesettings/edit/{rec_id}', 'WebsiteSettingsController@edit')->name('websitesettings.edit');	
	Route::get('websitesettings/delete/{rec_id}', 'WebsiteSettingsController@delete');	
Route::get('profiles',  function(Request $request){
		return view("pages.custom.profiles");
	}
);

});


	
Route::get('componentsdata/company_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->company_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/category_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->category_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/portfolios_category_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->portfolios_category_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_username_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_username_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_email_value_exist($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');

/* Public landing page routes for profiles */
Route::get('profiles', 'LandingController@index');
Route::get('profiles/id/{id}', 'LandingController@profileById');
Route::get('profiles/{slug}', 'LandingController@profileBySlug');
Route::get('profiles/amp', 'LandingController@index');
Route::get('profiles/amp/id/{id}', 'LandingController@profileAmpById');
Route::get('profiles/amp/{slug}', 'LandingController@profileAmpBySlug');

/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');