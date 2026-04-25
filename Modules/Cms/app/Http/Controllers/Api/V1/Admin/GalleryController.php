<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Gallery\Contracts\GalleryServiceInterface;
use Modules\Cms\Models\Gallery;
use Modules\Cms\Http\Requests\Api\V1\Gallery\StoreGalleryRequest;
use Modules\Cms\Http\Requests\Api\V1\Gallery\UpdateGalleryRequest;
use Modules\Cms\Http\Resources\Api\V1\Gallery\GalleryResource;
use Modules\Cms\Http\Resources\Api\V1\Gallery\GalleryCollection;
use Modules\Cms\DTOs\Gallery\GalleryData;
use Illuminate\Http\JsonResponse;

/**
 * @group Gallery Management
 *
 * APIs for managing Gallerys
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
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request): JsonResponse
    {
        $gallery = $this->service->create(GalleryData::from($request->validated()));

        return $this->successResponse(
            new GalleryResource($gallery),
            'Gallery created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery): JsonResponse
    {
        $this->service->update($gallery->id, GalleryData::from($request->validated()));

        return $this->successResponse(
            new GalleryResource($gallery->fresh()),
            'Gallery updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): JsonResponse
    {
        $this->service->delete($gallery->id);

        return $this->successResponse(null, 'Gallery deleted successfully.', 204);
    }
}
