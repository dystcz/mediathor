<?php

declare(strict_types=1);

namespace Dystcz\MediaThor\Domain\Files\Data;

use Illuminate\Contracts\Support\Arrayable;

class UploadData implements Arrayable
{
    public array $files = [];

    public function __construct(
        /** @param  array<FileData>  $files */
        array $files,
    ) {
        foreach ($files as $file) {
            $this->files[] = new FileData(...$file);
        }
    }

    /**
     * Cast to array.
     */
    public function toArray(): array
    {
        return [
            'files' => $this->files,
        ];
    }
}
