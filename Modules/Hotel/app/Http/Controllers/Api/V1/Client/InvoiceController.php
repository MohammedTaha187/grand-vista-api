<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Invoice\Contracts\InvoiceServiceInterface;
use Modules\Hotel\Models\Invoice;
use Modules\Hotel\Http\Resources\Api\V1\Invoice\InvoiceResource;
use Modules\Hotel\Http\Resources\Api\V1\Invoice\InvoiceCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Invoice Client API
 *
 * APIs for viewing Invoices
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
     * Display the specified resource.
     */
    public function show(Invoice $invoice): JsonResponse
    {
        return $this->successResponse(
            new InvoiceResource($invoice),
            'Invoice retrieved.'
        );
    }
}
