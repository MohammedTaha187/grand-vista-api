<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Payment\Contracts\PaymentServiceInterface;
use Modules\Hotel\Models\Payment;
use Modules\Hotel\Http\Requests\Api\V1\Payment\StorePaymentRequest;
use Modules\Hotel\Http\Requests\Api\V1\Payment\UpdatePaymentRequest;
use Modules\Hotel\Http\Resources\Api\V1\Payment\PaymentResource;
use Modules\Hotel\Http\Resources\Api\V1\Payment\PaymentCollection;
use Modules\Hotel\DTOs\Payment\PaymentData;
use Illuminate\Http\JsonResponse;

/**
 * @group Payment Management
 *
 * APIs for managing Payments
 */
class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            PaymentCollection::make($items),
            'Payment list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request): JsonResponse
    {
        $payment = $this->service->create(PaymentData::from($request->validated()));

        return $this->successResponse(
            new PaymentResource($payment),
            'Payment created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment): JsonResponse
    {
        return $this->successResponse(
            new PaymentResource($payment),
            'Payment retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment): JsonResponse
    {
        $this->service->update($payment->id, PaymentData::from($request->validated()));

        return $this->successResponse(
            new PaymentResource($payment->fresh()),
            'Payment updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment): JsonResponse
    {
        $this->service->delete($payment->id);

        return $this->successResponse(null, 'Payment deleted successfully.', 204);
    }
}
