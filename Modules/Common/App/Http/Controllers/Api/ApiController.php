<?php

namespace Modules\Common\App\Http\Controllers\Api;


use Illuminate\Routing\Controller;
use Modules\Common\Traits\ApiResponseTrait;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends Controller
{
    use ApiResponseTrait, AuthorizesRequests, ValidatesRequests;
}
