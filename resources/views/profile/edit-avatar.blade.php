<x-dashboard-layout>
    <x-slot:title>
        {{ __('Update Avatar') }}
    </x-slot:title>

    <div class="p-4 sm:ml-64">
        <div
            class="grid grid-cols-2 gap-4 mb-4 p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="post" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data"
                    class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="avatar" :value="__('Avatar')" />
                        <x-upload-image />
                        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                </form>
                        @if (session('status') === 'avatar-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                        @endif
                    </div>

            </div>
</x-dashboard-layout>