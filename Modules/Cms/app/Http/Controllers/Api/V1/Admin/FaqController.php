<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Faq\Contracts\FaqServiceInterface;
use Modules\Cms\Models\Faq;
use Modules\Cms\Http\Requests\Api\V1\Faq\StoreFaqRequest;
use Modules\Cms\Http\Requests\Api\V1\Faq\UpdateFaqRequest;
use Modules\Cms\Http\Resources\Api\V1\Faq\FaqResource;
use Modules\Cms\Http\Resources\Api\V1\Faq\FaqCollection;
use Modules\Cms\DTOs\Faq\FaqData;
use Illuminate\Http\JsonResponse;

/**
 * @group Faq Management
 *
 * APIs for managing Faqs
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
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request): JsonResponse
    {
        $faq = $this->service->create(FaqData::from($request->validated()));

        return $this->successResponse(
            new FaqResource($faq),
            'Faq created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq): JsonResponse
    {
        $this->service->update($faq->id, FaqData::from($request->validated()));

        return $this->successResponse(
            new FaqResource($faq->fresh()),
            'Faq updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq): JsonResponse
    {
        $this->service->delete($faq->id);

        return $this->successResponse(null, 'Faq deleted successfully.', 204);
    }
}
