@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                <div class="card-header text-center" style="background-color: #3c237f; color: white; border-color: #3c237f;">{{ __('Register an account') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Name -->
                            @include('components.form-input', [
                                'type' => 'text',
                                'name' => 'name',
                                'label' => 'Name',
                                'value' => old('name'),
                                'required' => true,
                            ])

                            <!-- Email Address -->
                            @include('components.form-input', [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'Email Address',
                                'value' => old('email'),
                                'required' => true,
                            ])

                            <!-- Password -->
                            @include('components.form-input', [
                                'type' => 'password',
                                'name' => 'password',
                                'label' => 'Password',
                                'required' => true,
                            ])

                            <!-- Confirm Password -->
                            @include('components.form-input', [
                                'type' => 'password',
                                'name' => 'password_confirmation',
                                'label' => 'Confirm Password',
                                'required' => true,
                            ])

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" style="background-color: #3c237f; color: white;">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
