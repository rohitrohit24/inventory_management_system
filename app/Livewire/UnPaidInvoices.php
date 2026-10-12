<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TotalInvoice;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UnPaidInvoices extends DataTableComponent
{
    protected $model = TotalInvoice::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table table-hover bg-aside table-dark table-bordered',
        ]);
    }

    public function builder(): Builder
    {
        return TotalInvoice::query()
            ->select('total_invoices.*')
            ->with('supplier', 'product')
            ->where('total_invoices.status', '=', '0');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Supplier", "supplier.company_name")
                ->sortable()->searchable(),
            Column::make("Invoice no", "invoice_no")
                ->sortable()->searchable(),
            Column::make("Purchases date", "purchases_date")
                ->sortable()->searchable(),
            Column::make("Total amount", "total_amount")
                ->sortable(),
            Column::make("Paid amount", "paid_amount")
                ->sortable(),
            Column::make("Due amount", "due_amount")
                ->sortable(),
            Column::make("Status", "status")
                ->label(function ($row) {
                    if ($row->status == '1') {
                        return '<span class="badge rounded-pill" style="background:rgba(16,185,129,0.18);color:#10b981;border:1px solid rgba(16,185,129,0.4);font-size:0.72rem;font-weight:600;padding:0.3em 0.85em;"><i class="bi bi-check-circle-fill me-1"></i> Paid</span>';
                    } else {
                        return '<span class="badge rounded-pill" style="background:rgba(239,68,68,0.18);color:#ef4444;border:1px solid rgba(239,68,68,0.4);font-size:0.72rem;font-weight:600;padding:0.3em 0.85em;"><i class="bi bi-exclamation-circle-fill me-1"></i> Unpaid</span>';
                    }
                })
                ->html()
                ->sortable(),

            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'd-flex gap-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '<i class="bi bi-trash"></i>DELETE')->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn action-buttons btn-outline-danger',
                                'wire:click.prevent' => "\$dispatch('open-delete-modal', { 
                                id: {$row->id}, 
                                model: 'App\\\Models\\\TotalInvoice', 
                                title: 'Delete Invoice ?', 
                                message: 'Are you sure you want to delete this item? This action cannot be undone.' })",
                            ];
                        }),
                    LinkColumn::make('Show')
                        ->title(fn($row) => '<i class="bi bi-eye"></i>SHOW')->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn action-buttons btn-outline-success',
                                'wire:click.prevent' => "\$dispatch('loadInvoiceData', { id: {$row->id} })",
                            ];
                        }),
                    LinkColumn::make('pay')
                        ->title(fn($row) => '<i class="bi bi-currency-rupee"></i>PAY')->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn action-buttons btn-outline-warning',
                                'wire:click.prevent' => "\$dispatch('open-invoice-pay-modal', { id: {$row->id} })",
                            ];
                        }),
                ]),
        ];
    }
}
