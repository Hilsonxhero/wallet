<?php

namespace Modules\Gateway\Repository\Eloquent;

use Modules\Gateway\App\Models\GatewayTransaction;
use Modules\Gateway\Repository\Contracts\GatewayRepository;

class GatewayRepositoryEloquent implements GatewayRepository
{

    public function get()
    {
        return GatewayTransaction::orderBy('created_at', 'desc')

            ->get();
    }

    public function create($data)
    {
        $item =  GatewayTransaction::query()->create($data);
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
        $item = GatewayTransaction::query()->where($field, $id)->first();
        return $item;
    }
    public function delete($id)
    {
        $item = $this->find($id);
        $item->delete();
    }
}
