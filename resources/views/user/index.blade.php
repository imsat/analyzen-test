<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                {{ __('User Management') }}
            </h2>
            <x-a-button href="{{route('users.create')}}">
                {{ __('Add New') }}
            </x-a-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table
                        class="bg-white dark:bg-gray-800 dark:text-white min-w-full divide-y divide-gray-300 text-center">
                        <thead>
                        <tr>
                            <x-th>Id</x-th>
                            <x-th>Name</x-th>
                            <x-th>Email</x-th>
                            <x-th>Avatar</x-th>
                            <x-th>Created At</x-th>
                            <x-th>Action</x-th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <x-td>{{$user->id}}</x-td>
                                <x-td>{{$user->name}}</x-td>
                                <x-td>{{$user->email}}</x-td>
                                <x-td><img src="{{$user->avatar}}" width="20" height="20"
                                           alt="User avatar"></x-td>
                                <x-td>{{$user->created_at}}</x-td>
                                <x-td>
                                    <x-a-button href="{{route('users.show', $user->id)}}" class="bg-cyan-600 hover:bg-cyan-700 focus:ring-cyan-500">
                                        {{ __('Show') }}
                                    </x-a-button>
                                    <x-a-button href="{{route('users.edit', $user->id)}}">
                                        {{ __('Edit') }}
                                    </x-a-button>
                                    <form action="{{route('users.destroy', $user->id)}}" class="inline-flex"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button onclick="return confirm('Are you sure to delete?')">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                </x-td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="py-5 px-2">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
