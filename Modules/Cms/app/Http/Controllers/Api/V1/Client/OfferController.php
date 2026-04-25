<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Offer\Contracts\OfferServiceInterface;
use Modules\Cms\Models\Offer;
use Modules\Cms\Http\Resources\Api\V1\Offer\OfferResource;
use Modules\Cms\Http\Resources\Api\V1\Offer\OfferCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Offer Client API
 *
 * APIs for viewing Offers
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
     * Display the specified resource.
     */
    public function show(Offer $offer): JsonResponse
    {
        return $this->successResponse(
            new OfferResource($offer),
            'Offer retrieved.'
        );
    }
}
