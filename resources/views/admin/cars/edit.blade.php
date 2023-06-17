<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.cars.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Car Index</a>
            </div>
            {{-- {{dd($cars)}} --}}

            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.cars.update', $cars->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Full Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" value="{{ $cars->name }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="model" class="block text-sm font-medium text-gray-700"> Model </label>
                            <div class="mt-1">
                                <input type="text" id="model" name="model" value="{{ $cars->model }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('model')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="brand" class="block text-sm font-medium text-gray-700"> Brand </label>
                            <div class="mt-1">
                                <input type="brand" id="brand" name="brand" value="{{ $cars->brand }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('brand')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="car_plate" class="block text-sm font-medium text-gray-700"> Car Plate
                            </label>
                            <div class="mt-1">
                                <input type="text" id="car_plate" name="car_plate" value="{{ $cars->car_plate }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('car_plate')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        @php
                            $year_range = range(2013, 2023);
                            
                        @endphp
                        <div class="sm:col-span-6">
                            <label for="year_register" class="block text-sm font-medium text-gray-700"> Year Register
                            </label>
                            <div class="mt-1">
                                <select id="year_register" name="year_register"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    @foreach ($year_range as $y)
                                        <option value="{{ $y }}"> {{ $y }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('year_register')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="location" class="block text-sm font-medium text-gray-700"> Location
                            </label>
                            <div class="mt-1">
                                <input type="text" id="location" name="location" value="{{ $cars->location}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('location')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="car_status" class="block text-sm font-medium text-gray-700"> Car Status
                            </label>
                            <div class="mt-1">
                                <input type="text" id="car_status" name="car_status" value="Available" 
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('car_status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="charge_per_hour" class="block text-sm font-medium text-gray-700"> Charge Per Hour
                            </label>
                            <div class="mt-1">
                                <input type="number" id="charge_per_hour" name="charge_per_hour"
                                    value="{{ $cars->charge_per_hour}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('charge_per_hour')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="charge_per_day" class="block text-sm font-medium text-gray-700"> Charge Per Day
                            </label>
                            <div class="mt-1">
                                <input type="number" id="charge_per_day" name="charge_per_day"
                                    value="{{ $cars->charge_per_day }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('charge_per_day')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Car
                                Description</label>
                            <div class="mt-1">
                                <div class="form-control">
                                    <label class="cursor-pointer label">
                                        <span class="label-text">Auto</span>
                                        <input type="checkbox" checked="checked" name="description[]" value="Auto"
                                            class="checkbox checkbox-sm" />
                                    </label>
                                <div class="cursor-pointer label">
                                    <span class="label-text">Manual</span>
                                    <input type="checkbox" checked="checked" name="description[]" value="Manual"
                                        class="checkbox checkbox-sm" />
                                </div>
                                <div class="cursor-pointer label">
                                    <span class="label-text">5 seaters</span>
                                    <input type="checkbox" checked="checked" name="description[]" value="5_seat"
                                        class="checkbox checkbox-sm" />
                                </div>
                                <div class="cursor-pointer label">
                                    <span class="label-text">7 seaters</span>
                                    <input type="checkbox" checked="checked" name="description[]" value="7_seat"
                                        class="checkbox checkbox-sm" />
                                </div>
                            </div>

                            </div>
                            @error('description')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700"> Car Image
                            </label>
                            <div>
                                <img class="w-32 h-32" src="{{Storage::url($cars->image)}}"> 
                            </div>
                            <div class="mt-1">
                                <input type="file" id="image" name="image"
                                    class="file-input file-input-sm w-full max-w-xs" />
                            </div>
                            @error('image')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
