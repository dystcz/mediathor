<?php

declare(strict_types=1);

use Dystcz\MediaThor\Domain\Files\Http\Controllers\UploadController;
use Dystcz\MediaThor\Domain\Media\Http\Controllers\MediaDownloadController;
use Dystcz\MediaThor\Domain\Media\Http\Controllers\MediaPreviewController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

// Media
Route::group([
    'prefix' => Config::get('mediathor.media.routes.prefix', 'media'),
    'middlware' => Config::get('mediathor.media.routes.middleware', []),
    'without_middleware' => Config::get('mediathor.media.routes.without_middleware', []),
], function () {
    Route::post('/download', MediaDownloadController::class);
    Route::post('/preview', MediaPreviewController::class);

    // Files
    Route::group([
        'prefix' => Config::get('mediathor.media.files.routes.prefix', 'files'),
        'middlware' => Config::get('mediathor.files.routes.middleware', []),
        'without_middleware' => Config::get('mediathor.media.files.routes.without_middleware', []),
    ], function () {
        Route::post('/upload', [UploadController::class, 'store']);
        Route::delete('/delete', [UploadController::class, 'destroy']);
    });

    // Images
    Route::group([
        'prefix' => Config::get('mediathor.media.images.routes.prefix', 'images'),
        'middlware' => Config::get('mediathor.media.images.routes.middleware', []),
        'without_middleware' => Config::get('mediathor.media.images.routes.without_middleware', []),
    ], function () {
        //
    });
});
