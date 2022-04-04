<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/loginpage');
});

Route::get('/loginpage','AdminController@adminlogin');
Route::post('/islogin','AdminController@adminloged');
Route::group(['middleware'=>['customAuth']],function(){



Route::get('/logout',function(){
	session()->forget('data');
	return redirect('/loginpage');
});

	
	Route::post('/student/courses','StudentController@courses');// for Ajax
	Route::get('/studentdetails-ajax','StudentController@ajax_show');// for ajax show
	Route::get('/studentregisterform','StudentController@create');
	Route::post('/studentstore','StudentController@store');
	Route::get('/studentdetails','StudentController@show');
	Route::get('/studentdetails2','StudentController@show');
	Route::get('/single-student','StudentController@single_student')->name('single.student');


	Route::get('/student_edit/{id}','StudentController@edit')->name('student.edit');
	Route::post('/student_update/{id}',['as'=>'student.update','uses'=>'StudentController@update']);
	Route::get('/student_delete/{id}',['as'=>'student.delete','uses'=>'StudentController@destroy']);

	Route::get('/addbranch','BranchController@create');
	Route::post('/branchstore','BranchController@store');
	Route::get('/branchshow','BranchController@show');

	Route::get('/branch_edit/{id}',['as'=>'branch.edit','uses'=>'BranchController@edit']);
	Route::post('/branch_update/{id}',['as'=>'branch.update','uses'=>'BranchController@update']);
	Route::get('/branch_delete/{id}',['as'=>'branch.delete','uses'=>'BranchController@destroy']);

	Route::get('/addcourse','CourseController@create');
	Route::post('/coursestore','CourseController@store');
	Route::get('/courseshow','CourseController@show');

	Route::get('/course_edit/{id}',['as'=>'course.edit','uses'=>'CourseController@edit']);
	Route::post('/course_update/{id}',['as'=>'course.update','uses'=>'CourseController@update']);
	Route::get('/course_delete/{id}',['as'=>'course.delete','uses'=>'CourseController@destroy']);
});

