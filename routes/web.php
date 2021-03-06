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
|--------------------------------------------------------------------------
| 1) 認証不要
|--------------------------------------------------------------------------
*/

// 最初の画面
Route::get('/', function () {
    return view('login');
})->name('login');

// ログイン
Route::get('login', function () {
    return view('login');
})->name('login');

// 会員登録
Route::get('signup', function () {
    return view('signup');
});
Route::get('signup/form', function () {
    return view('signupForm');
})->name('signup.form');
Route::post('signup/form', 'AuthController@signup')->name('signup');

// 認証ルート
Route::post('login', 'AuthController@login')->name('auth.login');
Route::post('signup', 'AuthController@signup')->name('auth.signup');

// OAuth
Route::get('login/{provider}', 'AuthController@redirectTo');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback');

/*
|--------------------------------------------------------------------------
| 2) User認可済み
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {

    // TOPページ
    Route::get('top', 'TopController@index')->name('top');
  
    //テスト
    Route::get('test/', 'TopController@test')->name('test');

    // ログアウト
    Route::get('logout', 'AuthController@logout')->name('logout');

    // MyPage 1.会員情報
    Route::get('mypage/', 'MyPageController@index')->name('mypage');
    Route::get('userinformation/', 'UserInformationController@index')->name('information');
    Route::put('mypage/update','MyPageController@update')->name('update');

    // Search 3.検索・購入
    Route::post('search/', 'SearchController@index')->name('search');
    Route::get('search/genre/{genre_id}', 'SearchController@genre')->name('search');
    Route::get('search/genre/more/{genre_id}', 'SearchController@genreMore')->name('search');
    Route::get('search/artist/{req_name}', 'SearchController@artist')->name('search');
    Route::get('search/artist_music/{req_id}', 'SearchController@artistMusic')->name('search');
    Route::get('search/music/{req_name}', 'SearchController@music')->name('search');
    Route::get('search/campaign/{campaign_name}', 'SearchController@campaign')->name('search');
    
  
    //ポイント購入
    Route::get('point/', 'PointController@index')->name('point');
    Route::post('point/charge', 'PointController@charge')->name('charge');

    // Music 4.music詳細
    Route::get('detail/music/{music_id}', 'MusicController@index')->name('music');
    Route::post('detail/music/buy_point', 'MusicController@musicBuyPoint')->name('music_buy_point');
    Route::post('detail/music/buy', 'MusicController@musicBuy')->name('music_buy');
    Route::get('music/rtmp', 'MusicController@rtmp')->name('rtmp');

    // Hunt 5.ハント
    Route::get('hunt/', 'HuntController@index')->name('hunt');
  
    //配信
    Route::get('streaming/', 'StreamingController@index')->name('streaming');

    // 音楽ライブラリ
    Route::get('library/', 'LibraryController@index')->name('library');
    Route::post('library/add', 'LibraryController@add');
    Route::post('library/playlist', 'LibraryController@playlist');

    // プレイリスト
    Route::get('playlist/{playlist_id}', 'PlaylistController@index')->name('playlist');

    // Report 6.通報
    Route::get('report/{user_id}', 'ReportController@index')->name('report');
    Route::post('report/store', 'ReportController@store')->name('report_store');


    // Admin 7.管理
    Route::prefix('admin')->namespace('Admin')->group(function () {
        // TOP
        Route::get('/', 'AdminController@index')->name('admin');
        // MAP
        Route::get('map', 'MapController@index')->name('map');
        //Product
        // music-upload
        Route::get('music_upload/','MusicUploadController@index')->name('music_upload');
        Route::post('music_upload/music_store','MusicUploadController@musicStore');
        Route::post('music_upload/genre_store','MusicUploadController@genreStore');
        Route::post('music_upload/artist_store','MusicUploadController@artistStore');
        // sales
        Route::get('sales/','SalesController@index')->name('sales');
        // Campagin
        Route::get('price', 'PriceController@index')->name('price');
        Route::get('price/sales/artist/{artist_id}', 'PriceController@salesArtist')->name('price_artist');
        Route::get('price/sales/music/{music_id}', 'PriceController@salesMusic')->name('price_music');
        Route::post('price/artist','PriceController@artist');
        Route::post('price/music','PriceController@music');
        Route::get('collaboration', 'CollaborationController@index')->name('collaboration');
        // Users Management
        Route::get('management', 'ManagementController@index')->name('management');

        Route::get('report', 'ReportController@index')->name('report');
        Route::get('report/show/{user_id}/{category_id}', 'ReportController@show');
        Route::get('report/delete/{user_id}', 'ReportController@softdelete');

        Route::get('suspension', 'SuspensionController@index')->name('suspension');
        Route::get('suspension/restore/{user_id}', 'SuspensionController@restore');

        Route::get('information', 'InformationController@index')->name('information');
        Route::get('information/send/{user_id}', 'InformationController@send');
        Route::post('information/store', 'InformationController@store')->name('information_store');
        // Aws test
        Route::get('aws_test','AwsTestController@index')->name('aws_test');
    });

});

/*
|--------------------------------------------------------------------------
| 3) Admin認可済み 予定
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'admin'], function () {

});