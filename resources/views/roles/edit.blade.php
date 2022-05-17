<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('roles.update', $role) }}">
                        @csrf
                        @method('PUT')

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$role->name"
                                autofocus />
                        </div>

                        {{-- <div class="mt-4">
                            <x-label for="permissions" :value="__('Permissions')" class="mb-2" />
                            @foreach (json_decode($role->permissions) as $key => $item)
                                <div class="flex items-center mr-4">
                                    <x-input aria-checked="true" checked="true" :id="$key . $item . '-checkbox'" type="checkbox"
                                        name="permissions[]" :value="$item"
                                        class="w-4 h-4 bg-gray-100 rounded border-gray-300 cursor-pointer" />
                                    <x-label :for="$key . $item . '-checkbox'"
                                        class="ml-2 text-sm font-medium text-gray-900 cursor-pointer capitalize"
                                        value="{{ __($item) }}" />
                                </div>
                            @endforeach
                        </div> --}}

                        <!-- Permissions -->
                        <div class="mt-4">
                            <x-label for="permissions" :value="__('Permissions')" class="mb-2" />
                            @foreach (config('globale.permissions') as $name => $value)
                                <div class="flex items-center mr-4">
                                    <x-input :id="$name . '-checkbox'" type="checkbox" name="permissions[]" :value="$name"
                                        :checked="in_array($name, json_decode($role->permissions)) ? true : false"
                                        class="w-4 h-4 bg-gray-100 rounded border-gray-300 cursor-pointer" />
                                    <x-label :for="$name . '-checkbox'"
                                        class="ml-2 text-sm font-medium text-gray-900 cursor-pointer capitalize"
                                        value="{{ __($value) }}" />
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
