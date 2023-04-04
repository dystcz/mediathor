<?php

declare(strict_types=1);

use Dystcz\Mediathor\Domain\Files\Http\Controllers\UploadController;
use Dystcz\Mediathor\Domain\Media\Http\Controllers\MediaDownloadController;
use Dystcz\Mediathor\Domain\Media\Http\Controllers\MediaPreviewController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

// Media
Route::group([
    'prefix' => Config::get('mediathor.media.route_prefix', 'media'),
    'middlware' => Config::get('mediathor.media.middleware', []),
    'without_middleware' => Config::get('mediathor.media.without_middleware', []),
], function () {
    Route::post('/download', MediaDownloadController::class);
    Route::post('/preview', MediaPreviewController::class);

    // Files
    Route::group([
        'prefix' => Config::get('mediathor.media.files.route_prefix', 'files'),
        'middlware' => Config::get('mediathor.media.files.middleware', []),
        'without_middleware' => Config::get('mediathor.media.files.without_middleware', []),
    ], function () {
        Route::post('/upload', [UploadController::class, 'store']);
        Route::delete('/delete', [UploadController::class, 'destroy']);
    });

    // Images
    Route::group([
        'prefix' => Config::get('mediathor.media.images.route_prefix', 'images'),
        'middlware' => Config::get('mediathor.media.images.middleware', []),
        'without_middleware' => Config::get('mediathor.media.images.without_middleware', []),
    ], function () {
        //
    });
});
