<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-5">
            <a href="">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="blue" version="1.1" id="Capa_1" width="800px" height="800px" viewBox="0 0 45.58 45.58" xml:space="preserve">
                <g>
                    <path d="M45.506,33.532c-1.741-7.42-7.161-17.758-23.554-19.942V7.047c0-1.364-0.826-2.593-2.087-3.113   c-1.261-0.521-2.712-0.229-3.675,0.737L1.305,19.63c-1.739,1.748-1.74,4.572-0.001,6.32L16.19,40.909   c0.961,0.966,2.415,1.258,3.676,0.737c1.261-0.521,2.087-1.75,2.087-3.113v-6.331c5.593,0.007,13.656,0.743,19.392,4.313   c0.953,0.594,2.168,0.555,3.08-0.101C45.335,35.762,45.763,34.624,45.506,33.532z"/>
                </g>
            </svg>
            </a>
            {{ __('Update Role') }}
        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="" method="POST" >
            @csrf
            @method('PUT')
            <div class="w-full">
                <x-input-label value="Role Name" for="role-name" class="text-lg font-samibold" />
                <x-text-input id="role-name" class="w-full" name="name"  />
            </div>


            <div class="w-max ml-auto">
                <x-secondary-button type="submit">Update</x-secondary-button>
            </div>
        </form>
    </div>
</x-app-layout>
