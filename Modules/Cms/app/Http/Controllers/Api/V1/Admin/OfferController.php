<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Offer\Contracts\OfferServiceInterface;
use Modules\Cms\Models\Offer;
use Modules\Cms\Http\Requests\Api\V1\Offer\StoreOfferRequest;
use Modules\Cms\Http\Requests\Api\V1\Offer\UpdateOfferRequest;
use Modules\Cms\Http\Resources\Api\V1\Offer\OfferResource;
use Modules\Cms\Http\Resources\Api\V1\Offer\OfferCollection;
use Modules\Cms\DTOs\Offer\OfferData;
use Illuminate\Http\JsonResponse;

/**
 * @group Offer Management
 *
 * APIs for managing Offers
 */
class OfferController extends Controller
{
    public function __construct(
        private readonly OfferServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            OfferCollection::make($items),
            'Offer list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request): JsonResponse
    {
        $offer = $this->service->create(OfferData::from($request->validated()));

        return $this->successResponse(
            new OfferResource($offer),
            'Offer created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer): JsonResponse
    {
        return $this->successResponse(
            new OfferResource($offer),
            'Offer retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offer $offer): JsonResponse
    {
        $this->service->update($offer->id, OfferData::from($request->validated()));

        return $this->successResponse(
            new OfferResource($offer->fresh()),
            'Offer updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer): JsonResponse
    {
        $this->service->delete($offer->id);

        return $this->successResponse(null, 'Offer deleted successfully.', 204);
    }
}
