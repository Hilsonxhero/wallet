<?php

namespace Modules\User\Repository\Eloquent;

use Modules\User\App\Models\User;
use Modules\User\Repository\Contracts\UserRepository;

class UserRepositoryEloquent implements UserRepository
{

    public function get()
    {
        return User::orderBy('created_at', 'desc')

            ->get();
    }

    public function create($data)
    {
        $item =  User::query()->create($data);
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
        $item = User::query()->where($field, $id)->first();
        return $item;
    }
    public function delete($id)
    {
        $item = $this->find($id);
        $item->delete();
    }
}
