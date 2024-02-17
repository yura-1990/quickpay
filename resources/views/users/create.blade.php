<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-5">
            <a href="{{ route('users.index') }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="blue" version="1.1" id="Capa_1" width="800px" height="800px" viewBox="0 0 45.58 45.58" xml:space="preserve">
                <g>
                    <path d="M45.506,33.532c-1.741-7.42-7.161-17.758-23.554-19.942V7.047c0-1.364-0.826-2.593-2.087-3.113   c-1.261-0.521-2.712-0.229-3.675,0.737L1.305,19.63c-1.739,1.748-1.74,4.572-0.001,6.32L16.19,40.909   c0.961,0.966,2.415,1.258,3.676,0.737c1.261-0.521,2.087-1.75,2.087-3.113v-6.331c5.593,0.007,13.656,0.743,19.392,4.313   c0.953,0.594,2.168,0.555,3.08-0.101C45.335,35.762,45.763,34.624,45.506,33.532z"/>
                </g>
            </svg>
            </a>
            {{ __('Create Users') }}
        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('users.store') }}" method="POST" >
            @csrf

            <div class="w-full mb-2">
                <x-input-label value="User Name" for="user-name" class="text-lg font-samibold" />
                <x-text-input id="user-name" class="w-full" name="name" />
            </div>
            <div class="w-full my-2">
                <x-input-label value="User Email" for="user-email" class="text-lg font-samibold" />
                <x-text-input id="user-email" class="w-full" name="email" />
            </div>
            <div class="w-full my-2">
                <x-input-label value="User Password" for="user-password" class="text-lg font-samibold" />
                <x-text-input id="user-password" class="w-full" name="password" />
            </div>
            <div class="w-full my-2">
                <x-input-label value="Repeat Password" for="user-password_repetition" class="text-lg font-samibold" />
                <x-text-input id="user-password_repetition" class="w-full" name="password_confirmation" />
            </div>

            <div class="w-full my-2">
                <x-input-label value="Select Roles" for="roles" class="text-lg font-samibold " />
                <select multiple id="roles" name="roles[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-max ml-auto mt-4">
                <x-secondary-button type="submit">Submit</x-secondary-button>
            </div>
        </form>
    </div>
</x-app-layout>
