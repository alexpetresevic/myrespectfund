<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware('auth', 'admin-only')
    ->namespace('Admin')
    ->group(function () {
        
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

        Route::resource('pages', 'PageController', [
            'names' => [
                'index'   => 'admin.pages.index',
                'create'  => 'admin.pages.create',
                'store'   => 'admin.pages.store',
                'show'    => 'admin.pages.show',
                'edit'    => 'admin.pages.edit',
                'update'  => 'admin.pages.update',
                'destroy' => 'admin.pages.destroy',
            ]
        ]);

        Route::resource('faqs', 'FaqController', [
            'names' => [
                'index'   => 'admin.faq.index',
                'create'  => 'admin.faq.create',
                'store'   => 'admin.faq.store',
                'show'    => 'admin.faq.show',
                'edit'    => 'admin.faq.edit',
                'update'  => 'admin.faq.update',
                'destroy' => 'admin.faq.destroy',
            ]
        ]);

        Route::resource('news', 'NewsController', [
            'names' => [
                'index'   => 'admin.news.index',
                'create'  => 'admin.news.create',
                'store'   => 'admin.news.store',
                'show'    => 'admin.news.show',
                'edit'    => 'admin.news.edit',
                'update'  => 'admin.news.update',
                'destroy' => 'admin.news.destroy',
            ]
        ]);
        
        Route::get('add-users', 'UserController@addUsers')->name('admin.add-users');
        Route::get('users/search', 'UserController@search')->name('admin.users.search');
        Route::resource('users', 'UserController', [
            'names' => [
                'index'   => 'admin.users.index',
                'create'  => 'admin.users.create',
                'store'   => 'admin.users.store',
                'show'    => 'admin.users.show',
                'edit'    => 'admin.users.edit',
                'update'  => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]
        ]);

        Route::resource('toolkits', 'ToolkitController', [
            'names' => [
                'index'   => 'admin.toolkit.index',
                'create'  => 'admin.toolkit.create',
                'store'   => 'admin.toolkit.store',
                'show'    => 'admin.toolkit.show',
                'edit'    => 'admin.toolkit.edit',
                'update'  => 'admin.toolkit.update',
                'destroy' => 'admin.toolkit.destroy',
            ]
        ]);
    
        Route::get('funeral-homes/import', 'FuneralHomeController@importExcel')->name('admin.funeral-home.import');
        Route::get('funeral-homes/search', 'FuneralHomeController@search')->name('admin.funeral-home.search');
        Route::post('funeral-homes/cancel-import', 'FuneralHomeController@cancelImport')->name('admin.funeral-home.cancel-import');
        Route::post('funeral-homes/save-import-file', 'FuneralHomeController@saveImportFile')->name('admin.funeral-home.save-import-file');
        Route::get('funeral-homes/get-current-row', 'FuneralHomeController@getCurrentRow')->name('admin.funeral-home.get-current-row');
        Route::resource('funeral-homes', 'FuneralHomeController', [
            'names' => [
                'index'   => 'admin.funeral-homes.index',
                'create'  => 'admin.funeral-homes.create',
                'store'   => 'admin.funeral-homes.store',
                'show'    => 'admin.funeral-homes.show',
                'edit'    => 'admin.funeral-homes.edit',
                'update'  => 'admin.funeral-homes.update',
                'destroy' => 'admin.funeral-homes.destroy',
            ]
        ]);
    
        Route::get('campaigns/search', 'CampaignController@search')->name('admin.campaign.search');
        Route::resource('campaigns', 'CampaignController', [
            'names' => [
                'index'   => 'admin.campaigns.index',
                'create'  => 'admin.campaigns.create',
                'store'   => 'admin.campaigns.store',
                'show'    => 'admin.campaigns.show',
                'edit'    => 'admin.campaigns.edit',
                'update'  => 'admin.campaigns.update',
                'destroy' => 'admin.campaigns.destroy',
            ]
        ]);

        Route::resource('organisations', 'OrganizationController', [
            'names' => [
                'index'   => 'admin.organization.index',
                'create'  => 'admin.organization.create',
                'store'   => 'admin.organization.store',
                'show'    => 'admin.organization.show',
                'edit'    => 'admin.organization.edit',
                'update'  => 'admin.organization.update',
                'destroy' => 'admin.organization.destroy',
            ]
        ]);
        
        Route::resource('testimonials', 'TestimonialController', [
            'names' => [
                'index'   => 'admin.testimonial.index',
                'create'  => 'admin.testimonial.create',
                'store'   => 'admin.testimonial.store',
                'show'    => 'admin.testimonial.show',
                'edit'    => 'admin.testimonial.edit',
                'update'  => 'admin.testimonial.update',
                'destroy' => 'admin.testimonial.destroy',
            ]
        ]);

        Route::get('settings', 'SettingsController@index')->name('admin.settings.index');
        Route::post('settings', 'SettingsController@store')->name('admin.settings.store');

        Route::get('send-password-reset-link/{user}', 'FuneralHomeController@sendPasswordResetEmail')->name('admin.send-password-reset-link');
    
        Route::delete('/blog/delete-post-picture/{post}', 'PostController@deletePicture')->name('post.delete-picture');
        Route::delete('/testimonial/delete-testimonial-picture/{testimonial}', 'TestimonialController@deletePicture')->name('testimonial.delete-picture');        
        Route::prefix('blog')->group(function () {
            Route::resource('posts', 'PostController', [
                'names' => [
                    'index'   => 'admin.blog.posts.index',
                    'create'  => 'admin.blog.posts.create',
                    'store'   => 'admin.blog.posts.store',
                    'show'    => 'admin.blog.posts.show',
                    'edit'    => 'admin.blog.posts.edit',
                    'update'  => 'admin.blog.posts.update',
                    'destroy' => 'admin.blog.posts.destroy',
                ]
            ]);

            Route::resource('categories', 'CategoryController', [
                'names' => [
                    'index'   => 'admin.blog.categories.index',
                    'create'  => 'admin.blog.categories.create',
                    'store'   => 'admin.blog.categories.store',
                    'show'    => 'admin.blog.categories.show',
                    'edit'    => 'admin.blog.categories.edit',
                    'update'  => 'admin.blog.categories.update',
                    'destroy' => 'admin.blog.categories.destroy',
                ]
            ]);

            Route::resource('tags', 'TagController', [
                'names' => [
                    'index'   => 'admin.blog.tags.index',
                    'create'  => 'admin.blog.tags.create',
                    'store'   => 'admin.blog.tags.store',
                    'show'    => 'admin.blog.tags.show',
                    'edit'    => 'admin.blog.tags.edit',
                    'update'  => 'admin.blog.tags.update',
                    'destroy' => 'admin.blog.tags.destroy',
                ]
            ]);
        });
    });
