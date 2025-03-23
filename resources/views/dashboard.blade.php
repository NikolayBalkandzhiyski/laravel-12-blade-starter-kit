@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 transition-all duration-500 ease-out opacity-0"
        >
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Dashboard</h2>
            <p class="text-gray-600 dark:text-gray-300">
                Welcome back, {{ Auth::user()->name }}! You are logged in to your account.
            </p>
        </div>
    </div>
</div>
@endsection
