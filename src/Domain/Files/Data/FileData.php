<?php

declare(strict_types=1);

namespace Dystcz\MediaThor\Domain\Files\Data;

use Illuminate\Contracts\Support\Arrayable;

class FileData implements Arrayable
{
    public function __construct(
        public string|int $id,
        public string $serverId,
        public string $fileName,
        public bool $uploaded,
        public ?int $order = null,
    ) {
    }

    /**
     * Cast to array.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'fileName' => $this->fileName,
            'serverId' => $this->serverId,
            'uploaded' => $this->uploaded,
            'order' => $this->order,
        ];
    }
}
