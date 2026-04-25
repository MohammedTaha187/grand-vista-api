<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\ContactMessage\Contracts\ContactMessageServiceInterface;
use Modules\Cms\Models\ContactMessage;
use Modules\Cms\Http\Resources\Api\V1\ContactMessage\ContactMessageResource;
use Modules\Cms\Http\Resources\Api\V1\ContactMessage\ContactMessageCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group ContactMessage Client API
 *
 * APIs for viewing ContactMessages
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
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage): JsonResponse
    {
        return $this->successResponse(
            new ContactMessageResource($contactMessage),
            'ContactMessage retrieved.'
        );
    }
}
