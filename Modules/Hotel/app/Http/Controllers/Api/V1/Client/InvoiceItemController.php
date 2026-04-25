<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\InvoiceItem\Contracts\InvoiceItemServiceInterface;
use Modules\Hotel\Models\InvoiceItem;
use Modules\Hotel\Http\Resources\Api\V1\InvoiceItem\InvoiceItemResource;
use Modules\Hotel\Http\Resources\Api\V1\InvoiceItem\InvoiceItemCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group InvoiceItem Client API
 *
 * APIs for viewing InvoiceItems
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
     * Display the specified resource.
     */
    public function show(InvoiceItem $invoiceItem): JsonResponse
    {
        return $this->successResponse(
            new InvoiceItemResource($invoiceItem),
            'InvoiceItem retrieved.'
        );
    }
}
