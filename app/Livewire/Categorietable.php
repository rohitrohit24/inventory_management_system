<?php

namespace App\Livewire;

use App\Models\Categorie;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class Categorietable extends DataTableComponent
{
    protected $model = Categorie::class;
    protected $listeners = ['refreshTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setSearchPlaceholder('Search categories...')
            ->setEmptyMessage('No categories found.')
            ->setTableAttributes([
                'class' => 'table table-hover table-dark align-middle  shadow-sm rounded-3',
            ]);
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Delete Selected',
        ];
    }

    public function deleteSelected()
    {
        Categorie::whereIn('id', $this->getSelected())->delete();
        $this->clearSelected();
        $this->dispatch('refreshTable');
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->filter(function ($query, $value) {
                    $query->where('status', $value);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Name", "name")
                ->sortable()
                ->searchable(),

            Column::make("Description", "description")
                ->sortable()
                ->searchable()
                // Mobile screen par description chupa dega taki table kharab na ho
                ->collapseOnMobile(),

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
                        'class' => 'd-flex gap-2 justify-content-center', // Center align kiya
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => '<i class="bi bi-pencil"></i> Edit')
                        ->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                // btn-sm use kiya taki button table cell se bahar na nikle
                                'class' => 'btn btn-sm action-buttons btn-outline-info',
                                'wire:click.prevent' => "\$dispatch('open-category-edit-modal', { id: {$row->id} })",
                            ];
                        }),

                    LinkColumn::make('Delete')
                        ->title(fn($row) => '<i class="bi bi-trash"></i> Delete')
                        ->html()
                        ->location(fn($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm action-buttons btn-outline-danger',
                                'wire:click.prevent' => "\$dispatch('open-delete-modal', { 
                                    id: {$row->id}, 
                                    model: 'App\\\Models\\\Categorie', 
                                    title: 'Delete Category?', 
                                    message: 'Are you sure you want to delete this item? This action cannot be undone.' 
                                })",
                            ];
                        }),
                ]),
        ];
    }
}
