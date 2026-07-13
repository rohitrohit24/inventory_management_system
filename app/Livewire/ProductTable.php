<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\HtmlColumn;

class ProductTable extends DataTableComponent
{
    protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table table-hover bg-aside table-dark table-bordered',
        ]);
    }
    public function builder(): Builder
    {
        return Product::query()
            ->with('category');
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Category", "category.name")
                ->sortable()
                ->searchable(),
            Column::make("Sku", "sku")
                ->sortable(),
            Column::make("Cost price", "cost_price")
                ->sortable(),
            Column::make("Selling price", "selling_price")
                ->sortable(),
            Column::make("Tax Rate", "tax_rate")
                ->sortable(),
            Column::make("Quantity", "quantity")
                ->sortable()
                ->searchable(),
            Column::make("Barcode", "barcode")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("alert_quantity", "alert_quantity")
                ->sortable(),
            Column::make("Status", "status")
                ->label(
                    fn($row) => view('components.livewireTable.stock-status-badge', [
                        'quantity' => $row->quantity,
                        'alert_quantity' => $row->alert_quantity,
                    ])->render()
                )
                ->html()
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'd-flex gap-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => '<i class="bi bi-pencil"></i>EDIT')->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn action-buttons btn-outline-info',
                                'wire:click.prevent' => "\$dispatch('open-purchase-edit-modal', { id: {$row->id} })",
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '<i class="bi bi-trash"></i>DELETE')->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn action-buttons btn-outline-danger',
                                'wire:click.prevent' => "\$dispatch('open-delete-modal', { 
                                id: {$row->id}, 
                                model: 'App\\\Models\\\Product', 
                                title: 'Delete Product?', 
                                message: 'Are you sure you want to delete this item? This action cannot be undone.' 
                            })",
                            ];
                        }),
                ]),
            // LinkColumn::make('Edit')
            //     ->title(fn($row) => 'view')
            //     ->location(fn($row) => '#')
            //     ->attributes(function ($row) {
            //         return [
            //             'class' => 'btn-sm btn action-buttons btn-outline-danger',
            //             'data-bs-toggle' => 'modal',
            //             'data-bs-target' => '#' . $row->id,
            //         ];
            //     }),
            // ]),
            // Column::make('Action')
            //     ->label(
            //         fn($row) => view('components.livewireTable.action-tables', [
            //             'product' => $row,
            //         ])->render()
            //     )
            //     ->html(),
        ];
    }
}
