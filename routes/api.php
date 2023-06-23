<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\FilepondController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('user')->group(function () {
    Route::get('getUserJson',  [ApiController::class, 'getUserJson'])->name('api.getUserJson');
    Route::get('getUserCategoriesJson',  [ApiController::class, 'getUserCategoriesJson'])->name('api.getUserCategoriesJson');
    Route::get('getUserJsonByEmail',  [ApiController::class, 'getUserJsonByEmail'])->name('api.getUserJsonByEmail');
    Route::post('update',  [ApiController::class, 'update'])->name('api.update');
    Route::post('update_publicity',  [ApiController::class, 'update_publicity'])->name('api.update_publicity');
    Route::post('upload',  [ApiController::class, 'upload'])->name('api.upload');
    Route::post('uploadJson',  [ApiController::class, 'uploadJson'])->name('api.uploadJson');
});

Route::get('public_dashboard/{id}', [ApiController::class, 'public_dashboard'])->name('api.public_dashboard');



Route::post('filepond/process', [FilepondController::class, 'process']);
Route::delete('filepond/revert', [FilepondController::class, 'revert']);
Route::get('get_certificates', [ApiController::class, 'get_certificates'])->name('api.get_certificates');



Route::post('add_category_to_user', [ApiController::class, 'add_category_to_user'])->name('api.add_category_to_user');
Route::post('update_certificate', [ApiController::class, 'update_certificate'])->name('api.update_certificate');
Route::post('delete_category', [ApiController::class, 'delete_category'])->name('api.delete_category');

Route::any('trust_user', [ApiController::class, 'trust_user'])->name('api.trust_user');
Route::any('untrust_user', [ApiController::class, 'untrust_user'])->name('api.untrust_user');



Route::post('/search_corporation', [ApiController::class, 'search_corporation'])->name('api.search_corporation');
