<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.cars.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Car</a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Model</th>
                                        <th>Owner</th>
                                        <th>Car Plate</th>
                                        <th>Year<br>Register </th>
                                        <th class="text-xs">Charge<br>(per hour)</th>
                                        <th class="text-xs">Charge<br>(per day)</th>
                                        <th>Car Image</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cars as $item => $r)
                                        <!-- row 1 -->
                                        <tr>
                                            {{-- <th>
                                            <label>
                                                <input type="checkbox" class="checkbox" />
                                            </label>
                                        </th> --}}
                                            <td class="font-bold">
                                                <div class="flex items-center space-x-3">
                                                    <div>
                                                        <div class="text-sm"> {{ $r->brand }}</div>
                                                        <div class="font-bold">{{ $r->model }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-sm">{{ $r->name }}</td>
                                            <td class="text-sm"> {{ $r->car_plate }} </td>
                                            <td class="text-sm"> {{ $r->year_register }} </td>

                                            <td> {{ 'RM ' . $r->charge_per_hour }} </td>
                                            <td> {{ 'RM ' . $r->charge_per_day }} </td>
                                            <td class="text-sm">
                                                <div> @isset($r->image) 
                                                     <img src="{{ Storage::url($r->image) }}" class="w-16 h-16 rounded"></div>
                                                     @endisset
                                            </td>
                                            <th>
                                                <button class="btn btn-primary btn-xs">details</button>
                                            </th>

                                            <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.cars.edit', $r->id) }}"
                                                        class="btn btn-secondary btn-sm">Edit</a>
                                                    <form class="text btn btn-warning btn-sm text-sm text-white"
                                                        method="POST"
                                                        action="{{ route('admin.cars.destroy', $r->id) }}"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">DELETE</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td> Sorry There Are No Data For Now </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <!-- foot -->
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
