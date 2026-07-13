<?php

namespace App\Livewire;

use App\Models\Categorie;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryModalTable extends Component
{
    public $isOpen = false;
    public $categoryId;
    public $name, $description, $status;

    #[On('open-category-edit-modal')]
    public function openModal($id)
    {
        $category = Categorie::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->status = $category->status;

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
            'status' => 'required',
        ]);

        $category = Categorie::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshDatatable');
    }
    public function render()
    {
        return view('livewire.category-modal-table');
    }
}
