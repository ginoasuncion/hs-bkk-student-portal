@section('title', 'Edit Comment')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header" style="background-color: #3c237f; color: white;"> <!-- Changed background color and text color -->
                    <h3 class="card-title">Edit Comment</h3>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label for="content" class="form-label">Comment Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" wire:model="content" rows="5"></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn" style="background-color: #3c237f; color: white;">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
