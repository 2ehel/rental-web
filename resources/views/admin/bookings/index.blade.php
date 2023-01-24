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
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer ID</th>
                                        <th>Car ID</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Booking Status </th>
                                        <th class="text-xs">Total Pay</th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $bs)
                                    {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $bs->first_name }} {{ $bs->last_name }}
                                        </td>
                                        <td
                                            class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $bs->email }}
                                        </td>
                                        <td
                                            class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $bs->res_date }}
                                        </td>
                                        <td
                                            class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $bs->table->name }}
                                        </td>
                                        <td
                                            class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $bs->guest_number }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.reservations.edit', $bs->id) }}"
                                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg  text-white">Edit</a>
                                                <form
                                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                    method="POST"
                                                    action="{{ route('admin.reservations.destroy', $bs->id) }}"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td class="font-bold">
                                          <div class="text-sm"> {{ $bs->customer_name }}</div>
                                        </td>
                                        <td class="text-sm">{{ $bs->customer_id }}</td>
                                        <td class="text-sm">{{ $bs->car_id }}</td>
                      
                                        <td class="text-sm">{{ $bs->start_date }}</td>
                                        <td class="text-sm"> {{$bs->end_date}} </td>
                                        <td class="text-sm"> {{$bs->booking_status}} </td>
                                        <td> {{ 'RM '.$bs->total_pay}} </td>
                                        <th>
                                          <button class="btn btn-primary btn-xs">details</button>
                                        </th>
                                        {{-- <td><button onclick="Livewire.emit('openModal', 'modal-make-booking')"
                                            class="btn btn-sm btn-secondary gap-2">Book</button></td> --}}
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