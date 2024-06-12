<?php

use Illuminate\Support\Facades\Route;
use Gustocoder\TyfoonSeo\Http\Controllers\TyfoonSeoController;

Route::middleware('web')
    ->namespace('Gustocoder\TyfoonSeo\Http\Controllers')
    ->group(function () {
        //Global SEO
        Route::get('/add-global-seo', [TyfoonSeoController::class, 'addGlobal'])->name('add-global-seo'); //-----------------------DONE
        Route::post('/save-global-seo', [TyfoonSeoController::class, 'saveNewGlobal'])->name('save-global'); //--------------------DONE
        Route::get('/view-global-seo/{recordId}', [TyfoonSeoController::class, 'viewGlobal'])->name('view-global-seo'); //---------DONE
        Route::get('/edit-global-seo/{recordId}', [TyfoonSeoController::class, 'editGlobal'])->name('edit-global-seo'); //---------DONE
        Route::post('/save-global-seo-edit', [TyfoonSeoController::class, 'saveGlobalSeoEdit'])->name('save-global-seo-edit'); //--DONE
        Route::post('/delete-global-seo', [TyfoonSeoController::class, 'deleteGlobal'])->name('delete-global-seo'); //-------------DONE

        //Pages SEO
        Route::get('/seo', [TyfoonSeoController::class, 'index'])->name('seo-home'); //--------------------------------------------DONE
        Route::get('/seo/add-page', [TyfoonSeoController::class, 'addPage'])->name('add-page-seo'); //-----------------------------DONE
        Route::post('/seo/save-page-seo', [TyfoonSeoController::class, 'savePageSeo'])->name('save-page-seo'); //------------------DONE 
        Route::get('/view-page-seo/{pageId}', [TyfoonSeoController::class, 'viewPageSeo'])->name('view-page-seo'); //--------------DONE
        Route::get('/edit-page-seo/{pageId}', [TyfoonSeoController::class, 'editPageSeo'])->name('edit-page-seo'); //--------------DONE
        Route::post('/save-page-seo-edit', [TyfoonSeoController::class, 'savePageSeoEdit'])->name('save-page-seo-edit'); //--------DONE
        Route::post('/delete-page-seo', [TyfoonSeoController::class, 'deletePageSeo'])->name('delete-page-seo'); //----------------DONE

        //ajax route 
        Route::post('/seo/check-page-name', [TyfoonSeoController::class, 'checkPageName'])->name('check-page-name'); //------------DONE
    });

