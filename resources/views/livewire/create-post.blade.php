<div>
    @if (session()->has('message')) 
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
    <form wire:submit="savePost">
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
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('post-created', (event) => {
                alert('A new post titled "' + event.title + '" was created!');
            });
        });
    </script>
</div>