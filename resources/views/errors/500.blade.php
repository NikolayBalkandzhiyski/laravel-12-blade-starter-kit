@extends('layouts.app')

@section('content')
<div class="py-12 flex items-center justify-center min-h-[65vh]">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-xl rounded-2xl overflow-hidden p-8"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
            class="transition-all duration-500 ease-out opacity-0">

            <div class="mx-auto w-24 h-24 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h1 class="text-6xl font-bold text-gray-900 dark:text-white mb-2">
                500
            </h1>

            <h2 class="text-2xl font-medium text-gray-900 dark:text-white mb-4">
                Server Error
            </h2>

            <p class="text-gray-600 dark:text-gray-400 mb-8">
                Oops! Something went wrong. We're working on fixing it.
            </p>

            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-5 py-2 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-150 hover:scale-105 active:scale-95">
                    Go to Homepage
                </a>
                <button onclick="window.history.back()" class="inline-flex items-center justify-center px-5 py-2 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-150 hover:scale-105 active:scale-95">
                    Go Back
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
