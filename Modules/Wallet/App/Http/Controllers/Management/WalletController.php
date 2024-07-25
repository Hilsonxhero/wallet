<?php

namespace Modules\Wallet\App\Http\Controllers\Management;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Wallet\Enums\WalletStatus;
use Modules\Wallet\App\resources\WalletResource;
use Modules\Common\App\Http\Controllers\Api\ApiController;
use Modules\Wallet\App\Http\Requests\Management\WalletRequest;

class WalletController extends ApiController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = walletRepo()->get();
        $items = WalletResource::collection($items);
        return $this->successResponse($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WalletRequest $request)
    {
        try {
            $item = walletRepo()->create([
                "name" => $request->input("name"),
                "slug" => Str::slug($request->input("name"), '-', null),
                "description" => $request->input("description"),
                "type" => $request->input("type"),
                "status" => WalletStatus::ACTIVE->value
            ]);
            return $this->successResponse($item, trans('response.responses.200'));
        } catch (\Throwable $th) {
            return $this->errorResponse([], $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $item = walletRepo()->find($id);
        return $this->successResponse($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WalletRequest $request, $id)
    {
        $item = walletRepo()->update($id, [
            "name" => $request->input("name"),
            "slug" => Str::slug($request->input("name"), '-', null),
            "description" => $request->input("description"),
            "type" => $request->input("type"),
            "status" => $request->input("status"),
        ]);
        return $this->successResponse($item, trans('response.responses.200'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = walletRepo()->delete($id);
        return $this->successResponse(trans('response.responses.200'));
    }
}
