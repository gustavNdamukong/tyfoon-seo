<?php

use Illuminate\Support\Facades\Route;
use Gustocoder\TyfoonSeo\Http\Controllers\TyfoonSeoController;

Route::middleware('web')
    ->namespace('Gustocoder\TyfoonSeo\Http\Controllers')
    ->group(function () {
        //Global SEO
        Route::get('/add-global-seo', [TyfoonSeoController::class, 'addGlobal'])->name('add-global-seo');
        Route::post('/save-global-seo', [TyfoonSeoController::class, 'saveNewGlobal'])->name('save-global'); 
        Route::get('/view-global-seo/{recordId}', [TyfoonSeoController::class, 'viewGlobal'])->name('view-global-seo');
        Route::get('/edit-global-seo/{recordId}', [TyfoonSeoController::class, 'editGlobal'])->name('edit-global-seo');
        Route::post('/save-global-seo-edit', [TyfoonSeoController::class, 'saveGlobalSeoEdit'])->name('save-global-seo-edit');
        Route::post('/delete-global-seo', [TyfoonSeoController::class, 'deleteGlobal'])->name('delete-global-seo');

        //Pages SEO
        Route::get('/seo', [TyfoonSeoController::class, 'index'])->name('seo-home');
        Route::get('/seo/add-page', [TyfoonSeoController::class, 'addPage'])->name('add-page-seo');
        Route::post('/seo/save-page-seo', [TyfoonSeoController::class, 'savePageSeo'])->name('save-page-seo'); 
        Route::get('/view-page-seo/{pageId}', [TyfoonSeoController::class, 'viewPageSeo'])->name('view-page-seo');
        Route::get('/edit-page-seo/{pageId}', [TyfoonSeoController::class, 'editPageSeo'])->name('edit-page-seo');
        Route::post('/save-page-seo-edit', [TyfoonSeoController::class, 'savePageSeoEdit'])->name('save-page-seo-edit');
        Route::post('/delete-page-seo', [TyfoonSeoController::class, 'deletePageSeo'])->name('delete-page-seo');

        //ajax route 
        Route::post('/seo/check-page-name', [TyfoonSeoController::class, 'checkPageName'])->name('check-page-name');
    });

