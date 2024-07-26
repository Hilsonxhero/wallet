<?php

namespace Modules\Payment\Enums;

enum TransactionType: string
{
    case INCREMENT  = 'increment';
    case DECREMENT = 'decrement';
}
