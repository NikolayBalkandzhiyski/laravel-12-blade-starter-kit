@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 100)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 150)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 200)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
