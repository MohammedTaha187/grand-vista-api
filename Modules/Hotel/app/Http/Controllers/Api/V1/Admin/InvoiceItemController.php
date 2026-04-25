<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\InvoiceItem\Contracts\InvoiceItemServiceInterface;
use Modules\Hotel\Models\InvoiceItem;
use Modules\Hotel\Http\Requests\Api\V1\InvoiceItem\StoreInvoiceItemRequest;
use Modules\Hotel\Http\Requests\Api\V1\InvoiceItem\UpdateInvoiceItemRequest;
use Modules\Hotel\Http\Resources\Api\V1\InvoiceItem\InvoiceItemResource;
use Modules\Hotel\Http\Resources\Api\V1\InvoiceItem\InvoiceItemCollection;
use Modules\Hotel\DTOs\InvoiceItem\InvoiceItemData;
use Illuminate\Http\JsonResponse;

/**
 * @group InvoiceItem Management
 *
 * APIs for managing InvoiceItems
 */
class InvoiceItemController extends Controller
{
    public function __construct(
        private readonly InvoiceItemServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            InvoiceItemCollection::make($items),
            'InvoiceItem list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceItemRequest $request): JsonResponse
    {
        $invoiceItem = $this->service->create(InvoiceItemData::from($request->validated()));

        return $this->successResponse(
            new InvoiceItemResource($invoiceItem),
            'InvoiceItem created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceItem $invoiceItem): JsonResponse
    {
        return $this->successResponse(
            new InvoiceItemResource($invoiceItem),
            'InvoiceItem retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceItemRequest $request, InvoiceItem $invoiceItem): JsonResponse
    {
        $this->service->update($invoiceItem->id, InvoiceItemData::from($request->validated()));

        return $this->successResponse(
            new InvoiceItemResource($invoiceItem->fresh()),
            'InvoiceItem updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceItem $invoiceItem): JsonResponse
    {
        $this->service->delete($invoiceItem->id);

        return $this->successResponse(null, 'InvoiceItem deleted successfully.', 204);
    }
}
