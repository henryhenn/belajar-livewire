<div>
    <form action="" wire:submit.prevent="store" method="post">
        @csrf
        <div class="form-group row">
            <div class="col">
                <input type="text" name="name" id="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                @error('name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="col">
                <input type="text" wire:model="phone" name="phone" placeholder="Phone Number" id="phone"
                       class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
    </form>
</div>
