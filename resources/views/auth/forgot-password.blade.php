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

        <h2 class="text-2xl font-bold text-center mb-2 text-gray-900 dark:text-white">Forgot Password</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-6">
            No problem. Enter your email address and we'll send you a link to reset your password.
        </p>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-button class="w-full justify-center">
                    Send Password Reset Link
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                Back to Login
            </a>
        </div>
    </div>
</div>
@endsection
