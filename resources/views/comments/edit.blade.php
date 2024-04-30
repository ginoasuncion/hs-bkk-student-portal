@extends('layouts.app')
@section('title', 'Edit Comment')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #3c237f; color: white;">
                    <h3 class="card-title">Edit Comment</h3>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{ route('comments.update', $commentId) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="content" class="form-label">Comment Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ $content }}</textarea>
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
@endsection