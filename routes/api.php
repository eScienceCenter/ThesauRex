<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['before' => 'jwt.auth', 'after' => 'jwt.refresh'])->prefix('v1')->group(function() {
    Route::get('/pre', 'HomeController@getGlobalData');
    Route::get('/version', function() {
        $versionInfo = new App\VersionInfo();
        return response()->json([
            'full' => $versionInfo->getFullRelease(),
            'readable' => $versionInfo->getReadableRelease(),
            'release' => $versionInfo->getRelease(),
            'name' => $versionInfo->getReleaseName(),
            'time' => $versionInfo->getTime()
        ]);
    });
});

// USER
Route::get('/v1/auth/refresh', 'UserController@refreshToken');
Route::post('/v1/auth/login', 'UserController@login');

Route::middleware(['before' => 'jwt.auth', 'after' => 'jwt.refresh'])->prefix('v1')->group(function() {
    Route::get('/auth/user', 'UserController@getUser');
    Route::get('/user', 'UserController@getUsers');
    Route::get('/role', 'UserController@getRoles');

    Route::post('/user', 'UserController@addUser');
    Route::post('/role', 'UserController@addRole');
    Route::post('/auth/logout', 'UserController@logout');

    Route::patch('/user/{id}/role', 'UserController@setRoles');
    Route::patch('/role/{id}/permission', 'UserController@setPermissions');

    Route::delete('/user/{id}', 'UserController@deleteUser')->where('id', '[0-9]+');
    Route::delete('/role/{id}', 'UserController@deleteRole')->where('id', '[0-9]+');
});

// TREE
Route::middleware(['before' => 'jwt.auth', 'after' => 'jwt.refresh'])->prefix('v1/tree')->group(function() {
    Route::get('/', 'TreeController@getTree');
    Route::get('/byParent/{id}', 'TreeController@getDescendants')->where('id', '[0-9]+');
    Route::get('/{id}', 'TreeController@getConcept')->where('id', '[0-9]+');
    Route::get('/languages', 'TreeController@getLanguages');
    Route::get('/{id}/export', 'TreeController@export')->where('id', '[0-9]+');
    Route::get('/export', 'TreeController@export');

    Route::put('/concept', 'TreeController@addConcept');
    Route::put('/label', 'TreeController@addLabel');
    Route::put('/note', 'TreeController@addNote');
    Route::put('/concept/{id}/broader/{bid}', 'TreeController@addBroader')->where('id', '[0-9]+')->where('bid', '[0-9]+');

    Route::delete('/concept/{id}', 'TreeController@deleteElementCascade')->where('id', '[0-9]+');
    Route::delete('/concept/{id}/move', 'TreeController@deleteElementOneUp')->where('id', '[0-9]+');
    Route::delete('/label/{id}', 'TreeController@deleteLabel')->where('id', '[0-9]+');
    Route::delete('/note/{id}', 'TreeController@deleteNote')->where('id', '[0-9]+');
    Route::delete('/concept/{id}/broader/{bid}', 'TreeController@removeBroader')->where('id', '[0-9]+')->where('bid', '[0-9]+');
});

// SEARCH
Route::middleware(['before' => 'jwt.auth', 'after' => 'jwt.refresh'])->prefix('v1/search')->group(function() {
    Route::get('/concept', 'SearchController@searchConcepts');
});