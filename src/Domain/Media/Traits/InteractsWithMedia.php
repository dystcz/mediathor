<?php

declare(strict_types=1);

use Dystcz\MediaThor\Domain\Files\Data\FileData;
use Dystcz\MediaThor\Domain\Files\Data\UploadData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Sopamo\LaravelFilepond\Filepond;
use Spatie\MediaLibrary\InteractsWithMedia as MediaLibraryInteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait InteractsWithMedia
{
    use MediaLibraryInteractsWithMedia;

    /**
     * Get default disk.
     */
    protected function getDefaultDisk(): string
    {
        return Config::get('media-library.disk_name', 'public');
    }

    /**
     * Handle files.
     *
     * @return Collection
     */
    public function handleFiles(UploadData $files, ?string $collection = null, ?string $disk = null)
    {
        $disk = $disk ?? $this->getDefaultDisk();

        // Get existing files
        $existingFiles = $this->getExistingFiles($files);

        // Save files
        $createdFiles = $this->saveFiles($files, $collection, $disk);

        // All files
        $allFiles = $existingFiles->merge($createdFiles);

        // Remove files
        $deletedFiles = $this->removeFiles($allFiles, $collection, $disk);

        // Order media
        $this->orderFiles($allFiles, $collection, $disk);

        return new Collection([
            'all' => $allFiles,
            'created' => $createdFiles,
            'deleted' => $deletedFiles,
        ]);
    }

    /**
     * Get existing files.
     *
     * @param  null|string  $collection
     * @param  null|string  $disk
     * @return Collection<FileData>
     */
    public function getExistingFiles(UploadData $files): Collection
    {
        $files = Collection::make($files->files)
            ->filter(fn ($file) => ! $this->fileShouldBeUploaded($file))
            ->map(function ($file, $key) {
                return new FileData(...array_merge($file->toArray(), [
                    'id' => Str::before($file->serverId, '/'),
                    'order' => $key,
                ]));
            })->filter(fn ($file) => $file);

        return $files;
    }

    /**
     * Save files.
     *
     * @return Collection<FileData>
     */
    public function saveFiles(UploadData $files, ?string $collection = null, ?string $disk = null): Collection
    {
        $disk = $disk ?? $this->getDefaultDisk();

        $files = Collection::make($files->files)
            ->filter(fn ($file) => $this->fileShouldBeUploaded($file))
            ->map(function ($file, $key) use ($collection, $disk) {
                $media = $this->saveFile($file, $collection, $disk);

                return $media
                    ? new FileData(...array_merge($file->toArray(), ['id' => $media->id, 'order' => $key]))
                    : null;
            })->filter(fn ($file) => $file);

        return $files;
    }

    /**
     * Save single file for a model.
     */
    protected function saveFile(FileData $file, ?string $collection = null, ?string $disk = null): ?Media
    {
        $disk = $disk ?? $this->getDefaultDisk();

        $filepond = App::get(Filepond::class);
        $filePath = $filepond->getPathFromServerId($file->serverId);

        // If the temp file does not exist, don't even try to move it
        if (! Storage::disk('local')->exists($filePath)) {
            return null;
        }

        $fileName = basename($filePath);

        // Move file from temp to project storage using media library

        /** @var Media $media */
        $media = $this->addMedia(Storage::disk('local')->path($filePath))
            ->usingFileName($fileName)
            ->toMediaCollection($collection, $disk);

        return $media;
    }

    /**
     * Order existing files.
     *
     * @param  Collection  $allFiles
     */
    protected function orderFiles(Collection $files, ?string $collection = null): void
    {
        $media = $this->getMedia($collection ?? 'default');

        $files->each(fn (FileData $file) => $media->firstWhere('id', $file->id)?->update(['order_column' => $file->order]));
    }

    /**
     * Remove files from model.
     * Returns deleted media.
     *
     * @return Collection<FileData>
     */
    protected function removeFiles(Collection $files, ?string $collection = null): Collection
    {
        $media = $this->getMedia($collection ?? 'default');

        return $media->whereNotIn(
            'id',
            $files->map(fn (FileData $file) => $file->id)->toArray()
        )->map(function (Media $media) {
            $media->delete();

            return new FileData(
                id: $media->id,
                fileName: $media->file_name,
                serverId: "{$media->id}/{$media->file_name}",
                uploaded: false,
                order: $media->order_column,
            );
        });
    }

    /**
     * Determine if file should be uploaded.
     *
     * @param  string  $serverId
     */
    protected function fileShouldBeUploaded(FileData $file): bool
    {
        $fileId = Str::before($file->serverId, '/');

        return ($fileId === $file->serverId) ? true : false;
    }
}
