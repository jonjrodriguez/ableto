<?php

Auth::routes();

// Catch all route
Route::any('{all}', 'HomeController@index')->where(['all' => '.*']);
