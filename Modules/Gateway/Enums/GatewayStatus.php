<?php

namespace Modules\Gateway\Enums;

enum GatewayStatus: string
{
    case PENDING  = 'pending';
    case SUCCESS = 'success';
    case REJECTED = 'rejected';
    case FAILED = 'failed';
}
