<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="relative overflow-x-auto shadow-md rounded">
                        <div class="py-4 flex items-center gap-2">
                            <div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search for items">
                                </div>
                            </div>
                            @can('roles.create')
                                <a href="{{ route('roles.create') }}"
                                    class="font-bold text-blue-600 dark:text-blue-500 hover:underline">Create</a>
                            @endcan
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Permissions
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $item)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap capitalize">
                                            {{ $item->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            @foreach (json_decode($item->permissions) as $permission)
                                                <span
                                                    class="p-1 dark:bg-gray-500 dark:text-gray-300 rounded capitalize">{{ $permission }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                                            @can('roles.show')
                                                <a href="{{ route('roles.show', $item) }}"
                                                    class="font-bold text-blue-600 dark:text-blue-500 hover:underline capitalize">{{ __('view') }}</a>
                                            @endcan

                                            @can('roles.edit')
                                                <a href="{{ route('roles.edit', $item) }}"
                                                    class="font-bold text-green-600 dark:text-green-500 hover:underline capitalize">{{ __('edit') }}</a>
                                            @endcan

                                            @can('roles.destroy')
                                                <form method="POST" action="{{ route('roles.destroy', $item->id) }}"
                                                    class="m-0 p-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('are you sure to delete this role')"
                                                        class="font-bold text-red-600 dark:text-red-500 hover:underline capitalize">
                                                        {{ __('delete') }}
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
</x-app-layout>
