<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.reservations.index') }}"
                    class="px-4 py-2 bg-indigo-500 hove:bg-indigo-700 rounded-lg text-white">Reservations</a>
            </div>
            <div class="bg-white bg-slate-100 rounded shadow-sm m-2 p-2">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <div class="mt-1">
                                <input type="text" id="first_name" wire:model.lazy="first_name" name="first_name"
                                    class="block w-full transition @error('first_name') border-red-500 @enderror"
                                    value="{{ old('first_name', $reservation->first_name) }}" />
                            </div>
                            @error('first_name')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <div class="mt-1">
                                <input type="text" id="last_name" wire:model.lazy="last_name" name="last_name"
                                    class="block w-full transition @error('last_name') border-red-500 @enderror"
                                    value="{{ old('last_name', $reservation->last_name) }}" />
                            </div>
                            @error('last_name')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input type="email" id="email" wire:model.lazy="email" name="email"
                                    class="block w-full transition @error('email') border-red-500 @enderror" value="{{ old('email', $reservation->email) }}" />
                            </div>
                            @error('email')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="tel_number" class="block text-sm font-medium text-gray-700">Tele Number</label>
                            <div class="mt-1">
                                <input type="text" id="tel_number" wire:model.lazy="tel_number" name="tel_number"
                                    class="block w-full transition @error('tel_number') border-red-500 @enderror"
                                    value="{{ old('tel_number', $reservation->tel_number) }}" />
                            </div>
                            @error('tel_number')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="res_date" class="block text-sm font-medium text-gray-700">Reservation
                                Date</label>
                            <div class="mt-1">
                                <input type="datetime-local" id="res_date" wire:model.lazy="res_date" name="res_date"
                                    class="block w-full transition @error('res_date') border-red-500 @enderror"
                                    value="{{ old('res_date', $reservation->res_date) }}" />
                            </div>
                            @error('res_date')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700">Guest
                                Number</label>
                            <div class="mt-1">
                                <input type="number" id="guest_number" wire:model.lazy="guest_number"
                                    name="guest_number" class="block w-full transition @error('guest_number') border-red-500 @enderror"
                                    value="{{ old('guest_number', $reservation->guest_number) }}" />
                            </div>
                            @error('guest_number')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="table_id" class="form-label">Table Name</label>
                            <div class="mt-1">
                                <select class="form-control" id="table_id" name="table_id" required>
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}" @selected($reservation->table_id == $table->id)>
                                            {{ $table->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('first_name')
                                <div>{{ $message }}</div>
                            @enderror
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
