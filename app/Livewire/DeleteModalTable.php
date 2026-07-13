<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class DeleteModalTable extends Component
{
    public $isOpen = false;
    public $recordId;
    public $modelName;
    public $title = 'Are you sure?';
    public $message = 'You won\'t be able to revert this!';

    #[On('open-delete-modal')]
    public function openModal($id, $model, $title = null, $message = null)
    {
        $this->recordId = $id;
        $this->modelName = $model;

        if ($title) $this->title = $title;
        if ($message) $this->message = $message;

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['recordId', 'modelName', 'title', 'message']);
    }

    public function delete()
    {
        if ($this->recordId && $this->modelName) {
            $model = $this->modelName::find($this->recordId);
            if ($model) {
                $model->delete();
            }
        }

        $this->closeModal();

        $this->dispatch('refreshDatatable');

        session()->flash('message', 'Record deleted successfully.');
    }
    public function render()
    {
        return view('livewire.delete-modal-table');
    }
}
