<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TotalInvoice;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TotalInvoiceTable extends DataTableComponent
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
            ->with('supplier', 'product');
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
            // Column::make("Product Name", "product.name")
            //     ->sortable(),
            // Column::make("products", "products")
            //     ->sortable(),
            Column::make("Purchases date", "purchases_date")
                ->sortable()->searchable(),
            // Column::make("Quantity", "quantity")
            //     ->sortable(),
            // Column::make("Cost price", "cost_price")
            //     ->sortable(),
            Column::make("Total amount", "total_amount")
                ->sortable(),
            Column::make("Paid amount", "paid_amount")
                ->sortable(),
            Column::make("Due amount", "due_amount")
                ->sortable(),
            Column::make("Status", "status")
                ->label(
                    fn($row) => view('components.livewireTable.pay-status', [
                        'total_amount' => $row->total_amount,
                        'paid_amount' => $row->paid_amount,
                        'due_amount' => $row->due_amount,
                        'row' => $row,
                    ])->render()
                )
                ->html()
                ->sortable()->searchable(),
            // Column::make("Status", "status")
            //     ->sortable(),
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
                        ->title(fn($row) => '<i class="bi bi-eye"></i> SHOW')->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => ' btn action-buttons btn-outline-success',
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
