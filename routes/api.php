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

Route::post('/get-questions', [
    'as'   => 'api.questions',
    'uses' => 'ApiController@getQuestions',
]);

Route::post('/submit-answer', [
    'as'   => 'api.submitAnswer',
    'uses' => 'ApiController@submitAnswer',
]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [
    'as'   => 'auth.login',
    'uses' => 'AuthenticateController@login',
]);

Route::get('/test-token', [
    'as'   => 'auth.test',
    'uses' => 'AuthenticateController@test',
]);

// Route::middleware('jwt.auth')->get('/tt', function (Request $request) {
//     dd($request->user());
// });

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::get('/aaa', function (Request $request) {
        dd($request->user());
    });

});

Route::group(['middleware' => 'jwt.refresh'], function () {

    Route::get('/refresh', function (Request $request) {
        return response(JWTAuth::getToken());
    });
});

// Route::group(['middleware' => 'jwt.refresh'], function () {
//     Route::get('/refresh', function(Request $request){
//         return JWTAuth::getToken();
//     });
// });

// Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2xvcmktYmFjay5pY29sZG8uY29tXC9wdWJsaWNcL2FwaVwvbG9naW4iLCJpYXQiOjE0OTQ1MDc5MzcsImV4cCI6MTQ5NDUxMTUzNywibmJmIjoxNDk0NTA3OTM3LCJqdGkiOiJldllRbm9KTVNuRGtDNzUxIn0.hLrpumRnbDxlMyEH3ec3V0wX5H5t3NKXgyAF-KffPGA

// Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2xvcmktYmFjay5pY29sZG8uY29tXC9wdWJsaWNcL2FwaVwvbG9naW4iLCJpYXQiOjE0OTQ1MDc5MzcsImV4cCI6MTQ5NDUxMTUzNywibmJmIjoxNDk0NTA3OTM3LCJqdGkiOiJldllRbm9KTVNuRGtDNzUxIn0.oTzeAg2TvIA37suTrYxlb9kXIZoUo0RFDCxiDrqF-54

// // Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2xvcmktYmFjay5pY29sZG8uY29tXC9wdWJsaWNcL2FwaVwvbG9naW4iLCJpYXQiOjE0OTQ1MDkwMDUsImV4cCI6MTQ5NDUxMjYwNSwibmJmIjoxNDk0NTA5MDA1LCJqdGkiOiIzU0ZyeTRMQ3F1T2puODdSIn0.oTzeAg2TvIA37suTrYxlb9kXIZoUo0RFDCxiDrqF-54
