<?php

namespace Modules\Payment\Repository\Contracts;

interface InvoiceRepository
{
    public function get();
    public function create($data);
    public function update($id, $data);
    public function find($id);
    public function delete($id);
}
