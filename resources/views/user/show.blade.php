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
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white"><img src="{{$user->avatar}}"
                                                                                            class="img-40 mt-2"
                                                                                            alt="User avatar"></dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-white">Email address</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{$user->email}}</dd>
                            </div>
                            @if($user->addresses->count())
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-white">Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                        <ul role="list"
                                            class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                            @foreach($user->addresses as $address)
                                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                                    <div class="flex w-0 flex-1 items-center">
                                                        <!-- Heroicon name: mini/map-pin -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                            <path fill-rule="evenodd" d="m9.69 18.933.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 0 0 .281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 1 0 3 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 0 0 2.273 1.765 11.842 11.842 0 0 0 .976.544l.062.029.018.008.006.003ZM10 11.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" clip-rule="evenodd" />
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
