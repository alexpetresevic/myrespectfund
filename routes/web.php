<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/auth/facebook/redirect', 'SocialAuthFacebookController@redirect')->name('facebook.signin');
Route::get('/auth/facebook/callback', 'SocialAuthFacebookController@callback');

Route::get('/campaign/search', 'CampaignController@search')->name('campaign.search');

Route::get('/list-your-funeral-home', 'FuneralHomeController@create')->name('funeral-home.create');
Route::post('/list-your-funeral-home', 'FuneralHomeController@store')->name('funeral-home.store');

// Route::get('/find-funeral-home', 'FuneralHomeController@search')->name('funeral-home.search');

Route::post('/verify-capcha', 'PageController@verifyCapcha')->name('page.verify-capcha');

Route::get('/start-fundraiser/get-map-pins', 'CampaignController@loadMapPins')->name('campaign.load-pins');
Route::get('/start-fundraiser/{step?}/{campaign?}', 'CampaignController@create')->name('campaign.create');

Route::middleware(['auth'])->group(function (){
    Route::get('/my-fundraiser', 'CampaignController@dashboard')->name('campaign.dashboard');
    Route::post('/my-fundraiser/post-update', 'CampaignController@postUpdate')->name('campaign.dashboard.post-update');
    Route::get('/my-fundraiser/resources', 'CampaignController@toolkit')->name('campaign.dashboard.toolkit');
    Route::get('/my-fundraiser/funeral-details', 'CampaignController@funeralDetails')->name('campaign.dashboard.funeral-details');
    Route::post('/my-fundraiser/reminder/store', 'ReminderController@store')->name('campaign.dashboard.reminder.store');
    Route::get('/my-fundraiser/reminder/get-by-date/{date}', 'ReminderController@getByDate')->name('campaign.dashboard.reminder.get-by-date');
    Route::post('/my-fundraiser/reminder/update/{id}', 'ReminderController@update')->name('campaign.dashboard.reminder.update');
    Route::post('/my-fundraiser/reminder/delete/{reminder}', 'ReminderController@delete')->name('campaign.dashboard.reminder.delete');
    Route::get('my-fundraiser/donors', 'CampaignController@donors')->name('campaign.dashboard.donors');
    Route::get('my-fundraiser/edit', 'CampaignController@edit')->name('campaign.dashboard.edit');
    Route::post('my-fundraiser/edit', 'CampaignController@campaignUpdate')->name('campaign.dashboard.campaign-update');
    Route::get('my-fundraiser/delete', 'CampaignController@confirmDelete')->name('campaign.dashboard.campaign-delete');
    Route::post('my-fundraiser/delete', 'CampaignController@destroy')->name('campaign.dashboard.campaign-destroy');

    Route::post('/campaign/update/{step}/{campaign}', 'CampaignController@update')->name('campaign.update');
    Route::post('/campaign/upload-image/{campaign}', 'CampaignController@uploadImageAxios')->name('campaign.upload-image');
    Route::post('/campaign/delete-image/{campaign}', 'CampaignController@deleteImageAjax')->name('campaign.upload-image');
    Route::post('/campaign/add-funeral-home/{campaign}', 'CampaignController@addFuneralHome')->name('campaign.add-funeral-home');
    
    Route::post('/message/store', 'MessageController@store')->name('message.store');
    Route::get('/message/get-messages/{id}', 'MessageController@getMessages')->name('message.get');
    Route::get('/message/check-messages', 'MessageController@checkMessages');
    
    Route::get('/my-profile', 'UserController@profile')->name('user.profile');
    Route::patch('/my-profile/update', 'UserController@update')->name('user.update');
    Route::post('/my-profile/upload-picture/{user}', 'UserController@uploadPicture')->name('user.upload-picture');
    Route::post('/my-profile/delete-picture/{user}', 'UserController@deletePicture')->name('user.delete-picture');
    
    Route::get('withdraw/', 'WithdrawController@index')->name('withdraw.index');
    Route::get('withdraw/success', 'WithdrawController@stepTwo')->name('withdraw.two');
    Route::get('withdraw/thank-donors', 'WithdrawController@stepThree')->name('withdraw.three');
    Route::get('withdraw/testimonial', 'WithdrawController@stepFour')->name('withdraw.testimonial');
    Route::get('withdraw/leave-a-tip', 'WithdrawController@leaveTip')->name('withdraw.leave-tip');
    Route::get('withdraw/withdraw-funds', 'WithdrawController@withdraw')->name('withdraw.funds');
    
    Route::post('testimonial/store', 'TestimonialController@store')->name('testimonial.store');
    
});

Route::get('memorial/fundraiser/{campaign}', 'CampaignController@show')->name('campaign.show');

Route::middleware(['auth', 'partner'])->group(function (){
    Route::get('/partner/dashboard', 'PartnerController@index')->name('partner.index');
    Route::get('/partner/request-a-call', 'PartnerController@request')->name('partner.request-call');
    Route::get('/partner/request-literature', 'PartnerController@request')->name('partner.request-literature');
    Route::get('/partner/send-request', 'PartnerController@sendRequest')->name('partner.send-request');
    Route::post('/partner/upload-image/{funeralHome}', 'PartnerController@uploadImage')->name('partner.upload-image');
    Route::get('/partner/edit', 'PartnerController@edit')->name('partner.edit');
    Route::patch('/partner/update', 'PartnerController@update')->name('partner.update');

});

Route::get('donate/{campaign}', 'DonationController@index')->name('donate.index');
Route::post('donate', 'DonationController@store')->name('donate.store');
Route::post('donate/tip', 'DonationController@leaveTip')->name('donate.leave-tip');

Route::get('payment/tip/success/{donation}', 'PaymentController@successTip')->name('payment.success-tip');
Route::get('payment/leave-a-tip/{donation}', 'PaymentController@leaveTip')->name('payment.leave-tip');
Route::post('payment/leave-a-tip/{donation}', 'PaymentController@storeTip')->name('payment.store-tip');
Route::get('payment/success/{donation}', 'PaymentController@success')->name('payment.success');
Route::get('payment/{donation}/{tip?}', 'PaymentController@index')->name('payment.index');
Route::post('payment/{donation}/{tip?}', 'PaymentController@store')->name('payment.store');


Route::resource('news', 'NewsController');

Route::get('privacy-policy', 'PageController@privacy')->name('page.privacy');
Route::get('terms-of-use', 'PageController@terms')->name('page.terms');
Route::get('partnership-program', 'PageController@partnership')->name('page.partnership');
Route::get('faq', 'PageController@faq')->name('page.faq');
Route::get('how-we-help', 'PageController@howWeHelp')->name('page.how-we-help');
// Route::get('help', 'PageController@help')->name('page.help');
Route::get('checklist', 'PageController@checklist')->name('page.checklist');
Route::get('fees', 'PageController@fees')->name('page.fees');

Route::get('contact', 'PageController@contact')->name('page.contact');
Route::post('contact', 'PageController@contactSubmit')->name('contact.submit');

Route::post('sign-up-for-updates', 'CampaignController@signUpForUpdates');

Route::get('blog', 'BlogController@index')->name('blog.index');
Route::get('blog/category/{category}', 'BlogController@filter')->name('blog.filter');
Route::get('blog/tag/{tag}', 'BlogController@filterBytag')->name('blog.filter.tag');
Route::get('blog/post/{slug}', 'BlogController@show')->name('blog.show');

require_once 'backend.php';
