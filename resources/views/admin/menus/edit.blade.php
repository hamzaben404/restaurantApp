<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.menus.index') }}"
                    class="px-4 py-2 bg-indigo-500 hove:bg-indigo-700 rounded-lg text-white">Menus</a>
            </div>
            <div class="bg-white bg-slate-100 rounded shadow-sm m-2 p-2">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form enctype="multipart/form-data" action="{{ route('admin.menus.update', $menu->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <div class="mt-1">
                                <input type="text" id="name" wire:model.lazy="name" name="name"
                                    class="block w-full transition @error('name') border-red-500 @enderror"
                                    value="{{ old('name', $menu->name) }}" />
                            </div>
                            @error('name')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <img src="{{ Storage::url($menu->image) }}"
                                class="w-20 h-20 rounded @error('name') border-red-500 @enderror">
                            <div class="mt-1">
                                <input type="file" id="image" wire:model="newImage" name="image"
                                    class="block w-full transition  @error('image') border-red-500 @enderror" />
                            </div>
                            @error('image')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea id="body" rows="3" wire:model.lazy="body"
                                    class="shadow-sm focus:ring-indigo-500 appearance-none block w-full transition @error('description') border-red-500 @enderror"
                                    name="description">{{ old('description', $menu->description) }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="body" class="block text-sm font-medium text-gray-700">Price</label>
                            <div class="mt-1">
                                <input type="number" id="body" rows="3" wire:model.lazy="body"
                                    class="shadow-sm focus:ring-indigo-500 appearance-none block w-full transition @error('price') border-red-500 @enderror"
                                    name="price" value="{{ old('price', $menu->price) }}" />
                            </div>
                            @error('price')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                            <div class="mt-1">
                                <select id="categories" name="categories[]" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($menu->categories->contains($category))>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 p-4">
                            <button class="px-4 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white p-2"
                                type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
