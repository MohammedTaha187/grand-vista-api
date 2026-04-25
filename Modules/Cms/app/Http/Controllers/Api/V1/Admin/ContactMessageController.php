<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\ContactMessage\Contracts\ContactMessageServiceInterface;
use Modules\Cms\Models\ContactMessage;
use Modules\Cms\Http\Requests\Api\V1\ContactMessage\StoreContactMessageRequest;
use Modules\Cms\Http\Requests\Api\V1\ContactMessage\UpdateContactMessageRequest;
use Modules\Cms\Http\Resources\Api\V1\ContactMessage\ContactMessageResource;
use Modules\Cms\Http\Resources\Api\V1\ContactMessage\ContactMessageCollection;
use Modules\Cms\DTOs\ContactMessage\ContactMessageData;
use Illuminate\Http\JsonResponse;

/**
 * @group ContactMessage Management
 *
 * APIs for managing ContactMessages
 */
class ContactMessageController extends Controller
{
    public function __construct(
        private readonly ContactMessageServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            ContactMessageCollection::make($items),
            'ContactMessage list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $contactMessage = $this->service->create(ContactMessageData::from($request->validated()));

        return $this->successResponse(
            new ContactMessageResource($contactMessage),
            'ContactMessage created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage): JsonResponse
    {
        return $this->successResponse(
            new ContactMessageResource($contactMessage),
            'ContactMessage retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactMessageRequest $request, ContactMessage $contactMessage): JsonResponse
    {
        $this->service->update($contactMessage->id, ContactMessageData::from($request->validated()));

        return $this->successResponse(
            new ContactMessageResource($contactMessage->fresh()),
            'ContactMessage updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage): JsonResponse
    {
        $this->service->delete($contactMessage->id);

        return $this->successResponse(null, 'ContactMessage deleted successfully.', 204);
    }
}
