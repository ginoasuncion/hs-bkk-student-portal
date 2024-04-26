<div>
    @if (session()->has('message')) 
    <div class="alert alert-success">
        {{ session('message') }}
</div>
@endif

<form wire:submit="savePost">
    <input type="text" wire:model="title" placeholder="Title"> 
    <textarea wire:model="content" placeholder="Content"></textarea> 
    <button type="submit">Save Post</button>
</form>
</div>