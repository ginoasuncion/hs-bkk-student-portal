<div class="container mt-5">
    <h2 class="mb-4">Edit Post</h2>
    <div class="form-group">
        <input type="text" wire:model="title" class="form-control" placeholder="Title">
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <textarea wire:model="content" class="form-control" rows="5" placeholder="Content"></textarea>
        @error('content') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        @foreach($existingPhotos as $photo)
            <img src="{{ Storage::url($photo->photo_path) }}" alt="{{ $title }}" width="100" class="mr-2">
            <button wire:click="removePhoto({{ $photo->id }})" class="btn btn-danger btn-sm">Delete</button>
        @endforeach
    </div>
    <div class="form-group">
        <label>Upload New Photos:</label>
        <input type="file" wire:model="photos" multiple class="form-control-file">
        @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        @if ($photos)
            @foreach($photos as $photo)
                <img src="{{ $photo->temporaryUrl() }}" width="100" class="mr-2">
            @endforeach
        @endif
    </div>
    <button wire:click="save" class="btn btn-primary">Update Post</button>
</div>
