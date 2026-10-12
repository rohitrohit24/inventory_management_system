@extends('admin.layout.view')
@section('title')
    Categories Management
@endsection
@section('content')
    <div class="container p-4">
        @if (session()->has('message'))
            <x-alert type="info">
                {{ session()->get('message') }}
            </x-alert>
        @endif
        <div id="showmessage">
        </div>
        <div class="row g-3">
            <div class="col-md-12">
                <x-breadcrumb class="mb-0" heading="Categories Overview">
                    <x-breadcrumb-item href="{{ route('dashboard.view') }}"
                        custom="fw-medium text-decoration-none hover-accent">
                        Dashboard /
                    </x-breadcrumb-item>

                    <x-breadcrumb-item active="true" class="fw-semibold ps-2 position-relative d-inline-block">
                        <span class="text-accent fw-bold">Categories</span>
                    </x-breadcrumb-item>
                    <x-slot:buttons>
                        <x-buttons variant="btn-primary" type="button" modal="modal" modalid="#rohit12"
                            custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                            Add Categories
                        </x-buttons>
                    </x-slot:buttons>

                </x-breadcrumb>
            </div>
            <div class="col-md-12 p-3 bg-aside rounded-3 table-responsive border border-slate">
                <livewire:categorie-table />
                <livewire:category-modal-table />
                <livewire:delete-modal-table />
            </div>
        </div>
    </div>
    <x-modal id="rohit12" formid="catigorieForm" title="Add Categories" size="modal-lg">
        <x-form.input type="text" placeholder="Enter Category Name" label="name" name="name" id="name"
            required="required" custom="text-white" />
        <x-form.input type="text" placeholder="Enter Category Description" label="Description" name="description"
            id="description" required="required" custom="text-white" />
        <x-slot:footer>
            <button type="button" id="triggerModalClose" data-bs-dismiss="modal" class="d-none"></button>
            {{-- <x-buttons type="button" variant="btn-secondary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                Close
            </x-buttons> --}}
            <x-buttons type="submit" variant="btn-primary" custom="btn-md shadow-lg" icon="bi bi-plus-lg">
                Submit
            </x-buttons>
        </x-slot:footer>
    </x-modal>
@endsection

@push('scripts')
    <script>
        const myForm = document.getElementById('catigorieForm');

        myForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            let messagediv = document.getElementById('showmessage');
            // let modalid = document.getElementById('rohit12');
            messagediv.innerText = "data sending...";

            const formdata = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value
            };
            const controllerURL = '/categorie/store';

            try {
                const response = await fetch(controllerURL, {
                    method: 'POST', // 
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(formdata) // 
                });

                const result = await response.json();

                if (response.ok) {
                    messagediv.style.color = "green";
                    messagediv.innerText = `Success: ${result.message}`;
                    myForm.reset();
                    Livewire.dispatch('refreshTable');
                    const closeBtn = document.getElementById('triggerModalClose');
                    if (closeBtn) {
                        closeBtn.click();
                    }
                    // const modalElement = document.getElementById('rohit12');
                    // const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(
                    //     modalElement);
                    // modalInstance.hide();

                    // if (document.activeElement) {
                    //     document.activeElement.blur();
                    // }
                } else {
                    throw new Error(result.message || 'Server standard error');
                }

            } catch (error) {
                console.error("Error details:", error);
                messagediv.style.color = "red";
                messagediv.innerText = `Oops! ${error.message}`;
            }
        });
    </script>
    {{-- <script>
        const myForm = document.getElementById('catigorieForm');
        myForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            let messagediv = document.getElementById('showmessage');
            messagediv.innerText = "data sending...";
            const formdata = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value
            };
            const controllerURL = 'categorie/store';
            try {
                const response = await fetch(controllerURL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: json.stringify(formdata)
                });
                const result = await response.json();
                if (response.ok) {
                    messagediv.style.color = "green";
                    messagediv.innerText = `Success: ${result.message}`;
                    myForm.reset();
                } else {
                    throw new Error(result.message || 'Server standard error');
                }

            } catch (error) {
                console.error("Error details:", error);
                messagediv.style.color = "red";
                messagediv.innerText = `Oops! ${error.message}`;
            }

        })
    </script> --}}
@endpush
