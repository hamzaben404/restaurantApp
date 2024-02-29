<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.categories.create') }}"
                    class="px-4 py-2 bg-indigo-500 hove:bg-indigo-700 rounded-lg text-white">New Category</a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4"> <!-- Increase the padding to make it bigger -->
                                    Category Name
                                </th>
                                <th scope="col" class="px-6 py-4">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-4">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-4">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($categories as $category)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 ">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->name }}
                                    </th>
                                    <td
                                        class="px-6 py-4 text-sm fondt-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img src="{{ Storage::url($category->image) }}" class="w-16 h-16 rounded">
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm fondt-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->description }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm fondt-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex space-x-2">
                                            <form method="POST"
                                                class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                onsubmit="return confirm('Are You Sure!!')"
                                                action="{{ route('admin.categories.destroy', $category->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button>Delete</button>
                                            </form>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
