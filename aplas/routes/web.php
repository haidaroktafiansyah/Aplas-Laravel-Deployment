<?php

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
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'admin']], function() {
  Route::get('/admin', 'AdminController@index');
  Route::resource('/admin/topics', 'TopicController');
  Route::resource('/admin/tasks', 'TaskController');
  Route::resource('/admin/learning', 'LearningFileController');
  Route::resource('/admin/resources', 'ResourcesController');
  Route::resource('/admin/testfiles', 'TestFilesController');
  Route::get('/admin/testfiles/create/{topic}', 'TestFilesController@create');
  Route::resource('/admin/assignteacher', 'AssignTeacherController');
  Route::resource('/admin/assignteacher/index', 'AssignTeacherController@index');
	Route::resource('/admin/tmember', 'TeacherClassMemberController');
  Route::resource('/admin/studentres', 'StudentValidController');
  Route::get('/admin/studentres/{student}/{id}', 'StudentValidController@showteacher');
  Route::get('/admin/uploadsrc/{student}/{id}', 'StudentValidController@showsource');

  Route::resource('/admin/resview', 'StudentResultViewController');
 Route::resource('/admin/rankview', 'StudentResultRankController');
Route::resource('/admin/completeness', 'StudentCompletenessController');

});

Route::group(['middleware' => ['auth', 'teacher']], function() {
  Route::get('/teacher', 'TeacherController@index');
  Route::resource('/teacher/assignstudent', 'AssignStudentController');
  Route::resource('/teacher/member', 'StudentMemberController');
  Route::resource('/teacher/studentres', 'StudentValidController');
  Route::resource('/teacher/crooms', 'ClassroomController');
  Route::get('/teacher/studentres/{student}/{id}', 'StudentValidController@showteacher');
	Route::get('/teacher/uploadsrc/{student}/{id}', 'StudentValidController@showsource');
 Route::resource('/teacher/rankview', 'StudentResultRankController');
Route::resource('/teacher/jplasdown', 'JplasDownloadController');
Route::resource('/teacher/completeness', 'StudentCompletenessController');
Route::get('/teacher/studentres/{student}/{id}', 'StudentValidController@showteacher');
Route::get('/teacher/studentdet/{student}', 'StudentMemberController@edit');
});

Route::group(['middleware' => ['auth', 'student']], function() {
  Route::get('/student', 'StudentController@index');
  Route::resource('/student/tasks', 'TaskController');
  Route::resource('/student/results', 'TaskResultController');
  Route::get('student/results/create/{topic}', 'TaskResultController@create');
  Route::resource('/student/lfiles', 'FileResultController');
  Route::get('student/lfiles/create/{topic}', 'FileResultController@create');
  Route::get('student/lfiles/valid/{topic}', 'FileResultController@submit');
 Route::resource('/student/rankview', 'StudentResultRankController');
  Route::resource('/student/valid', 'StudentValidController');
  Route::resource('/student/rankview', 'StudentResultRankController');
Route::resource('/student/jplasdown', 'JplasDownloadController');

});

Route::middleware(['auth'])->group(function () {
    Route::get('download/guide/{file}/{topic}', 'DownloadController@downGuide')->name('file-download');
    Route::get('download/test/{file}/{topic}', 'DownloadController@downTest')->name('file-download');
    Route::get('download/supp/{file}/{topic}', 'DownloadController@downSupplement')->name('file-download');
    Route::get('download/other/{file}/{topic}', 'DownloadController@downOther')->name('file-download');
Route::get('download/jpack/{file}/{topic}', 'DownloadController@downJplasPackage')->name('file-download');
Route::get('download/jguide/{file}/{topic}', 'DownloadController@downJplasGuide')->name('file-download');
Route::get('download/jresult/{file}/{topic}', 'DownloadController@downJplasResult')->name('file-download');


});

Auth::routes();
//Route::get('register', 'Auth\RegisterController@index')->name('register');
//Route::get('register', 'Auth\RegisterController@register');

Route::get('/home', 'HomeController@index')->name('home');
