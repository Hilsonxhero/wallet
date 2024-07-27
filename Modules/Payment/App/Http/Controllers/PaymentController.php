<?php

namespace Modules\Payment\App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Payment\App\resources\PaymentResource;
use Modules\Common\App\Http\Controllers\Api\ApiController;

class PaymentController extends ApiController
{
    /**
     * Show the payment detail.
     * @param mixed $id
     */
    public function confirmation($id): JsonResponse
    {
        $payment = paymentRepo()->find($id, "reference_code");
        $payment = new PaymentResource($payment);
        return $this->successResponse($payment);
    }
}
