@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-4">
    <div
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 100)"
        x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
        class="auth-card transition-all duration-500 ease-out opacity-0"
    >
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200 mb-6">
            Verify Email Address
        </h2>

        <div class="mb-6 text-gray-600 dark:text-gray-400">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        @if (session('status') === 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-button>
                    Resend Verification Email
                </x-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
