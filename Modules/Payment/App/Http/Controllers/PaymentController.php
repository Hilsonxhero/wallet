<?php

namespace Modules\Payment\App\Http\Controllers;

use Modules\Common\App\Http\Controllers\Api\ApiController;
use Modules\Payment\App\resources\PaymentResource;

class PaymentController extends ApiController
{
    public function confirmation($id)
    {
        $payment = paymentRepo()->find($id, "reference_code");
        $payment = new PaymentResource($payment);
        return $this->successResponse($payment);
    }
}
