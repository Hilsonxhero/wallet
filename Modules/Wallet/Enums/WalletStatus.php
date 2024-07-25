<?php

namespace Modules\Wallet\Enums;

enum WalletStatus: string
{
    case ACTIVE  = 'active';
    case INACTIVE = 'inactive';
}
