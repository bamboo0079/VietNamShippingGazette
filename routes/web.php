<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
if(env('APP_ENV') === 'production'){
//    \URL::forceScheme('https');
}

Auth::routes();

Route::namespace('Backend')->prefix('admin')->group(function () {
    Route::get('/login', 'AuthController@getLogin')->name('admin.login');
    Route::post('/login', 'AuthController@postLogin')->name('admin.login.post');
    Route::any('/logout', 'AuthController@logout')->name('admin.logout');
    Route::any('/upload-file', 'UploadsController@index')->name('upload.file');
});

Route::middleware(['front'])->namespace('Frontend')->group(function () {
//    Route::get('/privacy-policy', 'HomeController@policy')->name('policy');
    Route::any('/', 'HomeController@index')->name('home');
    Route::any('/tin-tuc/{id?}', 'HomeController@detail')->name('tin.tuc');
    Route::any('/lich-tau', 'HomeController@schedule')->name('lich.tau');
    Route::any('/the-loai/{id?}', 'HomeController@category')->name('the.loai');
    Route::any('/loai-san-pham/{id?}', 'HomeController@productCategory')->name('loai.san.pham');
    Route::any('/lien-he', 'HomeController@contact')->name('contact');
    Route::any('/my-page', 'HomeController@chaomua')->name('chaomua');
    Route::any('/reset-password', 'HomeController@resetPassword')->name('reset');
    Route::any('/dang-ky', 'HomeController@register')->name('register');
    Route::any('/dang-nhap', 'HomeController@login')->name('login');
    Route::any('/dang-xuat', 'HomeController@logout')->name('logout');
    Route::any('/language/{lang?}', 'HomeController@language')->name('change.language');
});

/*Route::middleware(['front'])->namespace('Frontend')->group(function () {
    Route::any('/', 'HomeController@index')->name('home');
    Route::any('/san-pham/{id?}', 'HomeController@index')->name('san.pham');
    Route::any('/loai-san-pham/{id?}', 'HomeController@category')->name('loai.san.pham');
    Route::any('/ajax-get-chapter/{book_id?}', 'HomeController@ajaxChapterByBook')->name('ajax.chapter');
    Route::any('/settings', 'HomeController@settings')->name('settings');
    Route::get('/notify', 'HomeController@notify')->name('notify');
    Route::any('/language/{lang?}', 'HomeController@language')->name('change.language');
});*/

// Route BackEnd
Route::middleware(['admin', 'web'])->namespace('Backend')->prefix('admin')->group(function () {
    Route::get('/', 'MembersController@index')->name('admin.dashboard');
    Route::get('/member', 'MembersController@member')->name('admin.member');

    // Member Route
    Route::any('/add-user/{id?}', 'MembersController@addUser')->name('admin.user.add');
    Route::any('/process-user/{id?}', 'MembersController@processUser')->name('admin.user.process');
    Route::any('/user-detail/{id?}', 'MembersController@userDetail')->name('admin.user.detail');
    Route::any('/user-delete/{id?}', 'MembersController@delete')->name('admin.user.delete');

    // Member Route
    Route::any('/add-member/{id?}', 'MembersController@addMember')->name('admin.member.add');
    Route::any('/process-member/{id?}', 'MembersController@processMember')->name('admin.member.process');
    Route::any('/member-detail/{id?}', 'MembersController@memberDetail')->name('admin.member.detail');
    Route::any('/member-delete/{id?}', 'MembersController@memberDelete')->name('admin.member.delete');

    // Book Route
    Route::get('/books', 'BooksController@index')->name('admin.book');
    Route::any('/add-book/{id?}', 'BooksController@add')->name('admin.book.add');
    Route::any('/process-book/{id?}', 'BooksController@process')->name('admin.book.process');
    Route::any('/book-detail/{id?}', 'BooksController@detail')->name('admin.book.detail');

    // Chapter Route
    Route::get('/chapters', 'ChaptersController@index')->name('admin.chapter');
    Route::any('/add-chapter/{id?}', 'ChaptersController@add')->name('admin.chapter.add');
    Route::any('/process-chapter/{id?}', 'ChaptersController@process')->name('admin.chapter.process');
    Route::any('/chapter-detail/{id?}', 'ChaptersController@detail')->name('admin.chapter.detail');
    Route::any('/chapter-summary/{id?}', 'ChaptersController@summary')->name('admin.chapter.summary');
    Route::any('/chapter-truncate', 'ChaptersController@truncate')->name('admin.chapter.truncate');

    // Audio Route
    Route::get('/audios', 'AudiosController@index')->name('admin.audio');
    Route::any('/add-audio/{id?}', 'AudiosController@add')->name('admin.audio.add');
    Route::any('/process-audio/{id?}', 'AudiosController@process')->name('admin.audio.process');
    Route::any('/audio-detail/{id?}', 'AudiosController@detail')->name('admin.audio.detail');
    Route::any('/audio-truncate', 'AudiosController@truncate')->name('admin.audio.truncate');
    Route::any('/add-audio-step/{id?}/{job_id?}', 'AudiosController@addStep')->name('admin.audio.add.step');
    Route::any('/process-audio-step/{id?}', 'AudiosController@processStep')->name('admin.audio.process.step');
    Route::any('/scanqr', 'AudiosController@scanqr')->name('admin.audio.scanqr');

    // Notify Route
    Route::get('/news', 'NewsController@index')->name('admin.news');
    Route::any('/add-new/{id?}', 'NewsController@add')->name('admin.new.add');
    Route::any('/add-product-new/{id?}', 'NewsController@addProduct')->name('admin.product.new.add');
    Route::any('/process-new/{id?}', 'NewsController@process')->name('admin.new.process');
    Route::any('/process-product-new/{id?}', 'NewsController@processProduct')->name('admin.product.new.process');
    Route::any('/new-detail/{id?}', 'NewsController@detail')->name('admin.new.detail');
    Route::any('/product-new-detail/{id?}', 'NewsController@detailProduct')->name('admin.product.new.detail');
    Route::any('/new-delete/{id?}', 'NewsController@delete')->name('admin.new.delete');

    // Notify Route
    Route::get('/app-news', 'AppNewsController@index')->name('admin.app.news');
    Route::any('/add-app-new/{id?}', 'AppNewsController@add')->name('admin.app.new.add');
    Route::any('/process-app-new/{id?}', 'AppNewsController@process')->name('admin.app.new.process');
    Route::any('/app-new-detail/{id?}', 'AppNewsController@detail')->name('admin.app.new.detail');
    Route::any('/app-new-delete/{id?}', 'AppNewsController@delete')->name('admin.app.new.delete');

    Route::get('/vsg-news', 'VSGNewsController@index')->name('admin.vsg.news');
    Route::any('/add-vsg-new/{id?}', 'VSGNewsController@add')->name('admin.vsg.new.add');
    Route::any('/process-vsg-new/{id?}', 'VSGNewsController@process')->name('admin.vsg.new.process');
    Route::any('/vsg-new-detail/{id?}', 'VSGNewsController@detail')->name('admin.vsg.new.detail');
    Route::any('/vsg-new-delete/{id?}', 'VSGNewsController@delete')->name('admin.vsg.new.delete');

    Route::get('/recruit-news', 'RecruitNewsController@index')->name('admin.recruit.news');
    Route::any('/add-recruit-new/{id?}', 'RecruitNewsController@add')->name('admin.recruit.new.add');
    Route::any('/process-recruit-new/{id?}', 'RecruitNewsController@process')->name('admin.recruit.new.process');
    Route::any('/recruit-new-detail/{id?}', 'RecruitNewsController@detail')->name('admin.recruit.new.detail');
    Route::any('/recruit-new-delete/{id?}', 'RecruitNewsController@delete')->name('admin.recruit.new.delete');

    // Audio Route
    Route::get('/comments', 'CommentsController@index')->name('admin.comment');
    Route::any('/add-comment/{id?}', 'CommentsController@add')->name('admin.comment.add');
    Route::any('/process-comment/{id?}', 'CommentsController@process')->name('admin.comment.process');
    Route::any('/comment-detail/{id?}', 'CommentsController@detail')->name('admin.comment.detail');
    Route::any('/ajax-admin-get-chapter/{book_id?}', 'ChaptersController@ajaxChapterByBook')->name('ajax.chapter.book');

    // kho hang
    Route::get('/wherehouses', 'WherehousesController@index')->name('admin.wherehouse');
    Route::any('/add-wherehouses/{id?}', 'WherehousesController@add')->name('admin.wherehouse.add');
    Route::any('/process-wherehouses/{id?}', 'WherehousesController@process')->name('admin.wherehouse.process');
    Route::any('/wherehouses-detail/{id?}', 'WherehousesController@detail')->name('admin.wherehouse.detail');
    Route::any('/wherehouses-truncate', 'WherehousesController@truncate')->name('admin.wherehouse.truncate');
    Route::any('/add-wherehouses-step/{id?}', 'WherehousesController@addStep')->name('admin.wherehouse.add.step');
    Route::any('/process-wherehouses-step/{id?}', 'WherehousesController@processStep')->name('admin.wherehouse.process.step');

    // Categories
    Route::get('/categories', 'CategoriesController@index')->name('admin.category');
    Route::any('/add-category/{id?}', 'CategoriesController@add')->name('admin.category.add');
    Route::any('/delete-category/{delete?}', 'CategoriesController@delete')->name('admin.category.delete');
    Route::any('/process-category/{id?}', 'CategoriesController@process')->name('admin.category.process');

    // agents
    Route::get('/agents', 'AgentsController@index')->name('admin.agents');
    Route::any('/add-agent/{id?}', 'AgentsController@add')->name('admin.agent.add');
    Route::any('/delete-agent/{delete?}', 'AgentsController@delete')->name('admin.agent.delete');
    Route::any('/process-agent/{id?}', 'AgentsController@process')->name('admin.agent.process');

    // ships
    Route::get('/ships', 'ShipsController@index')->name('admin.ships');
    Route::any('/add-ship/{id?}', 'ShipsController@add')->name('admin.ship.add');
    Route::any('/delete-ship/{id?}', 'ShipsController@delete')->name('admin.ship.delete');
    Route::any('/process-ship/{id?}', 'ShipsController@process')->name('admin.ship.process');

    // ports
    Route::get('/ports', 'PortsController@index')->name('admin.ports');
    Route::any('/add-port/{id?}', 'PortsController@add')->name('admin.port.add');
    Route::any('/delete-port/{delete?}', 'PortsController@delete')->name('admin.port.delete');
    Route::any('/process-port/{id?}', 'PortsController@process')->name('admin.port.process');

    // countries
    Route::get('/countries', 'CountriesController@index')->name('admin.countries');
    Route::any('/add-country/{id?}', 'CountriesController@add')->name('admin.country.add');
    Route::any('/delete-country/{delete?}', 'CountriesController@delete')->name('admin.country.delete');
    Route::any('/process-country/{id?}', 'CountriesController@process')->name('admin.country.process');

    // countries
    Route::get('/scenarios', 'ScenariosController@index')->name('admin.scenarios');
    Route::any('/add-scenario/{id?}', 'ScenariosController@add')->name('admin.scenario.add');
    Route::any('/process-scenario/{id?}', 'ScenariosController@process')->name('admin.scenario.process');
    Route::any('/delete-scenario/{delete?}', 'ScenariosController@delete')->name('admin.scenario.delete');

    // product Categories
    Route::get('/products', 'NewsController@products')->name('admin.new.product');
    Route::get('/product-types', 'CategoriesController@productTypes')->name('admin.product.type');
    Route::any('/add-product-type/{id?}', 'CategoriesController@addProductType')->name('admin.add.product.type');
    Route::any('/delete-product-type/{id?}', 'CategoriesController@deleteProductType')->name('admin.delete.product.type');
    Route::any('/process-product-type/{id?}', 'CategoriesController@processProductType')->name('admin.process.product.type');

    Route::any('/how-to-use', 'DashboardController@howToUse')->name('admin.how.to.use');
    Route::any('/lang/{lang?}', 'DashboardController@language')->name('language');

    Route::get('/partners', 'PartnersController@index')->name('admin.partners');
    Route::any('/add-partner/{id?}', 'PartnersController@add')->name('admin.partner.add');
    Route::any('/delete-partner/{id?}', 'PartnersController@delete')->name('admin.partner.delete');
    Route::any('/process-partner/{id?}', 'PartnersController@process')->name('admin.partner.process');
    Route::any('/partner-detail/{id?}', 'PartnersController@detail')->name('admin.partner.detail');

    Route::get('/supports', 'SupportsController@index')->name('admin.supports');
    Route::any('/add-support/{id?}', 'SupportsController@add')->name('admin.support.add');
    Route::any('/process-support/{id?}', 'SupportsController@process')->name('admin.support.process');
    Route::any('/support-detail/{id?}', 'SupportsController@detail')->name('admin.support.detail');

    Route::get('/contacts', 'ContactsController@index')->name('admin.contacts');
    Route::any('/contact-detail/{id?}', 'ContactsController@detail')->name('admin.contact.detail');

    Route::any('/newest-detail', 'PartnersController@newesetDetail')->name('admin.newest.detail');

    Route::get('export', 'ScenariosController@export')->name('export');
    //ROUTES
});