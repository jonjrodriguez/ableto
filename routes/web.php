<?php

Auth::routes();

// Catch all route
Route::get('{all}', 'HomeController@index')->where(['all' => '.*']);
