<?php

namespace Modules\Gateway\Repository\Contracts;

interface GatewayRepository
{
    public function get();
    public function create($data);
    public function update($id, $data);
    public function find($id, $field = "id");
    public function delete($id);
}
