@extends('layouts.guest')

@section('content')
    <main class="page-center">
         <h1 class="sign-up__title">Welcome to Exam Center Management System</h1>
        <article class="sign-up">

            <p class="sign-up__subtitle">Sign in to your account to continue</p>
            <form class="sign-up-form form" method="POST" action="{{ route('login') }}">
                {{--  @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Please check your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif  --}}

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
                        class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </label>
                {{--  <div class="text-center">
                    <button type="submit" class="form-btn primary-default-btn transparent-btn"
                        >Sign in</button>
                </div>  --}}
                {{--  <a class="link-info forget-link" href="##">Forgot your password?</a>  --}}
                <label class="form-checkbox-wrapper">
                    {{--  <input class="form-checkbox" type="checkbox" required>
                    <span class="form-checkbox-label">Remember me next time</span>  --}}
                </label>
                <button class="form-btn primary-default-btn transparent-btn">Sign in</button>
            </form>
        </article>
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
