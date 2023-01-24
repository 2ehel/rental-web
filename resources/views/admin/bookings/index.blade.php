<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.bookings.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Booking</a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="table w-full">
                                <thead class="bg-gray-50 text-center dark:bg-gray-700">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer ID</th>
                                        <th>Car Book</th>
                                        <th>Start Time</th>
                                        <th>Duration</th>
                                        <th>Booking Status </th>
                                        <th class="text-xs">Total Pay</th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                </thead>
                                <tbody class="text-center">
                                    
                                    @forelse ($bookings as $bs)
                                    <tr>
                                        <td class="font-bold">
                                          <div class="text-sm"> {{ $bs->customer_name }}</div>
                                        </td>
                                        <td class="text-sm">{{ $bs->customer_id }}</td>
                                        <td class="text-sm">{{ $bs->car_book->brand ?? $bs->car_id }}</td>
                                        
                                        <td class="text-sm">{{ $bs->start_date->format('d.m.Y H:i') ?? null }}</td>
                                        <td class="text-sm"> {{$bs->duration}} </td>
                                        <td class="text-sm"> {{$bs->booking_status}} </td>
                                        <td> {{ 'RM '.$bs->total_pay}} </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.bookings.edit', $bs->id) }}"
                                                    class="btn btn-secondary btn-sm">Edit</a>
                                                <form
                                                    class="text btn btn-warning btn-sm text-sm text-white"
                                                    method="POST"
                                                    action="{{ route('admin.bookings.destroy', $bs->id) }}"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">DELETE</button>
                                                </form>
                                            </div>
                                        </td>
                                        
                                      </tr>
                                    @empty
                                    <tr>
                                        <td> No Data bro! </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>