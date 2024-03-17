<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                {{ __('Edit User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" class="required" :value="__('Name')"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                          :value="$user->name ?? old('name')" required autofocus autocomplete="name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" class="required" :value="__('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                          :value="$user->email ?? old('email')" required autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- Avatar -->
                        <div class="mt-4">
                            <x-input-label for="avatar" :value="__('Avatar')"/>
                            <x-text-input id="avatar" class="block mt-1 w-full" type="file" name="avatar"
                                          accept="image/*"/>
                            <x-input-error :messages="$errors->get('avatar')" class="mt-2"/>
                            <img src="{{$user->avatar}}" class="img-40 mt-2" alt="User avatar">
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label :value="__('Addresses')"/>
                            <div x-data="{ addresses: {{$user->addresses->pluck('name')}} }">
                                <template x-for="(address, index) in addresses" :key="index">
                                    <div class="flex items-center mt-4">
                                        <x-text-input type="text" x-model="addresses[index]" name="addresses[]" autofocus class="block mt-1 w-full"/>
                                        <button @click.prevent="addresses.splice(index, 1)" type="button" class="ml-2 px-2 py-1 bg-red-500 text-white rounded-md">Remove</button>
                                    </div>
                                </template>
                                <button @click.prevent="addresses.push('')" type="button" class="mt-4 px-2 py-1 bg-green-500 text-white rounded-md">Add More Address</button>
                            </div>
                            <x-input-error :messages="$errors->first('addresses.*')" class="mt-2"/>
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button onClick="window.location='{{ route('users.index')}}'">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
