<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::auth();

Route::group([

    'middleware' => 'auth',
], function () {

    Route::get('/home', 'HomeController@index');

    Route::get('/userslist', 'UsersListController@index')->name('user.list');

    Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'UsersListController@getByID']);
    Route::post('/edit/{id}', ['as' => 'edit', 'uses' => 'UsersListController@updateUserByID']);

    Route::get('/newproblem', 'ProblemController@getForm');
    Route::post('/newproblem', 'ProblemController@createProblem');

    Route::get('/problemslist', 'ProblemController@index');
    Route::get('/myproblems', 'ProblemController@getTechnicDevices');

    Route::post('/take/{id}', ['as' => 'take', 'uses' => 'ProblemController@takeDevice']);

    Route::get('/editproblem/{id}', ['as' => 'editproblem', 'uses' => 'ProblemController@getProblemByID']);
    Route::post('/editproblem/{id}', ['as' => 'editproblem', 'uses' => 'ProblemController@updateProblem']);

    Route::get('/solvedproblems', 'ProblemController@getSolvedProblems');

    Route::get('/newreport/{id}', ['as' => 'newreport', 'uses' => 'ProblemController@getProblemForReport']);
    Route::post('/newreport', 'ReportController@addReport');

    Route::get('/prepareworkingreport', 'ReportController@getWorkerReportForm');
    Route::post('/prepareworkingreport', 'ReportController@addWorkerReport');

    Route::get('/getreport', 'ReportController@getReportFormAdmin');
    Route::post('/getreport', 'ReportController@getReportsFromDB');

    Route::get('/concretedevicereport/{id}', ['as' => 'concretedevicereport', 'uses' => 'ReportController@getDeviceReportByID']);

    Route::get('/userprofile/{id}', ['as' => 'userprofile', 'uses' => 'ReportController@getDeviceReportByID']);
});
