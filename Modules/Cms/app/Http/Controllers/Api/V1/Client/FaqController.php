<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Faq\Contracts\FaqServiceInterface;
use Modules\Cms\Models\Faq;
use Modules\Cms\Http\Resources\Api\V1\Faq\FaqResource;
use Modules\Cms\Http\Resources\Api\V1\Faq\FaqCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Faq Client API
 *
 * APIs for viewing Faqs
 */
class FaqController extends Controller
{
    public function __construct(
        private readonly FaqServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            FaqCollection::make($items),
            'Faq list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq): JsonResponse
    {
        return $this->successResponse(
            new FaqResource($faq),
            'Faq retrieved.'
        );
    }
}
