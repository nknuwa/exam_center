@extends('layouts.guest')

@section('content')
    <main class="page-right">
        <div class="login-container">
            <!-- Left column: Title -->
            <div class="login-left">
                <h1 class="sign-up__title">Welcome to Exam Center Management System</h1>
                <p class="sign-up__subtitle">Sign in to your account to continue</p>
            </div>

            <!-- Right column: Form -->
            <div class="login-right">
                <article class="sign-up">
                    <form class="sign-up-form form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <label class="form-label-wrapper">
                            <p class="form-label">Email</p>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="form-control form-control-lg" placeholder="Email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </label>

                        <label class="form-label-wrapper">
                            <p class="form-label">Password</p>
                            <input type="password" name="password" required autocomplete="current-password"
                                class="form-control form-control-lg" placeholder="Password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </label>

                        <button class="form-btn primary-default-btn transparent-btn mt-3">Sign in</button>
                    </form>
                </article>
            </div>
        </div>
    </main>
@endsection



{{--  <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>  --}}
