<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Gallery\Contracts\GalleryServiceInterface;
use Modules\Cms\Models\Gallery;
use Modules\Cms\Http\Resources\Api\V1\Gallery\GalleryResource;
use Modules\Cms\Http\Resources\Api\V1\Gallery\GalleryCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Gallery Client API
 *
 * APIs for viewing Gallerys
 */
class GalleryController extends Controller
{
    public function __construct(
        private readonly GalleryServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            GalleryCollection::make($items),
            'Gallery list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery): JsonResponse
    {
        return $this->successResponse(
            new GalleryResource($gallery),
            'Gallery retrieved.'
        );
    }
}
