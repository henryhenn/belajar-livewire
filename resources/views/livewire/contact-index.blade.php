<div>
    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif
    @if($statusUpdate)
        <livewire:contact-update></livewire:contact-update>
    @else
        <livewire:contact-create></livewire:contact-create>
    @endif

    <div class="row mt-3">
        <div class="col d-flex">
            <label for="pagination">Paginate:</label>
            <select wire:model="paginate" id="pagination" class="ms-2 form-control form-control-md w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <div class="col">
            <input type="text" placeholder="Search Here" wire:model="search" class="form-control form-control-md">
        </div>
    </div>

    <table class="table table-responsive mt-4">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $key => $contact)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <th scope="row">{{$contact->name}}</th>
                <th scope="row">{{$contact->phone}}</th>
                <th scope="row">
                    <div class="d-flex">
                        <button class="btn btn-sm btn-warning text-white me-2"
                                wire:click="getContact({{$contact->id}})">Edit
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm" wire:click="destroy({{$contact->id}})">
                            Delete
                        </button>
                    </div>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$contacts->links() }}
</div>
