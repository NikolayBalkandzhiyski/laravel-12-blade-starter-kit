@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Dashboard
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Welcome back, {{ Auth::user()->name }}!
                </p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 dark:text-indigo-300 bg-indigo-100 dark:bg-indigo-900/30 hover:bg-indigo-200 dark:hover:bg-indigo-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>
                <button id="create-new" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-150 hover:scale-105 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New
                </button>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
            class="transition-all duration-500 ease-out opacity-0">

            <!-- Stat Card 1 -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-xl border border-gray-200 dark:border-gray-700 shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <div class="p-2 rounded-lg bg-indigo-50 dark:bg-indigo-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-white">Users</h3>
                </div>
                <div class="flex items-baseline">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                        1,234
                    </span>
                    <span class="ml-2 text-sm font-medium text-green-600 dark:text-green-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        8.2%
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Total registered users
                </p>
            </div>

            <!-- Stat Card 2 -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-xl border border-gray-200 dark:border-gray-700 shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <div class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-white">Messages</h3>
                </div>
                <div class="flex items-baseline">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                        567
                    </span>
                    <span class="ml-2 text-sm font-medium text-green-600 dark:text-green-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        5.3%
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    New messages this week
                </p>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-xl border border-gray-200 dark:border-gray-700 shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <div class="p-2 rounded-lg bg-purple-50 dark:bg-purple-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-white">Projects</h3>
                </div>
                <div class="flex items-baseline">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                        32
                    </span>
                    <span class="ml-2 text-sm font-medium text-red-600 dark:text-red-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        2.7%
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Active projects
                </p>
            </div>

            <!-- Stat Card 4 -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-xl border border-gray-200 dark:border-gray-700 shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <div class="p-2 rounded-lg bg-green-50 dark:bg-green-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-white">Revenue</h3>
                </div>
                <div class="flex items-baseline">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                        $48.2k
                    </span>
                    <span class="ml-2 text-sm font-medium text-green-600 dark:text-green-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        12.5%
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Total revenue this month
                </p>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Activity Feed -->
            <div class="lg:col-span-2 bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-xl border border-gray-200 dark:border-gray-700 shadow-xl overflow-hidden"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 200)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">

                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50/80 dark:bg-gray-900/50">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Recent Activity</h3>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="p-6 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">New comment on your post</h4>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">2 min ago</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Alex commented on your post "Getting Started with Laravel"
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">New milestone reached</h4>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">1 hour ago</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Your project "Dashboard Redesign" reached 100 subscribers
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">New team member</h4>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">3 hours ago</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Bob joined your team as a developer
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50/80 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                    <a href="#" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                        View all activity →
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-xl border border-gray-200 dark:border-gray-700 shadow-xl overflow-hidden"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 300)"
                x-bind:class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-500 ease-out opacity-0">

                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50/80 dark:bg-gray-900/50">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Quick Actions</h3>
                </div>

                <div class="p-6 space-y-6">
                    <a href="#" class="flex items-center p-3 bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 rounded-lg hover:from-indigo-100 hover:to-blue-100 dark:hover:from-indigo-900/30 dark:hover:to-blue-900/30 transition-colors group">
                        <div class="flex-shrink-0 p-2 rounded-md bg-indigo-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Create a new project</h4>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Start building your next big idea</p>
                        </div>
                        <div class="ml-2 text-indigo-500 dark:text-indigo-400 transition-transform group-hover:translate-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-lg hover:from-purple-100 hover:to-pink-100 dark:hover:from-purple-900/30 dark:hover:to-pink-900/30 transition-colors group">
                        <div class="flex-shrink-0 p-2 rounded-md bg-purple-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Invite team members</h4>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Grow your team and collaborate</p>
                        </div>
                        <div class="ml-2 text-purple-500 dark:text-purple-400 transition-transform group-hover:translate-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-3 bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 rounded-lg hover:from-green-100 hover:to-teal-100 dark:hover:from-green-900/30 dark:hover:to-teal-900/30 transition-colors group">
                        <div class="flex-shrink-0 p-2 rounded-md bg-green-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">View analytics</h4>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Track your project performance</p>
                        </div>
                        <div class="ml-2 text-green-500 dark:text-green-400 transition-transform group-hover:translate-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-3 bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/20 dark:to-amber-900/20 rounded-lg hover:from-yellow-100 hover:to-amber-100 dark:hover:from-yellow-900/30 dark:hover:to-amber-900/30 transition-colors group">
                        <div class="flex-shrink-0 p-2 rounded-md bg-yellow-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Help & Support</h4>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Get assistance and resources</p>
                        </div>
                        <div class="ml-2 text-yellow-500 dark:text-yellow-400 transition-transform group-hover:translate-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
