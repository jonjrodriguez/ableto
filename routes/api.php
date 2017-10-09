<?php

Route::get('questions', 'Api\QuestionController@index');
Route::get('answers', 'Api\AnswerController@index');
Route::post('answers', 'Api\AnswerController@store');
Route::get('answers/{date}', 'Api\AnswerController@show');