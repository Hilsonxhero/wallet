<?php

namespace Modules\Payment\Repository\Eloquent;

use Modules\Payment\App\Models\Payment;
use Modules\Payment\Repository\Contracts\PaymentRepository;

class PaymentRepositoryEloquent implements PaymentRepository
{

    public function get()
    {
        return Payment::orderBy('created_at', 'desc')

            ->get();
    }


    public function create($data)
    {
        $item =  Payment::query()->create($data);
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
        $item = Payment::query()->where($field, $id)->first();
        return $item;
    }

    public function delete($id)
    {
        $item = $this->find($id);
        $item->delete();
    }
}
