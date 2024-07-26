<?php

namespace Modules\User\Repository\Contracts;

interface UserRepository
{
    public function get();
    public function create($data);
    public function update($id, $data);
    public function find($id, $field = "id");
    public function delete($id);
}
