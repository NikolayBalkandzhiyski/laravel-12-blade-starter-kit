<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <x-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 focus:ring-red-500"
    >Delete Account</x-button>

    <div
        x-data="{ show: false, open: false }"
        x-on:open-modal.window="$event.detail == 'confirm-user-deletion' ? (open = true, show = true) : null"
        x-on:close-modal.window="open = false; setTimeout(() => { show = false }, 300)"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50"
        style="display: none;"
    >
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            @click.away="$dispatch('close-modal')"
            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform w-full max-w-md p-6"
        >
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <x-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full"
                        placeholder="Password"
                    />

                    @error('password', 'deleteUser')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <x-button type="button" @click="$dispatch('close-modal')" class="bg-gray-600 hover:bg-gray-700 mr-3">
                        Cancel
                    </x-button>

                    <x-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500">
                        Delete Account
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</section>
