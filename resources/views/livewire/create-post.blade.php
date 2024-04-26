<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <form wire:submit.prevent="save">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" wire:model.live="title">
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="content">Content:</label>
                <textarea id="content" wire:model.live="content"></textarea>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</div>
