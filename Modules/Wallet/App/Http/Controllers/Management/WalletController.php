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
     * Display a list of all wallets.
     *
     * @return JsonResponse The response containing the list of all wallets.
     */
    public function index(): JsonResponse
    {
        $items = walletRepo()->get();
        $items = WalletResource::collection($items);
        return $this->successResponse($items);
    }

    /**
     * Store a newly created wallet in storage.
     *
     * @param WalletRequest $request The HTTP request object containing wallet details.
     * @return JsonResponse The response indicating the result of the store operation.
     */
    public function store(WalletRequest $request): JsonResponse
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
     * Display the specified wallet.
     *
     * @param int $id The ID of the wallet to be displayed.
     * @return JsonResponse The response containing the wallet details.
     */
    public function show($id): JsonResponse
    {
        $item = walletRepo()->find($id);
        return $this->successResponse($item);
    }

    /**
     * Update the specified wallet in storage.
     *
     * @param WalletRequest $request The HTTP request object containing updated wallet details.
     * @param int $id The ID of the wallet to be updated.
     * @return JsonResponse The response indicating the result of the update operation.
     */
    public function update(WalletRequest $request, $id): JsonResponse
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
     * Remove the specified wallet from storage.
     *
     * @param int $id The ID of the wallet to be deleted.
     * @return JsonResponse The response indicating the result of the delete operation.
     */
    public function destroy($id): JsonResponse
    {
        $item = walletRepo()->delete($id);
        return $this->successResponse(trans('response.responses.200'));
    }
}
