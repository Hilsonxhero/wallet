<?php

namespace Modules\Payment\Enums;

enum PaymentStatus: string
{
    case PENDING  = 'pending';
    case SUCCESS = 'success';
    case REJECTED = 'rejected';
    case FAILED = 'failed';
}
