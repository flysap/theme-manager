<?php

use Illuminate\Http\Request;
use Parfumix\TableManager;

Route::group(['prefix' => 'admin/theme-manager', 'middleware' => 'role:admin'], function() {

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
        $repository = app('theme-repository');

        $themes = $repository->toArray();

        $table = TableManager\table(array(
            'columns' => array('name','description','version'),
            'rows'    => $themes
        ), 'collection', ['class' => 'table table-bordered table-striped dataTable']);

        return view('theme-manager::lists', compact('table'));
    }]);

    /**
     * Route for remove theme .
     *
     */
    Route::get('remove/{theme}', ['as' => 'theme-remove', function($theme) {
        return app('theme-service')
            ->remove($theme);
    }]);

    /**
     * Activate theme.
     *
     */
    Route::get('activate/{theme}', ['as' => 'theme-activate', function($theme) {
        return app('theme-service')
            ->activate($theme);
    }])->where(['theme' => "^(.)*"]);
});