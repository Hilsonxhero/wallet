<?php

namespace Modules\Payment\Repository\Eloquent;

use Modules\Payment\App\Models\Transaction;
use Modules\Payment\Repository\Contracts\TransactionRepository;

class TransactionRepositoryEloquent implements TransactionRepository
{

    public function get()
    {
        return Transaction::orderBy('created_at', 'desc')

            ->get();
    }


    public function create($data)
    {
        $item =  Transaction::query()->create($data);
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

    public function find($id, $field = "id")
    {
        $item = Transaction::query()->where($field, $id)->first();
        return $item;
    }

    public function delete($id)
    {
        $item = $this->find($id);
        $item->delete();
    }
}
