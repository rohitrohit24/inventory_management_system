<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class GlobalModal extends Component
{
    public $isOpen = false;
    public $title = '';
    public $modelName = '';
    public $recordId = '';
    public $data = [];

    #[On('global-modal')]
    public function openModal($model, $id, $title = 'Details')
    {
        $this->modelName = $model;
        $this->recordId = $id;
        $this->title = $title;

        // Dynamic Eloquent Query
        $record = $model::find($id);

        if ($record) {
            $this->data = $record->toArray();
            $this->isOpen = true;
        }
    }

    // 🌟 Yeh function missing tha form submit ke liye
    public function update()
    {
        if (!$this->modelName || !$this->recordId) return;

        // Model ko dhoondkar update karein
        $record = $this->modelName::find($this->recordId);

        if ($record) {
            $record->update($this->data);

            // Success message ya alert dispatch karein
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Data updated successfully!']);

            // Doosre components (jaise Datatable) ko refresh karne ke liye
            $this->dispatch('refreshDatatable');
        }

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['data', 'modelName', 'recordId', 'title']);
    }

    public function render()
    {
        return view('livewire.global-modal');
    }
}
