@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-4">
    <div
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 100)"
        x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
        class="auth-card transition-all duration-500 ease-out opacity-0"
    >
        <div class="flex justify-center mb-6">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </div>

        <h2 class="text-2xl font-bold text-center mb-6 text-gray-900 dark:text-white">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <x-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Confirm Password
                </label>
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div>
                <x-button class="w-full justify-center">
                    Reset Password
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection
