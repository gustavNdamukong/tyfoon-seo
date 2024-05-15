<?php

use Illuminate\Support\Facades\Route;
use Gustocoder\TyfoonSeo\Http\Controllers\TyfoonSeoController;


Route::get('/seo', [TyfoonSeoController::class, 'index'])->name('seo-home');
Route::get('/seo/{pageId}', [TyfoonSeoController::class, 'pageDetail'])->name('page-detail');
//add a page
Route::post('/seo/add-page', [TyfoonSeoController::class, 'addPage'])->name('add-page-seo');
//edit a page
Route::post('/seo/edit{pageId}', [TyfoonSeoController::class, 'editPageSeo'])->name('edit-page-seo');
//delete page
Route::post('/seo/delete{pageId}', [TyfoonSeoController::class, 'deletePageSeo'])->name('delete-page-seo');


//Global SEO
Route::get('/seo-global', [TyfoonSeoController::class, 'getGlobalSeoData'])->name('global-seo-data');
Route::get('/add-global-seo', [TyfoonSeoController::class, 'addGlobal'])->name('add-global-seo');
Route::get('/edit-gloal-seo/{recordId}', [TyfoonSeoController::class, 'globalDetail'])->name('edit-gloal-seo');
Route::post('/delete-gloal-seo/{recordId}', [TyfoonSeoController::class, 'deleteGlobal'])->name('delete-gloal-seo');

/*Route::get('/users', [ExampleController::class, 'showUsers'])->name('show-users');

Route::get('/deleteUser/{userId}', [ExampleController::class, 'deleteUser'])->name('delete-user');*/

