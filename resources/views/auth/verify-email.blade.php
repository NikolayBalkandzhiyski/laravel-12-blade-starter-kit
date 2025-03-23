@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div
            class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-xl rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
            class="transition-all duration-500 ease-out opacity-0"
        >
            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-blue-500/10"></div>
                <div class="p-6 sm:p-8 relative">
                    <div class="flex items-center justify-center mb-8">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-blue-500 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-4">
                        Verify Your Email Address
                    </h2>

                    <div class="mb-6 text-center text-gray-600 dark:text-gray-400">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?<br>If you didn't receive the email, we will gladly send you another.
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <p class="text-center font-medium text-sm text-green-600 dark:text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto mb-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                A new verification link has been sent to the email address you provided during registration.
                            </p>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mt-8">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-purple-500 to-blue-600 text-white font-medium rounded-lg hover:from-purple-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform transition-all duration-150 hover:scale-105 active:scale-95 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Resend Verification Email
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
