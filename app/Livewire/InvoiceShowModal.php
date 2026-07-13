<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TotalInvoice;
use Livewire\Attributes\On;

class InvoiceShowModal extends Component
{
    public $invoice = null;
    public $productsArray = [];
    public $showModal = false;

    // 🎯 Yeh listener table ke click event ko catch karega
    #[On('loadInvoiceData')]
    public function loadInvoiceData($id)
    {
        $this->invoice = TotalInvoice::with('supplier')->find($id);

        if ($this->invoice && $this->invoice->products) {
            $this->productsArray = is_string($this->invoice->products)
                ? json_decode($this->invoice->products, true)
                : $this->invoice->products;
        } else {
            $this->productsArray = [];
        }

        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
        $this->reset(['invoice', 'productsArray']);
    }

    public function render()
    {
        return view('livewire.invoice-show-modal');
    }
}
