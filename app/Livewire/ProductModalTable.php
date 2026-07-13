<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductModalTable extends Component
{
    public $isOpen = false;
    public $productId;

    // Aapke saare variables
    public $name, $category, $sku, $cost_price, $selling_price, $barcode, $description, $quantity, $status, $alert_quantity, $tax_rate;

    #[On('open-purchase-edit-modal')]
    public function openModal($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category = $product->category_id;
        $this->sku = $product->sku;
        $this->cost_price = $product->cost_price;
        $this->selling_price = $product->selling_price;
        $this->barcode = $product->barcode;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->tax_rate = $product->tax_rate;
        $this->status = $product->status;
        $this->alert_quantity = $product->alert_quantity;

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset();
    }

    public function update()
    {

        $product = Product::findOrFail($this->productId);
        $product->update([
            'name' => $this->name,
            'category_id' => $this->category,
            'sku' => $this->sku,
            'cost_price' => $this->cost_price,
            'selling_price' => $this->selling_price,
            'barcode' => $this->barcode,
            'description' => $this->description,
            'tax_rate' => $this->tax_rate,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'alert_quantity' => $this->alert_quantity,
        ]);

        $this->closeModal();
        $this->dispatch('refreshDatatable');
    }
    public function render()
    {
        return view('livewire.product-modal-table', [
            'categories' => Categorie::all()
        ]);
    }
}
