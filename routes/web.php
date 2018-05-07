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

/*
Route::get('/', function () {
    $author = DB::table('memes')->select('author');
    return view('home', ['author' => $author]);
});

*/



Auth::routes();

Route::get('/afterthrowing', ['uses' => 'SitesController@afterthrowing', 'as' => 'sites.afterthrowing']);

Route::get('/mainpage', ['uses' => 'HomeController@mainpage', 'as' => 'mainpage']);

Route::get('/' , ['uses' => 'HomeController@mainpage']);

Route::post('/likingonpage', ['uses' => 'LikingComments@likingonpage', 'as' => 'sites.likingonpage']);

Route::post('/afterreportingmethod', ['uses' => 'SitesController@afterreportingmethod', 'as' => 'sites.afterreportingmethod']);

Route::post('/dislikingonpage', ['uses' => 'LikingComments@dislikingonpage', 'as' => 'sites.dislikingonpage']);

Route::get('/page/{pageid}' , ['uses' => 'HomeController@page', 'as' => 'sites.page', 'pageid' => '{pageid}']);

Route::post('/previouspage', ['uses' => 'HomeController@previouspage', 'as' => 'sites.previouspage', 'pageid' => '{pageid}']);

Route::post('/nextpage', ['uses' => 'HomeController@nextpage', 'as' => 'sites.nextpage', 'pageid' => '{pageid}']);

Route::post('/dislikingcategory', ['uses' => 'LikingComments@dislikingcategory', 'as' => 'sites.dislikingcategory']);

Route::post('/likingcategory', ['uses' => 'LikingComments@likingcategory', 'as' => 'sites.likingcategory']);

Route::get('/category/{category}',  ['uses' => 'HomeController@categories', 'as' => 'sites.categories', 'category' => '{category}']);

Route::get('/category/{category}/#{id}' , ['as' => 'categoryliking', 'category' => '{category}', 'id' => '{id}']);

Route::post('/reportdeleting', ['uses' => 'SitesController@reportdeleting', 'as' => 'sites.reportdeleting',  'middleware' => 'admin']);

Route::post('/reportdeletingmem', ['uses' => 'SitesController@reportdeletingmem', 'as' => 'sites.reportdeletingmem', 'middleware' => 'admin']);

Route::get('/adminreports' , ['uses' => 'SitesController@adminreports', 'as' => 'sites.adminreports', 'middleware' => 'admin']);

Route::get('/adminsol', ['uses' => 'DebugController@adminsol', 'as' => 'sites.adminsol', 'middleware' => 'admin']);

Route::post('/reporting', ['uses' => 'SitesController@reporting', 'as' => 'sites.reportingmethod']);

Route::post('/report', ['uses' => 'SitesController@report', 'as' => 'sites.reporting']);

Route::get('/checkingmemes', ['uses' => 'SitesController@checkingmemes', 'as' => 'sites.checkingmemes', 'middleware' => 'admin']);

Route::post('/acceptmem', ['uses' => 'SitesController@acceptmem', 'as' => 'sites.acceptmem', 'middleware' => 'admin']);

Route::post('/declinemem', ['uses' => 'SitesController@declinemem', 'as' => 'sites.declinemem', 'middleware' => 'admin']);

Route::get('/#{id}' , ['uses' => 'HomeController@indexliking', 'as' => 'indexliking']);

Route::get('/throwing',['uses' => 'SitesController@throwing', 'as' => 'sites.throwing'])->middleware('auth');

Route::post('/throwsmoke', ['uses' => 'SitesController@throwsmoke', 'as' => 'sites.throwsmoke']);

Route::post('/liking', ['uses' => 'LikingComments@liking', 'as' => 'sites.liking']);

Route::post('/disliking', ['uses' => 'LikingComments@disliking', 'as' => 'sites.disliking']);

Route::post('/likingmem', ['uses' => 'LikingComments@likingmem', 'as' => 'sites.likingmem']);

Route::post('/dislikingmem', ['uses' => 'LikingComments@dislikingmem', 'as' => 'sites.dislikingmem']);

Route::get('/{id}' , ['uses' => 'HomeController@mem', 'as' => 'sites.mem', 'id' => '{id}']);

Route::post('/addcomment', ['uses' => 'LikingComments@addcomment', 'as' => 'sites.addcomment']);

Route::post('/commentdelete', ['uses' => 'LikingComments@commentdelete', 'as' => 'sites.commentdelete']);





//Route::get('/home', 'HomeController@index')->name('home');
