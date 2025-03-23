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

        <h2 class="text-2xl font-bold text-center mb-6 text-gray-900 dark:text-white">Welcome Back!</h2>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    Remember me
                </label>
            </div>

            <div>
                <x-button class="w-full justify-center">
                    Log in
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
