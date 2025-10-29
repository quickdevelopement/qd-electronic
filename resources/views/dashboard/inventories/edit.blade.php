<x-dashboard-layout>
    <x-slot:title>
         {{ __('Edit Inventory') }}
    </x-slot:title>
        
    <div class="p-4 sm:ml-64">
         <div class="grid grid-cols-1 gap-4 mb-4 p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            
            <div class="p-4  bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                   @include('dashboard.inventories.partials.inventoryform')
                </div>
            </div>

          
        </div>
    </div>
</x-dashboard-layout>

