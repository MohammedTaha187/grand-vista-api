<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Invoice\Contracts\InvoiceServiceInterface;
use Modules\Hotel\Models\Invoice;
use Modules\Hotel\Http\Requests\Api\V1\Invoice\StoreInvoiceRequest;
use Modules\Hotel\Http\Requests\Api\V1\Invoice\UpdateInvoiceRequest;
use Modules\Hotel\Http\Resources\Api\V1\Invoice\InvoiceResource;
use Modules\Hotel\Http\Resources\Api\V1\Invoice\InvoiceCollection;
use Modules\Hotel\DTOs\Invoice\InvoiceData;
use Illuminate\Http\JsonResponse;

/**
 * @group Invoice Management
 *
 * APIs for managing Invoices
 */
class InvoiceController extends Controller
{
    public function __construct(
        private readonly InvoiceServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            InvoiceCollection::make($items),
            'Invoice list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request): JsonResponse
    {
        $invoice = $this->service->create(InvoiceData::from($request->validated()));

        return $this->successResponse(
            new InvoiceResource($invoice),
            'Invoice created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): JsonResponse
    {
        return $this->successResponse(
            new InvoiceResource($invoice),
            'Invoice retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice): JsonResponse
    {
        $this->service->update($invoice->id, InvoiceData::from($request->validated()));

        return $this->successResponse(
            new InvoiceResource($invoice->fresh()),
            'Invoice updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): JsonResponse
    {
        $this->service->delete($invoice->id);

        return $this->successResponse(null, 'Invoice deleted successfully.', 204);
    }
}
