<?php

namespace App\Livewire;

use App\Models\Sale;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SalesTable extends DataTableComponent
{
    protected $model = Sale::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table table-hover bg-aside table-dark table-bordered',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Invoice no", "invoice_no")
                ->sortable(),
            Column::make("Customer name", "customer_name")
                ->sortable(),
            Column::make("User id", "user_id")
                ->sortable(),
            Column::make("Product id", "product_id")
                ->sortable(),
            Column::make("Category id", "category_id")
                ->sortable(),
            Column::make("Quantity", "quantity")
                ->sortable(),
            Column::make("Unit price", "unit_price")
                ->sortable(),
            Column::make("Discount", "discount")
                ->sortable(),
            Column::make("Tax", "tax")
                ->sortable(),
            Column::make("Item total", "item_total")
                ->sortable(),
            Column::make("Payment method", "payment_method")
                ->sortable(),
            Column::make("Sale date", "sale_date")
                ->sortable(),
            Column::make("Grand Total", "grand_total")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Actions", "id")
                ->label(fn($row) => "
                    <div class='d-flex gap-2'>
                        <button class='btn action-buttons btn-outline-info btn-sm' 
                            wire:click=\"\$dispatch('global-modal', { 
                            model: 'App\\\\Models\\\\Sale', 
                            id: {$row->id}, 
                            title: 'Sales #{$row->invoice_no}'
                            })\">
                            <i class='bi bi-eye'></i> Update
                        </button>
                        <button class='btn action-buttons btn-outline-danger btn-sm' 
                            wire:click=\"\$dispatch('open-delete-modal', { 
                                id: {$row->id}, 
                                model: 'App\\\\Models\\\\Sale', 
                                title: 'Delete Invoice ?', 
                                message: 'Are you sure you want to delete this item? This action cannot be undone.' 
                            })\">
                            <i class='bi bi-trash'></i> Delete
                        </button>
                    </div>
                ")->html()
        ];
    }
}
