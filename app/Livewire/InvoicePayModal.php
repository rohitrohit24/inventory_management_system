<?php

namespace App\Livewire;

use App\Models\TotalInvoice;
use Livewire\Attributes\On;
use Livewire\Component;

class InvoicePayModal extends Component
{
    public $isOpen = false;
    public $invoiceId;

    // Form fields ke liye variables
    public $purchases_date;
    public $total_amount = 0;
    public $paid_amount = 0;
    public $due_amount = 0;

    // TotalInvoiceTable ke pay button ka event listener
    #[On('open-invoice-pay-modal')]
    public function openModal($id)
    {
        $invoice = TotalInvoice::findOrFail($id);

        $this->invoiceId = $invoice->id;
        $this->purchases_date = $invoice->purchases_date;
        $this->total_amount = $invoice->total_amount;
        $this->paid_amount = $invoice->paid_amount;
        $this->due_amount = $invoice->due_amount;

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['invoiceId', 'purchases_date', 'total_amount', 'paid_amount', 'due_amount']);
    }

    // Jab bhi paid_amount change hoga, yeh function automatic run karega (Live Calculation)
    public function updatedPaidAmount($value)
    {
        $total = floatval($this->total_amount);
        $paid = floatval($value ?: 0);

        // Naya due amount nikalna
        $this->due_amount = $total - $paid;

        // Validation: Agar user total amount se zyada fill kar deta hai
        if ($this->due_amount < 0) {
            $this->addError('paid_amount', 'Paid amount total amount se bada nahi ho sakta!');
            $this->due_amount = 0;
        } else {
            $this->resetErrorBag('paid_amount');
        }
    }

    public function updatePayment()
    {
        // Validation rules
        $this->validate([
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $invoice = TotalInvoice::findOrFail($this->invoiceId);

        $finalTotal = floatval($this->total_amount);
        $finalPaid = floatval($this->paid_amount);
        $finalDue = $finalTotal - $finalPaid;

        if ($finalDue < 0) {
            $this->addError('paid_amount', 'Paid amount total amount se bada nahi ho sakta!');
            return;
        }

        // Database me safe query update chalana
        $invoice->update([
            'paid_amount' => $finalPaid,
            'due_amount'  => $finalDue,
            // Agar due 0 ya usse kam hai toh status 1 (Paid), nahi toh 0 (Unpaid)
            'status'      => $finalDue <= 0 ? '1' : '0',
        ]);

        $this->closeModal();

        // SweetAlert ya flash message dispatch karne ke liye
        session()->flash('message', 'Invoice payment updated successfully!');

        // Rappasoft table data ko instant refresh karne ke liye event
        $this->dispatch('refreshDatatable');
    }
    public function render()
    {
        return view('livewire.invoice-pay-modal');
    }
}
