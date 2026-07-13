<?php

namespace App\Livewire;

use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\Component;

class SupplierModalTable extends Component
{
    public $isOpen = false;
    public $supplierId;
    public $name, $company_name, $gst_number, $phone, $email, $address, $status;

    #[On('open-supplier-edit-modal')]
    public function openModal($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplierId = $supplier->id;
        $this->name = $supplier->name;
        $this->company_name = $supplier->company_name;
        $this->gst_number = $supplier->gst_number;
        $this->phone = $supplier->phone;
        $this->email = $supplier->email;
        $this->address = $supplier->address;
        $this->status = $supplier->status;

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string',
            'phone' => 'required',
            'status' => 'required',
        ]);

        $supplier = Supplier::findOrFail($this->supplierId);
        $supplier->update([
            'name' => $this->name,
            'company_name' => $this->company_name,
            'gst_number' => $this->gst_number,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'status' => $this->status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshDatatable');
    }
    public function render()
    {
        return view('livewire.supplier-modal-table');
    }
}
