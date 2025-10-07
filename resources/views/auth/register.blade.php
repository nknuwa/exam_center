@extends('layouts.guest')

@section('content')
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">Sign Up Here</h1>
            <p class="sign-up__subtitle">Create your account to continue</p>

            <form class="sign-up-form form" method="POST" action="{{ route('register') }}">
                @csrf
                <label class="form-label-wrapper">
                    <p class="form-label">Name</p>
                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name"
                        value="{{ old('name') }}" required autofocus autocomplete="name">
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email"
                        value="{{ old('email') }}" required autocomplete="username">
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Password</p>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password"
                        required autocomplete="new-password">
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Confirm Password</p>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                        name="password_confirmation" required autocomplete="new-password">
                </label>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>  --}}
