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

Route::group(['middleware' => ['web']] , function(){
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/signup', [
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);
Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::get('/dashboard', [
    'uses' => 'SocialPostController@getDashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
    
]);

Route::post('/createpost', [
    'uses' => 'SocialPostController@postCreatePost',
    'as' => 'post.create',
    'middleware' => 'auth'
   
]);

Route::get('/delete-post/{post_id}', [
    'uses' => 'SocialPostController@getDeletePost',
    'as' => 'post.delete',
    'middleware' => 'auth'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'logout'
]);

Route::post('/edit', [
    'uses' => 'SocialPostController@postEditPost',
    'as' => 'edit'
]);

Route::get('/account', [
    'uses' => 'UserController@getAccount',
    'as' => 'account'
]);

Route::post('/upateaccount', [
    'uses' => 'UserController@postSaveAccount',
    'as' => 'account.save'
]);

Route::get('/userimage/{filename}', [
    'uses' => 'UserController@getUserImage',
    'as' => 'account.image'
]);

Route::post('/like', [
    'uses' => 'SocialPostController@postLikePost',
    'as' => 'like'
]);

/*Route::post('/toggle', [
    'uses' => 'SocialPostController@postLikePost',
    'as' => 'toggle'
]);
*/
/*Route::get('/user', [
    'uses' => 'UserController@toggle',
    'as' => 'user'
]);
*/

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user','UserController@users');
Route::post('/toggle','UserController@toggle');
