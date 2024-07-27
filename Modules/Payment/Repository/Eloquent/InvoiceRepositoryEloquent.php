<?php

namespace Modules\Payment\Repository\Eloquent;

use Modules\Payment\App\Models\Invoice;
use Modules\Payment\Repository\Contracts\InvoiceRepository;

class InvoiceRepositoryEloquent implements InvoiceRepository
{
    /**
     * Retrieve all invoices ordered by the creation date in descending order.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of all Invoice models.
     */
    public function get()
    {
        return Invoice::orderBy('created_at', 'desc')->get();
    }

    /**
     * Create a new invoice with the given data.
     *
     * @param array $data Associative array of invoice data to create the invoice.
     * @return Invoice The newly created Invoice model.
     */
    public function create($data)
    {
        $item = Invoice::query()->create($data);
        return $item;
    }

    /**
     * Update an existing invoice identified by the given ID with the provided data.
     *
     * @param int $id The ID of the invoice to update.
     * @param array $data Associative array of invoice data to update.
     * @return Invoice The updated Invoice model.
     */
    public function update($id, $data)
    {
        $item = $this->find($id);
        $item->update($data);
        return $item;
    }

    /**
     * Retrieve an invoice by its ID.
     *
     * @param int $id The ID of the invoice to retrieve.
     * @return Invoice|null The Invoice model if found, null otherwise.
     */
    public function show($id)
    {
        $item = $this->find($id);
        return $item;
    }

    /**
     * Find an invoice by a specific field and its value.
     *
     * @param mixed $id The value of the field to search by.
     * @param string $field The field to search for. Defaults to "id".
     * @return Invoice|null The Invoice model if found, null otherwise.
     */
    public function find($id, $field = "id")
    {
        $item = Invoice::query()->where($field, $id)->first();
        return $item;
    }

    /**
     * Delete an invoice identified by the given ID.
     *
     * @param int $id The ID of the invoice to delete.
     * @return void
     */
    public function delete($id)
    {
        $item = $this->find($id);
        if ($item) {
            $item->delete();
        }
    }
}
