<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                {{ __('User Show') }}
            </h2>
            <x-secondary-button onClick="window.location='{{ route('users.index')}}'" class="">
                {{ __('Back') }}
            </x-secondary-button>
        </div>
    </x-slot>

    {{--    <div class="py-12">--}}
    {{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
    {{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
    {{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
    {{--                    <form method="POST" action="{{ route('users.update', $user->id) }}">--}}
    {{--                        @csrf--}}
    {{--                        @method('PUT')--}}

    {{--                        <!-- Name -->--}}
    {{--                        <div>--}}
    {{--                            <x-input-label for="name" :value="__('Name')"/>--}}
    {{--                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"--}}
    {{--                                          :value="$user->name ?? old('name')" required autofocus autocomplete="name"/>--}}
    {{--                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>--}}
    {{--                        </div>--}}

    {{--                        <!-- Email Address -->--}}
    {{--                        <div class="mt-4">--}}
    {{--                            <x-input-label for="email" :value="__('Email')"/>--}}
    {{--                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"--}}
    {{--                                          :value="$user->email ?? old('email')" required autocomplete="username"/>--}}
    {{--                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>--}}
    {{--                        </div>--}}

    {{--                        <!-- New  -->--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-hidden  shadow sm:rounded-lg">

                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">User Information</h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-white">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{$user->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-white">Avatar</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white"><img src="{{$user->avatar}}" class="img-40 mt-2" alt="User avatar"></dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-white">Email address</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{$user->email}}</dd>
                            </div>
                            @if($user->addresses->count())
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-white">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                        @foreach($user->addresses as $address)
                                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                                <div class="flex w-0 flex-1 items-center">
                                                    <!-- Heroicon name: mini/paper-clip -->
                                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                         fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                              d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                    <span class="ml-2 w-0 flex-1 truncate">{{$address->name}}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </div>
                                @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
