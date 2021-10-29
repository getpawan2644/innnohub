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
Route::prefix('admin')->group(function () {
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Admin')->group(function () {
        // Login
        Auth::routes(['register' => false]);
        Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLoginForm');
        //Route::post('/login', 'Auth\LoginController@login')->name('login');
        Route::middleware(['auth:admin','subadmin'])->group(function () {

            Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
            // Routes for Admin

            Route::get('/admins','AdminController@index')->name('admins.index');
            Route::get('/admins/add','AdminController@create')->name('admins.create');
            Route::get('/admins/changeStatus','AdminController@changeStatus')->name('admins.changeStatus');
            Route::get('/admins/edit/{id}','AdminController@edit')->name('admins.edit');
            Route::get('/admins/destroy/{id}','AdminController@destroy')->name('admins.destroy');
            Route::post('/admins/store','AdminController@store')->name('admins.store');
            Route::put('/admins/update/{id}','AdminController@update')->name('admins.update');

            //Services
            Route::get('/service/{user_id}','AdminController@service_list')->name('service-list');
            Route::get('/service/add/{user_id}/{service}','AdminController@service_add')->name('service-add');
            Route::post('/services/add/crop-logo-upload','AdminController@uploadCropImage');
            Route::get('/service/view/{id}','AdminController@service_view')->name('service-view');
            Route::get('/service/edit/{user_id}/{id}/{service}','AdminController@service_edit')->name('service-edit');
            Route::get('/service/destroy/{id}','AdminController@service_destroy')->name('service-destroy');
            Route::post('/service/update/{id}','AdminController@service_update')->name('service-update');
            Route::post('/service/store','AdminController@service_store')->name('service-store');
             //Route::post('/admins','AdminController@index')->name('admins.index');
            
            //Update Profile
            Route::get('/updateProfile', 'ProfileController@showProfileForm')->name('showProfileForm');
            Route::put('/updateProfile', 'ProfileController@updateProfile')->name('updateProfile');
            Route::post('/updateProfilePic', 'ProfileController@updateProfilePic')->name('updateProfilePic');

            //Change Password
            Route::get('/changePassword', 'ProfileController@showPasswordForm')->name('showPasswordForm');
            Route::post('/changePassword', 'ProfileController@updatePassword')->name('updatePassword');

            // Banner Module
            // Route::get('/banners','BannersController@index')->name('banners.index');
            // Route::get('/banners/add','BannersController@create')->nam
            //e('banners.create');
            // Route::get('/banners/changeStatus','BannersController@changeStatus')->name('banners.changeStatus');
            // Route::get('/banners/edit/{id}','BannersController@edit')->name('banners.edit');
            // Route::get('/banners/destroy/{id}','BannersController@destroy')->name('banners.destroy');
            // Route::post('/banners/store','BannersController@store')->name('banners.store');
            // Route::put('/banners/update/{id}','BannersController@update')->name('banners.update');
            // Route::post('/banners/show','BannersController@show')->name('banners.show');
            // Route::get('/banners/states','BannersController@getStates')->name('banners.getStates');

            // Banner Module
            // Route::get('/advertisements','AdvertisementsController@index')->name('advertisements.index');
            // Route::get('/advertisements/add','AdvertisementsController@create')->name('advertisements.create');
            // Route::get('/advertisements/changeStatus','AdvertisementsController@changeStatus')->name('advertisements.changeStatus');
            // Route::get('/advertisements/edit/{id}','AdvertisementsController@edit')->name('advertisements.edit');
            // Route::get('/advertisements/destroy/{id}','AdvertisementsController@destroy')->name('advertisements.destroy');
            // Route::post('/advertisements/store','AdvertisementsController@store')->name('advertisements.store');
            // Route::put('/advertisements/update/{id}','AdvertisementsController@update')->name('advertisements.update');
            // Route::post('/advertisements/clientAjaxLogoImageUpload', 'AdvertisementsController@clientAjaxLogoImageUpload')->name('advertisements.clientAjaxLogoImageUpload');
            // Route::post('/advertisements/clientRemoveLogoImage', 'AdvertisementsController@clientRemoveLogoImage')->name('advertisements.clientRemoveImage');

            // Category Module
            Route::get('/categories','CategoriesController@index')->name('categories.index');
            Route::get('/categories/create','CategoriesController@Create')->name('categories.create');
            Route::post('/categories/store','CategoriesController@Store')->name('categories.store');
            Route::get('/categories/edit/{id}','CategoriesController@Edit')->name('categories.edit');
            Route::put('/categories/update/{id}','CategoriesController@Update')->name('categories.update');
            Route::get('/categories/topCategory/{id}','CategoriesController@topCategory')->name('categories.topCategory');
            Route::get('/categories/changeStatus','CategoriesController@changeStatus')->name('categories.changeStatus');
            Route::get('/categories/change-footer-status','CategoriesController@changeFooterStatus')->name('categories.changeFooterStatus');
            Route::get('/categories/destroy/{id}','CategoriesController@destroy')->name('categories.destroy');
            Route::get('/all-category-csv', 'CategoriesController@csv')->name('categories.csv');
            Route::post('/categories/postAjaxImg', 'CategoriesController@postAjaxImg')->name('category.postAjaxImg');
            // sub-Category Module
            Route::get('/sub-categories','SubCategoriesController@index')->name('sub_categories.index');
            Route::get('/sub-categories/create','SubCategoriesController@Create')->name('sub_categories.create');
            Route::post('/sub-categories/store','SubCategoriesController@Store')->name('sub_categories.store');
            Route::get('/sub-categories/edit/{id}','SubCategoriesController@Edit')->name('sub_categories.edit');
            Route::put('/sub-categories/update/{id}','SubCategoriesController@Update')->name('sub_categories.update');
            Route::get('/sub-categories/topCategory/{id}','SubCategoriesController@topCategory')->name('sub_categories.topCategory');
            Route::get('/sub-categories/changeStatus','SubCategoriesController@changeStatus')->name('sub_categories.changeStatus');
            Route::get('/sub-categories/destroy/{id}','SubCategoriesController@destroy')->name('sub_categories.destroy');
            Route::get('/all-sub-category-csv', 'SubCategoriesController@csv')->name('sub_categories.csv');

            // Faq Module
            // Route::get('/faqs','FaqsController@index')->name('faqs.index');
            // Route::get('/faqs/create','FaqsController@Create')->name('faqs.create');
            // Route::post('/faqs/store','FaqsController@Store')->name('faqs.store');
            // Route::get('/faqs/edit/{id}','FaqsController@Edit')->name('faqs.edit');
            // Route::put('/faqs/update/{id}','FaqsController@Update')->name('faqs.update');
            // Route::get('/faqs/topCategory/{id}','FaqsController@topCategory')->name('faqs.topCategory');
            // Route::get('/faqs/changeStatus','FaqsController@changeStatus')->name('faqs.changeStatus');
            // Route::get('/faqs/destroy/{id}','FaqsController@destroy')->name('faqs.destroy');

            // Privacy Policy Module
            // Route::get('/privacy','PrivacyPoliciesController@index')->name('privacy_policies.index');
            // Route::get('/privacy/create','PrivacyPoliciesController@Create')->name('privacy_policies.create');
            // Route::post('/privacy/store','PrivacyPoliciesController@Store')->name('privacy_policies.store');
            // Route::get('/privacy/edit/{id}','PrivacyPoliciesController@Edit')->name('privacy_policies.edit');
            // Route::put('/privacy/update/{id}','PrivacyPoliciesController@Update')->name('privacy_policies.update');
            // Route::get('/privacy/topCategory/{id}','PrivacyPoliciesController@topCategory')->name('privacy_policies.topCategory');
            // Route::get('/privacy/changeStatus','PrivacyPoliciesController@changeStatus')->name('privacy_policies.changeStatus');
            // Route::get('/privacy/destroy/{id}','PrivacyPoliciesController@destroy')->name('privacy_policies.destroy');

            // Terms Conditions Module
            // Route::get('/terms-conditions','TermConditionsController@index')->name('term_conditions.index');
            // Route::get('/terms-conditions/create','TermConditionsController@Create')->name('term_conditions.create');
            // Route::post('/terms-conditions/store','TermConditionsController@Store')->name('term_conditions.store');
            // Route::get('/terms-conditions/edit/{id}','TermConditionsController@Edit')->name('term_conditions.edit');
            // Route::put('/terms-conditions/update/{id}','TermConditionsController@Update')->name('term_conditions.update');
            // Route::get('/terms-conditions/topCategory/{id}','TermConditionsController@topCategory')->name('term_conditions.topCategory');
            // Route::get('/terms-conditions/changeStatus','TermConditionsController@changeStatus')->name('term_conditions.changeStatus');
            // Route::get('/terms-conditions/destroy/{id}','TermConditionsController@destroy')->name('term_conditions.destroy');

            // Country Module
            Route::get('/countries','CountriesController@index')->name('countries.index');
            Route::get('/countries/add','CountriesController@create')->name('countries.create');
            Route::get('/countries/changeStatus','CountriesController@changeStatus')->name('countries.changeStatus');
            Route::get('/countries/edit/{id}','CountriesController@edit')->name('countries.edit');
            Route::get('/countries/destroy/{id}','CountriesController@destroy')->name('countries.destroy');
            Route::post('/countries/store','CountriesController@store')->name('countries.store');
            Route::put('/countries/update/{id}','CountriesController@update')->name('countries.update');
            Route::get('/countries/csv','CountriesController@csv')->name('countries.csv');

            // State Module
            // Route::get('/states','StatesController@index')->name('states.index');
            // Route::get('/states/add','StatesController@create')->name('states.create');
            // Route::get('/states/changeStatus','StatesController@changeStatus')->name('states.changeStatus');
            // Route::get('/states/edit/{id}','StatesController@edit')->name('states.edit');
            // Route::get('/states/destroy/{id}','StatesController@destroy')->name('states.destroy');
            // Route::post('/states/store','StatesController@store')->name('states.store');
            // Route::put('/states/update/{id}','StatesController@update')->name('states.update');

            // Cms Module
            Route::get('/cms','CmsController@index')->name('cms.index');
            Route::get('/cms/add','CmsController@create')->name('cms.create');
            Route::get('/cms/changeStatus','CmsController@changeStatus')->name('cms.changeStatus');
            Route::get('/cms/edit/{id}','CmsController@edit')->name('cms.edit');
            Route::get('/cms/destroy/{id}','CmsController@destroy')->name('cms.destroy');
            Route::post('/cms/store','CmsController@store')->name('cms.store');
            Route::put('/cms/update/{id}','CmsController@update')->name('cms.update');

            // State User
            Route::get('/users','UsersController@index')->name('users.index');
            Route::get('/users/add','UsersController@create')->name('users.create');
            Route::get('/users/changeStatus','UsersController@changeStatus')->name('users.changeStatus');
            Route::get('/users/edit/{id}','UsersController@edit')->name('users.edit');
            Route::get('/users/destroy/{id}','UsersController@destroy')->name('users.destroy');
            Route::post('/users/store','UsersController@store')->name('users.store');
            Route::put('/users/update/{id}','UsersController@update')->name('users.update');
            Route::post('/users/show','UsersController@show')->name('users.show');
            Route::get('/users/states','UsersController@getStates')->name('users.getStates');
            Route::get('/users/reset-link/{id}','UsersController@sendResetLinkEmail')->name('users.reset_link');
            Route::post('users/message', 'UsersController@message')->name('user.message');
            Route::post('users/sent-message', 'UsersController@sentMessage')->name('user.sent-message');
            Route::get('/users/csv','UsersController@csv')->name('users.csv');

            Route::get('/contacts','ContactController@index')->name('contacts.index');
            Route::get('/contacts/destroy/{id}','ContactController@destroy')->name('contacts.destroy');
            Route::get('/contacts/changeStatus','ContactController@changeStatus')->name('contacts.changeStatus');


            // Client Category Module
            // Route::get('/client-categories','ClientCategoriesController@index')->name('client_categories.index');
            // Route::get('/client-categories/create','ClientCategoriesController@Create')->name('client_categories.create');
            // Route::post('/client-categories/store','ClientCategoriesController@Store')->name('client_categories.store');
            // Route::get('/client-categories/edit/{id}','ClientCategoriesController@Edit')->name('client_categories.edit');
            // Route::put('/client-categories/update/{id}','ClientCategoriesController@Update')->name('client_categories.update');
            // Route::get('/client-categories/topCategory/{id}','ClientCategoriesController@topCategory')->name('client_categories.topCategory');
            // Route::get('/client-categories/changeStatus','ClientCategoriesController@changeStatus')->name('client_categories.changeStatus');
//            Route::get('/client-categories/change-featured-status','ClientCategoriesController@changeFeatured')->name('client_categories.changeFeatured');
            // Route::get('/client-categories/destroy/{id}','ClientCategoriesController@destroy')->name('client_categories.destroy');
            // Route::get('/all-client-category-csv', 'ClientCategoriesController@csv')->name('client_categories.csv');

            // Clients
            // Route::resource('clients', 'ClientsController')->except(['show','destroy']);
            // Route::get('/clients/changeStatus','ClientsController@changeStatus')->name('clients.changeStatus');
            // Route::get('/clients/change-featured-status','ClientsController@changeFeatured')->name('clients.changeFeatured');
            // Route::get('/clients/changeOfferStatus','ClientsController@changeOfferStatus')->name('clients.changeOfferStatus');
            // Route::get('/clients/destroy/{product}','ClientsController@destroy')->name('clients.destroy');
            /* Video Upload route start */
            // Route::post('/clients/clientAjaxImageUpload', 'ClientsController@clientAjaxImageUpload')->name('clients.clientAjaxImageUpload');
            // Route::post('/clients/clientAjaxLogoImageUpload', 'ClientsController@clientAjaxLogoImageUpload')->name('clients.clientAjaxLogoImageUpload');
            // Route::post('/clients/clientRemoveImage', 'ClientsController@clientRemoveImage')->name('clients.clientRemoveImage');
            // Route::post('/clients/clientRemoveLogoImage', 'ClientsController@clientRemoveLogoImage')->name('clients.clientRemoveLogoImage');
            // Route::get('/client-analytics-csv', 'ClientsController@csv')->name('client.analytics.csv');
            // Route::get('/client-csv', 'ClientsController@clientCsv')->name('client.csv');
            // Route::get('/single-client-csv/{id}', 'ClientsController@singleClientCsv')->name('clients.export_one');
//Factory / Vendors

            // Route::resource('vendors', 'VendorsController')->except(['show','destroy']);
            // Route::get('/vendors/changeStatus','VendorsController@changeStatus')->name('vendors.changeStatus');
            // Route::get('/vendors/changeOfferStatus','VendorsController@changeOfferStatus')->name('vendors.changeOfferStatus');
            // Route::get('/vendors/destroy/{product}','VendorsController@destroy')->name('vendors.destroy');
            /* Video Upload route start */
            // Route::post('/vendors/clientAjaxImageUpload', 'VendorsController@clientAjaxImageUpload')->name('vendors.clientAjaxImageUpload');
            // Route::post('/vendors/clientAjaxLogoImageUpload', 'VendorsController@clientAjaxLogoImageUpload')->name('vendors.clientAjaxLogoImageUpload');
            // Route::post('/vendors/clientRemoveImage', 'VendorsController@clientRemoveImage')->name('vendors.clientRemoveImage');
            // Route::post('/vendors/clientRemoveLogoImage', 'VendorsController@clientRemoveLogoImage')->name('vendors.clientRemoveLogoImage');
            // Route::get('/vendors/export', 'VendorsController@export')->name('vendors.export.csv');
            // Products
            // Route::resource('products', 'ProductsController')->except(['show','destroy']);
            // Route::get('/products/changeStatus','ProductsController@changeStatus')->name('products.changeStatus');
            // Route::get('/products/changeOfferStatus','ProductsController@changeOfferStatus')->name('products.changeOfferStatus');
            // Route::get('/products/changeProductDisplayStatus','ProductsController@changeProductDisplayStatus')->name('products.changeProductDisplayStatus');
            // Route::get('/products/changeVendorDisplayStatus','ProductsController@changeVendorDisplayStatus')->name('products.changeVendorDisplayStatus');
            // Route::get('/products/trendingSale','ProductsController@trendingSale')->name('products.trendingSale');
            // Route::get('/products/displayPrice','ProductsController@displayPrice')->name('products.displayPrice');
            // Route::get('/products/destroy/{product}','ProductsController@destroy')->name('products.destroy');
            // Route::get('/single-products-csv/{id}', 'ProductsController@singleClientCsv')->name('products.export_one');
            // Route::post('/product-image/reorder', 'ProductsController@imageReorder')->name('products.image.reorder');
            // Route::get('/get-product-image', 'ProductsController@getImage')->name('products.get_images');
            // Route::post('/image/marked-featured', 'ProductsController@markedFeatured')->name('products.marked_featured');
            // Route::get('/products/normal-csv', 'ProductsController@normalCsv')->name('products.normal-csv');
            // Route::get('/products/image-csv', 'ProductsController@Imagecsv')->name('products.image-csv');
            // Route::get('/products-analytics-csv', 'ProductsController@csv')->name('products.analytics.csv');

            // Route::get('/products/index-status','ProductsController@index')->name('products.index.status');
            // Route::get('/products/changeDisplayDiscountStatus','ProductsController@changeDisplayDiscountStatus')->name('products.display_discount');
            // Route::get('/products-status/normal-csv', 'ProductsController@statusNormalCsv')->name('products-status.normal-csv');
            // Route::get('/products-status/image-csv', 'ProductsController@statusImagecsv')->name('products-status.image-csv');
            // Route::get('/products-status-analytics-csv', 'ProductsController@statusCsv')->name('products-status.analytics.csv');


            /* Video Upload route start */
            // Route::post('/products/productAjaxImageUpload', 'ProductsController@productAjaxImageUpload')->name('products.productAjaxImageUpload');
            // Route::post('/products/productRemoveImage', 'ProductsController@productRemoveImage')->name('products.productRemoveImage');
            // Routes for Appointment
            // Route::get('appointment/changeStatus','AppointmentController@changeStatus')->name('appointment.changeStatus');
            // Route::get('appointment/destroy/{appointment}','AppointmentController@destroy')->name('appointment.destroy');
            // Route::get('appointment/booking-detail','AppointmentController@bookingDetails')->name('appointment.booking-detail');
            // Route::get('appointment/all-appointments','AppointmentController@allAppointments')->name('appointment.all-appointments');
            // Route::get('appointment/cancel-appointment/{id}','AppointmentController@cancelAppointment')->name('appointment.cancel-appointment');
            // Route::get('appointment/reschedule-appointment/{id}','AppointmentController@rescheduleAppointment')->name('appointment.reschedule-appointment');
            // Route::get('appointment/csv', 'AppointmentController@csv')->name('appointment.csv');
            // Route::resource('appointment', 'AppointmentController')->except(['destroy']);
            // Routes for Product Requests
            // Route::get('product-request', 'ProductRequestController@index')->name('product-request');
            // Route::get('product-request/{email}/{created}', 'ProductRequestController@allRequest')->name('all-request');
            // Route::get('product-requests', 'ProductRequestController@allRequests')->name('all-requests');
            // Route::post('product-request/change-status', 'ProductRequestController@changeStatus')->name('product-request.change-status');
            // Route::post('product-request/message', 'ProductRequestController@message')->name('product-request.message');
            // Route::post('product-request/sent-message', 'ProductRequestController@sentMessage')->name('product-request.sent-message');
            // Route::get('product-requests/csv', 'ProductRequestController@csv')->name('all-requests.csv');
            // Routes for Invite For Review
            // Route::get('invite-for-review/{id}', 'RatingController@inviteForReview')->name('invite-for-review');
            // Route::get('review-ratings', 'RatingController@index')->name('review-ratings');
            // Routes for all ajax request
           
            // Route::post('/ajax/get-product_code','AjaxController@getProductCode')->name('ajax.get_product_code');
            // Site Settings
            // Route::get('/settings','SettingsController@index')->name('settings.index');
            // Route::get('/settings/site_settings','SettingsController@siteSettings')->name('settings.siteSettings');
            // Route::put('/settings/site_settings','SettingsController@updateSiteSettings')->name('settings.updateSiteSettings');
            // Route::get('/settings/social_links','SettingsController@socialLinks')->name('settings.socialLinks');
            // Route::put('/settings/social_links','SettingsController@updateSocialLinks')->name('settings.updateSocialLinks');
            // Message Routes Start Here
            // Route::get('messages','MessageController@index')->name('message.index');
            // Route::get('messages/{id}','MessageController@message')->name('message.message');
            // Route::post('messages-relply/{id}','MessageController@saveMessage')->name('message-reply');
            // End Message Routes
            //CMS Module
            // Route::get('/cms/create','CmsController@Create')->name('cms.create');
            // Route::post('/cms/store','CmsController@Store')->name('cms.store');
            // Route::get('/cms', 'CmsController@index')->name('cms.index');
            // Route::get('/cms/edit/{id}',"CmsController@edit")->name('cms.edit');
            // Route::put('/cms/update/{id}',"CmsController@update")->name('cms.update');
            // Route::get('/cms/contact-edit',"CmsController@contactDetailEdit")->name('cms.contact-detail-edit');
            // Route::put('/cms/contact-update',"CmsController@contactDetailUpdate")->name('cms.contact-detail-update');
            // Route::get('/cms/changeStatus','CmsController@changeStatus')->name('cms.changeStatus');
            // Route::get('/cms/destroy/{id}','CmsController@destroy')->name('cms.destroy');

            //EmailTemplate Route
            Route::get('/email-template/create', 'EmailTemplateController@create')->name('email-template.create');
            Route::post('/email-template/store', 'EmailTemplateController@store')->name('email-template.store');
            Route::get('/email-template', 'EmailTemplateController@index')->name('email-template.index');
            Route::get('/email-template/edit/{id}',"EmailTemplateController@edit")->name('email-template.edit');
            Route::put('/email-template/update/{id}',"EmailTemplateController@update")->name('email-template.update');

            // CkEditor Upload Routes

            //case study
            Route::get('/case-study/add/{user_id}', 'CasestudyController@add')->name('casestudy.add');
            Route::post('/case-study/store', 'CasestudyController@store')->name('casestudy.store');
            Route::get('/case-study/edit/{user_id}/{id}', 'CasestudyController@edit')->name('casestudy.edit');
            Route::post('/case-study/update/{id}', 'CasestudyController@update')->name('casestudy.update');
            Route::get('/case-study/delete/{id}', 'CasestudyController@destroy')->name('casestudy.delete');
            Route::get('/case-study/{user_id}', 'CasestudyController@index')->name('casestudy.index');
            Route::get('/case-study/view', 'CasestudyController@view')->name('casestudy.view');

            //multimedia
            Route::get('/gallery/add/{user_id}', 'MultimediaController@add')->name('gallery.add');
            Route::post('/gallery/store', 'MultimediaController@store')->name('gallery.store');
            Route::get('/gallery/edit/{user_id}/{id}', 'MultimediaController@edit')->name('gallery.edit');
            Route::post('/gallery/update/{id}', 'MultimediaController@update')->name('gallery.update');
            Route::get('/gallery/delete/{id}', 'MultimediaController@destroy')->name('gallery.delete');
            Route::get('/gallery/{user_id}', 'MultimediaController@index')->name('gallery.index');

             //Testimonials
            Route::get('/testimonials/add/{user_id}', 'TestimonialController@add')->name('testimonials.add');
            Route::post('/testimonials/store', 'TestimonialController@store')->name('testimonials.store');
            Route::get('/testimonials/edit/{user_id}/{id}', 'TestimonialController@edit')->name('testimonials.edit');
            Route::post('/testimonials/update/{id}', 'TestimonialController@update')->name('testimonials.update');
            Route::get('/testimonials/delete/{id}', 'TestimonialController@destroy')->name('testimonials.delete');
            Route::get('/testimonials/{user_id}', 'TestimonialController@index')->name('testimonials.index');
            Route::get('/testimonials/view', 'TestimonialController@view')->name('testimonials.view');

                //awards
            Route::get('/awards/add/{user_id}', 'AwardsController@add')->name('awards.add');
            Route::post('/awards/store', 'AwardsController@store')->name('awards.store');
            Route::get('/awards/edit/{user_id}/{id}', 'AwardsController@edit')->name('awards.edit');
            Route::post('/awards/update/{id}', 'AwardsController@update')->name('awards.update');
            Route::get('/awards/delete/{id}', 'AwardsController@destroy')->name('awards.delete');
            Route::get('/awards/{user_id}', 'AwardsController@index')->name('awards.index');

                //feature
            Route::get('/features/add/{user_id}', 'FeaturesController@add')->name('features.add');
            Route::post('/features/store', 'FeaturesController@store')->name('features.store');
            Route::get('/features/edit/{user_id}/{id}', 'FeaturesController@edit')->name('features.edit');
            Route::post('/features/update/{id}', 'FeaturesController@update')->name('features.update');
            Route::get('/features/delete/{id}', 'FeaturesController@destroy')->name('features.delete');
            Route::get('/features/{user_id}', 'FeaturesController@index')->name('features.index');

            //Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
           // Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');

        });
    });
});

// Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
// Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
// Route::group(['prefix' => 'laravel-filemanager'], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

//Route::middleware(['localized'])->group(function () {
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('category-list', 'HomeController@categorylist')->name('categorylist');
    Route::get('/viewservices', 'HomeController@viewservices')->name('viewservices');
    Route::get('/details/{id}', 'HomeController@servicedetails')->name('servicedetails');
    Route::get('/vendor_profile/{id}', 'HomeController@vendorProfile')->name('vendorprofile');
    Route::post('/book-meeting', 'MeetingController@bookmeeting')->name('bookmeeting');
    Route::post('/meeting/statusAccept/', 'MeetingController@statusAccept')->name('meeting.statusAccept');
    Route::post('/meeting/statusReject/', 'MeetingController@statusReject')->name('meeting.statusReject');
    Route::get('/meeting/delete/{id}', 'MeetingController@destroy')->name('meeting.delete');
    Route::get('/meeting', 'MeetingController@index')->name('meeting.index');
    Route::get('/gallery/add', 'MultimediaController@add')->name('gallery.add');
    Route::post('/gallery/store', 'MultimediaController@store')->name('gallery.store');
    Route::get('/gallery/edit/{id}', 'MultimediaController@edit')->name('gallery.edit');
    Route::post('/gallery/update/{id}', 'MultimediaController@update')->name('gallery.update');
    Route::get('/gallery/delete/{id}', 'MultimediaController@destroy')->name('gallery.delete');
    Route::get('/gallery', 'MultimediaController@index')->name('gallery.index');

    //awards
    Route::get('/awards/add', 'AwardsController@add')->name('awards.add');
    Route::post('/awards/store', 'AwardsController@store')->name('awards.store');
    Route::get('/awards/edit/{id}', 'AwardsController@edit')->name('awards.edit');
    Route::post('/awards/update/{id}', 'AwardsController@update')->name('awards.update');
    Route::get('/awards/delete/{id}', 'AwardsController@destroy')->name('awards.delete');
    Route::get('/awards', 'AwardsController@index')->name('awards.index');

    //feature
    Route::get('/features/add', 'FeaturesController@add')->name('features.add');
    Route::post('/features/store', 'FeaturesController@store')->name('features.store');
    Route::get('/features/edit', 'FeaturesController@edit')->name('features.edit');
    Route::post('/features/update/{id}', 'FeaturesController@update')->name('features.update');
    Route::get('/features/delete/{id}', 'FeaturesController@destroy')->name('features.delete');
    Route::get('/features', 'FeaturesController@index')->name('features.index');


    //case study

    Route::get('/case-study/add', 'CasestudyController@add')->name('casestudy.add');
    Route::post('/case-study/store', 'CasestudyController@store')->name('casestudy.store');
    Route::get('/case-study/edit/{id}', 'CasestudyController@edit')->name('casestudy.edit');
    Route::post('/case-study/update/{id}', 'CasestudyController@update')->name('casestudy.update');
    Route::get('/case-study/delete/{id}', 'CasestudyController@destroy')->name('casestudy.delete');
    Route::get('/case-study', 'CasestudyController@index')->name('casestudy.index');
    Route::get('/case-study/view', 'CasestudyController@view')->name('casestudy.view');

    //Testimonials
    Route::get('/testimonials/add', 'TestimonialController@add')->name('testimonials.add');
    Route::post('/testimonials/store', 'TestimonialController@store')->name('testimonials.store');
    Route::get('/testimonials/edit/{id}', 'TestimonialController@edit')->name('testimonials.edit');
    Route::post('/testimonials/update/{id}', 'TestimonialController@update')->name('testimonials.update');
    Route::get('/testimonials/delete/{id}', 'TestimonialController@destroy')->name('testimonials.delete');
    Route::get('/testimonials', 'TestimonialController@index')->name('testimonials.index');
    Route::get('/testimonials/view', 'TestimonialController@view')->name('testimonials.view');
    

   // homecontroller
     Route::post('/ajax/subcategory','AjaxController@activeSubcategory')->name('ajax.subcategory');
     Route::get('contact', 'HomeController@contact')->name('contact');
     Route::post('contact', 'HomeController@saveContact')->name('save-contact');
     Route::get('/', 'HomeController@index')->name('routes.home');
     Route::get('/product-listing', 'ProductsController@index')->name('product-list');
     Route::get('/location/getCountry','LocationController@getCountry')->name('location.getCountry');
     Route::get('/location/getStates','LocationController@getStates')->name('location.getStates');


     Route::post('/ajax/subcategory','AjaxController@activeSubcategory')->name('ajax.subcategory');
    Route::get('/user/register-type', 'Auth\RegisterController@registerType')->name('user.register-type');
    Route::get('/user/register', 'Auth\RegisterController@register')->name('user.register');
    Route::post('/user/register', 'Auth\RegisterController@postRegister')->name('user.post-register');
    Route::get('/user/login', 'Auth\LoginController@login')->name('user.login');
    Route::post('/user/login', 'Auth\LoginController@postLogin')->name('user.post-login');
    Route::get('/user/logout', 'Auth\LoginController@logout')->name('user.logout');
    //Route for social Login
    // Route::get('login/google', 'Auth\LoginController@redirectToProvider');
    // Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
    //End Route for social login
    Route::get('/user/edit-profile', 'UsersController@editProfile')->name('user.edit-profile');
    Route::post('/user/update-profile', 'UsersController@updateProfile')->name('user.update-profile');
    Route::post('/user/update-profile-user', 'UsersController@updateProfileUser')->name('user.update-profile-user');
    Route::get('/user/calendar', 'UsersController@calendar')->name('user.calendar');
    Route::post('/user/calendarupdate', 'UsersController@calendarupdate')->name('user.calendarupdate');

     Route::get('/user/edit-profile-step-two', 'UsersController@editProfileStepTwo')->name('user.edit-profile-step-two');
    Route::post('/user/update-profile-step-two', 'UsersController@updateProfileStepTwo')->name('user.update-profile-step-two');

    Route::get('/user/change-password', 'UsersController@changePassword')->name('user.change-password');
    Route::post('/user/update-password', 'UsersController@updatePassword')->name('user.update-password');
    Route::post('/user/crop-profileimage-upload', 'UsersController@uploadCropImage')->name('user.image');


    //Route for request product
    // Route::get('category/{id}','ProductsController@category')->name('category');
    // Route::get('/request-product', 'ProductsController@requstProduct')->name('requst-product');
    // Route::post('/request-product', 'ProductsController@saveRequestProduct')->name('save-requst-product');
    // Route::post('/save-favorites', 'ProductsController@saveFavorites')->name('save-favorites');
    // Route::get('/single-product/{product}', 'ProductsController@singleProduct')->name('single-product');
    // Route::get('rate-product','ProductsController@rateProduct')->name('rate-product');
    // Route::post('save-rating','ProductsController@saveRating')->name('save-rating');
    //Route for Clients
    // Route::get('/client/{id}', 'ClientsController@clientDetails')->name('client.details');
    Route::get('/vendor/{id}', 'ClientsController@vendorDetails')->name('vendor.details');
    // Route::get('/client-list', 'ClientsController@clientList')->name('client.listing');
    //Route for furnuture
    // Route::get('furniture', 'FurnitureController@index')->name('furniture');
    //Route for appointment
     Route::get('/meeting/request', 'MeetingController@meetingRequest')->name('meeting.request');
    Route::middleware(['auth'])->group(function () {
    //Route::group(['middleware' => ['guest']], function () {
       Route::get('/services', 'ServiceController@index')->name('service.index');
       Route::get('/services/create', 'ServiceController@create')->name('service.create');
       Route::post('/services/store', 'ServiceController@store')->name('service.store');
       Route::get('/services/home', 'ServiceController@home')->name('service.home');
       Route::post('/services/edit/crop-image-upload', 'ServiceController@uploadCropImage');
       Route::get('/services/edit/{id}', 'ServiceController@edit')->name('service.edit');
       Route::post('service_update/{id}', 'ServiceController@update')->name('service.update');
       Route::get('/services/delete/{id}', 'ServiceController@destroy')->name('service.delete');
       Route::post('/services/crop-image-upload', 'ServiceController@uploadCropImage')->name('service.image');
       Route::get('/user/edit-profile', 'UsersController@editProfile')->name('user.edit-profile');

        //Route::resource('services', ServiceController::class);
        // Route::get('appointment', 'AppointmentController@index')->name('appointment.index');
        // Route::get('appointment/create', 'AppointmentController@create')->name('appointment.create');
        // Route::post('appointment/fetchAppointment', 'AppointmentController@fetchAppointment')->name('appointment.fetchAppointment');
        // Route::get('appointment/book/{id}/{date}', 'AppointmentController@book')->name('appointment.book');
        // Route::get('appointment/cancel/{id}', 'AppointmentController@cancel')->name('appointment.cancel');
        // Route::get('favorites', 'FavoritesController@index')->name('favorites.index');
        // Route::get('favorites/destroy/{id}','FavoritesController@destroy')->name('favorites.destroy');
        // Route::get('request-all-product','ProductsController@allProdRequest')->name('request-all-product');
        // Route::post('request-all-product','ProductsController@saveAllProdReq')->name('request-all-product');
        // Route::get('messages','MessageController@index')->name('message.index');
        // Route::get('messages/{id}','MessageController@message')->name('message.message');
        // Route::post('messages-relply/{id}','MessageController@saveMessage')->name('message-reply');
        // Route::get('message/create','MessageController@create')->name('message.create');
        // Route::post('messages/store','MessageController@store')->name('message.store');
        // Route::get('product-request','RequestController@index')->name('product-request');
        // Route::get('product-request/cancel/{id}','RequestController@cancelRequest')->name('product-request.cancel');
    });

     $cms = App\Models\Cms::allCmsForRoute();
     //dd($cms);
     foreach($cms as $page){
         Route::get($page['url'], function() use ($page){
             return App::make('\App\Http\Controllers\HomeController')->callAction('page', [$page['page_name']]);
         })->name('page.'.$page['page_name']);
     }
    Route::get('/{page_name}', 'HomeController@cms')->name('cms');
//    Route for change language
     Route::get('change-locale/{locale}', 'LocaleController@changeLocale')->name('change-locale');


//});

Route::get('/cms/contact', 'CmsController@contact')->name('cms.contact');
Route::post('/cms/contactUs', 'CmsController@contactUs')->name('cms.contactUs');
Route::get('/cms/aboutus', 'CmsController@about')->name('cms.about');
Route::get('/cms/cms_page', 'CmsController@cms_page')->name('cms.cms_page');
