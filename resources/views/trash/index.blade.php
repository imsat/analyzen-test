<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                {{ __('Trash') }}
            </h2>
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
                            <x-th>Deleted At</x-th>
                            <x-th>Action</x-th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <x-td>{{$user->id}}</x-td>
                                <x-td>{{$user->name}}</x-td>
                                <x-td>{{$user->deleted_at}}</x-td>
                                <x-td>
                                    <form action="{{route('users.restore', $user->id)}}" class="inline-flex" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <x-primary-button onclick="return confirm('Are you sure to restore?')">
                                            {{ __('Restore') }}
                                        </x-primary-button>
                                    </form>
                                    <form action="{{route('users.permanently-destroy', $user->id)}}" class="inline-flex" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button onclick="return confirm('Are you sure to permanently delete?')">
                                            {{ __('Permanently Delete') }}
                                        </x-danger-button>
                                    </form>
                                </x-td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="py-5">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
