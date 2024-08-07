<?php

namespace Modules\Gateway\Facades;

use Illuminate\Support\Facades\Facade;



class Payment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'payment';
    }
}
