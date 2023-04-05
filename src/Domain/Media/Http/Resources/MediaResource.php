<?php

declare(strict_types=1);

namespace Dystcz\MediaThor\Domain\Media\Http\Resources;

use Dystcz\MediaThor\Domain\Media\Models\Media;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Media $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'path' => $model->getPath(),
            'url' => $model->getUrl(),
            'file_name' => $model->file_name,
            'mime_type' => $model->mime_type,
            'size' => $model->size,
            'collection_name' => $model->collection_name,
            'order' => $model->order_column,
            'custom_properties' => $model->custom_properties,
        ];
    }
}
