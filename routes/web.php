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

$app->get('/', function () use ($app) {
    return view('index');
});
$app->get('/editor', function () use ($app) {
    return view('editor');
});
/**
 * Notes
 */
$app->group(['prefix' => 'api'], function () use ($app) {
    $app->get('/notes', 'NoteController@index');
    $app->post('/notes', 'NoteController@store');
    $app->get('/notes/{id}', 'NoteController@show');
    $app->put('/notes/{id}', 'NoteController@update');
    $app->put('/notes/{id}/archive', 'NoteController@archive');
    $app->put('/notes/{id}/unarchive', 'NoteController@unarchive');
    $app->delete('/notes/{id}', 'NoteController@destroy');
});