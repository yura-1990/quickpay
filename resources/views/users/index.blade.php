<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            {{ __('Users') }}
            @if(auth()->user()->can('Add Users') || auth()->user()->hasRole('supper-admin'))
                <a href="{{ route('users.create') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create <span class="ml-2" aria-hidden="true">+</span>
                </a>
           @endif
        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">№</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                    @foreach($users as $user)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-3 text-sm flex gap-3 items-center">
                                @if(auth()->user()->can('Read Users') || auth()->user()->hasRole('supper-admin'))
                                    <x-primary-button>
                                        <a href="{{ route('users.show', ['user' => $user->id]) }}" >Browse</a>
                                    </x-primary-button>
                                @endif
                                @if(auth()->user()->can('Update Users') || auth()->user()->hasRole('supper-admin'))
                                    <x-secondary-button>
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
                                    </x-secondary-button>
                                @endif
                                @if(auth()->user()->can('Delete Users') || auth()->user()->hasRole('supper-admin'))
                                    <form action="{{ route('users.destroy',  ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit">Delete</x-danger-button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
