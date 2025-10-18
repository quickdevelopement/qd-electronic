<x-dashboard-layout>
    <x-slot:title>
         {{ __('Edit Profile Information') }}
    </x-slot:title>
        
    <div class="p-4 sm:ml-64">
         <div class="grid grid-cols-1 gap-4 mb-4 p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            
        </div>
    </div>
</x-dashboard-layout>
