<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="savePost">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" wire:model="title">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="content">Content:</label>
            <textarea id="content" wire:model="content"></textarea>
            @error('content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- Image Upload -->
        <div>
            <input type="file" wire:model="photo">
            @error('photo') <span class="error">{{ $message }}</span> @enderror
            
            <!-- Image Preview -->
            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" width="100">
            @endif
        </div>

        <button type="submit">Create Post</button>
    </form>
</div>
