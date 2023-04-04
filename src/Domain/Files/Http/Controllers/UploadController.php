
<?php

namespace Dystcz\Mediathor\Domain\Files\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sopamo\LaravelFilepond\Http\Controllers\FilepondController;

class UploadController extends FilepondController
{
    /**
     * Alias method for upload method on FilepondController.
     */
    public function store(Request $request): Response
    {
        return $this->upload($request);
    }

    /**
     * Alias method for delete method on FilepondController.
     */
    public function destroy(Request $request): Response
    {
        return $this->delete($request);
    }
}
