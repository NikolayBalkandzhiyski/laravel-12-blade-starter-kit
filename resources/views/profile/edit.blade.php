@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Your Profile
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Manage your account settings and preferences
            </p>
        </div>

        <div class="space-y-8">
            <!-- Profile Information -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-xl sm:rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 100)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">
                <div class="relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10"></div>
                    <div class="p-6 sm:p-8 relative">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Password Update -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-xl sm:rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 150)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">
                <div class="relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-cyan-500/10"></div>
                    <div class="p-6 sm:p-8 relative">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-xl sm:rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 200)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">
                <div class="relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-orange-500/10"></div>
                    <div class="p-6 sm:p-8 relative">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
