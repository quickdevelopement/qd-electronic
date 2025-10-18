<section>
    <header class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information ") }}
            </p>
        </div>
        <div>
            <a href="{{route('profile.edit')}}"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
            </a>

        </div>
    </header>

    <div class="mt-6 space-y-6">

        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                {{ __('Name:') }}

                <span class=" w-full"> {{ $user->name }} </span>
                <span class="text-sm text-gray-400">({{$user->role == 'admin' ? 'Administrator' : 'User'}})</span>
            </h2>
        </div>

        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Email:') }}
                <span class=" w-full">{{ $user->email }}</span>
            </h2>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Phone:') }}
                <span class=" w-full">{{ $user->phone }}</span>
            </h2>


            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Bio') }}
                <span class=" w-full">{{$user->bio}}</span>
            </h2>
        </div>

    </div>
</section>