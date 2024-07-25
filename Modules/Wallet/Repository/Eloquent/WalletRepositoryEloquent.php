<?php

namespace Modules\Wallet\Repository\Eloquent;

use Modules\Wallet\App\Models\Wallet;
use Modules\Wallet\Enums\WalletStatus;
use Modules\Wallet\Repository\Contracts\WalletRepository;


class WalletRepositoryEloquent implements WalletRepository
{

    public function get()
    {
        return Wallet::orderBy('created_at', 'desc')

            ->get();
    }

    public function create($data)
    {
        $item =  Wallet::query()->create($data);
        return $item;
    }


    public function update($id, $data)
    {
        $item = $this->find($id);
        $item->update($data);
        return $item;
    }
    public function show($id)
    {
        $item = $this->find($id);
        return $item;
    }

    public function find($id)
    {
        $item = Wallet::query()->where('id', $id)->first();
        return $item;
    }
    public function delete($id)
    {
        $item = $this->find($id);
        $item->delete();
    }
}
