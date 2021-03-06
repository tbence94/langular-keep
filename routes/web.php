<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * Notes
 */
$app->group(['prefix' => 'api'], function () use ($app) {
    $app->get('/notes', 'NoteController@index');
    $app->get('/notes/archived', 'NoteController@archived');
    $app->post('/notes', 'NoteController@store');
    $app->get('/notes/{id}', 'NoteController@show');
    $app->put('/notes/{id}', 'NoteController@update');
    $app->put('/notes/{id}/archive', 'NoteController@archive');
    $app->put('/notes/{id}/unarchive', 'NoteController@unarchive');
    $app->delete('/notes/archived', 'NoteController@clearArchive');
    $app->delete('/notes/{id}', 'NoteController@destroy');
});

/*
 * Views
 */
$app->get('/view/[{view:[A-Za-z0-9\._\-\/]+}]', function ($view) {
    return view($view);
});
$app->get('/[{view:[A-Za-z0-9\._\-\/]+}]', function () {
    return view('index');
});
