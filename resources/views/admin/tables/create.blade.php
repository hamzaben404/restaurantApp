<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.tables.index') }}"
                    class="px-4 py-2 bg-indigo-500 hove:bg-indigo-700 rounded-lg text-white">Tables</a>
            </div>
            <div class="bg-white bg-slate-100 rounded shadow-sm m-2 p-2">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.tables.store') }}">
                        @csrf

                        <div class="sm:col-span-6">
                            <label for="name" class="form-label">Name</label>
                            <div class="mt-1">
                                <input type="text" class="form-control @error('name') border-red-400 @enderror" id="name" name="name"
                                    value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="text-sm text-red-400">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="guest_number" class="form-label">Guest Number</label>
                            <div class="mt-1">
                                <input type="number" class="form-control @error('guest_number') border-red-400 @enderror" id="guest_number" name="guest_number"
                                    value="{{ old('guest_number') }}">
                            </div>
                            @error('guest_number')
                                <div class="text-sm text-red-400">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="status" class="form-label">Status</label>
                            <div class="mt-1">
                                <select class="form-control" id="status" name="status" required>
                                    @foreach (App\Enums\TableStatus::cases() as $status)
                                        <option value="{{$status->value}}">{{ $status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="location" class="form-label">Location</label>
                            <div class="mt-1">
                                <select class="form-control" id="location" name="location" required>
                                    @foreach (App\Enums\TableLocation::cases() as $location)
                                        <option value="{{ $location->value }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 p-4">
                            <button class="px-4 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white p-2"
                                type="submit">Store</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
