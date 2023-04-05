<?php

declare(strict_types=1);

namespace Dystcz\MediaThor\Domain\Media\Http\Controllers;

use Dystcz\MediaThor\Domain\Base\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaPreviewController extends Controller
{
    /**
     * Preview media.
     *
     * @throws ValidationException
     */
    public function __invoke(Request $request, Media $media): JsonResource|StreamedResponse
    {
        return $media->toResponse($request);
    }
}
