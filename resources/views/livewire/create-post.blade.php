<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <form wire:submit.prevent="savePost">
            <div style="display: flex; align-items: center;">
                <div style="margin-right: 20px;">
                    <label for="title">Title:</label>
                    <input type="text" id="title" wire:model="title">
                    @error('title') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="content">Content:</label>
                    <textarea id="content" wire:model="content"></textarea>
                    @error('content') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</div>
