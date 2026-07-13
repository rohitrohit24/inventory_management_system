<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Supplier;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SupplierTable extends DataTableComponent
{
    protected $model = Supplier::class;

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
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Company name", "company_name")
                ->sortable()
                ->searchable(),
            Column::make("Gst number", "gst_number")
                ->sortable()
                ->searchable(),
            Column::make("Phone", "phone")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Status", "status")
                ->format(
                    fn($value, $row) => view('components.livewireTable.status-badge-table', [
                        'status' => $value
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
                                'wire:click.prevent' => "\$dispatch('open-supplier-edit-modal', { id: {$row->id} })",
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
                                model: 'App\\\Models\\\Supplier', 
                                title: 'Delete Supplier?', 
                                message: 'Are you sure you want to delete this item? This action cannot be undone.' })",
                            ];
                        }),
                ]),
        ];
    }
}
