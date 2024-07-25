<?php

namespace Modules\Wallet\Repository\Contracts;

interface WalletRepository
{
    public function get();
    public function create($data);
    public function update($id, $data);
    public function find($id);
    public function delete($id);
}
