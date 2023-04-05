<?php

declare(strict_types=1);

namespace Domain\Media\Http\Controllers;

use Dystcz\MediaThor\Domain\Base\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    /**
     * Delete media.
     */
    public function __invoke(Media $media): JsonResource
    {
        $media->delete();

        return new JsonResource(
            ['message' => 'Soubor byl smazán.'],
        );
    }
}
