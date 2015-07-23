<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'theme-manager'], function() {

    /**
     * Route for theme installation
     */
    Route::match(['post', 'get'], '/upload', ['as' => 'theme-upload', function(Request $request) {
        $service = app('theme-service');

        if( $request->method() == 'POST' ) {
            if( $service->install(
                $request->file('theme')
            ) ) {
                return redirect(
                    route('theme-lists')
                );
            }
        }

        return view('theme-manager::upload');
    }]);

    /**
     * Route for lists theme ..
     */
    Route::get('lists/{page?}', ['as' => 'theme-lists', function() {
        $service = app('theme-service');

        $themes = $service->themes();

        return view('theme-manager::lists', ['themes' => $themes]);
    }]);

    /**
     * Route for remove theme .
     *
     */
    Route::get('remove/{theme}', ['as' => 'theme-remove', function($theme) {
        return app('theme-service')
            ->remove($theme);
    }]);
});