<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('bookings.step.one') }}"
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
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($bookings as $bs)
                                    <tr>
                                        <td class="font-bold">
                                            <div class="text-sm"> {{ $bs->customer_name }}</div>
                                        </td>
                                        <td class="text-sm">{{ $bs->customer_id }}</td>
                                        <td class="text-sm">{{ $bs->car_book->brand." ".$bs->car_book->model ??
                                            $bs->car_id }} <br> {{"(".$bs->car_book->car_plate.")"}}</td>
                                        <td class="text-sm">{{ $bs->start_date->format(' H:i d/m/Y') ?? null }}</td>
                                        <td class="text-sm"> {{$bs->duration." ".$bs->duration_option}} </td>
                                        <td class="text-sm ">
                                            @if ($bs->booking_status == 'Pending')
                                            <span class="badge badge-secondary"> {{$bs->booking_status}} </span>
                                            @elseif ($bs->booking_status == 'Negotation')
                                            <span class="badge "> {{$bs->booking_status}} </span>
                                            @elseif ($bs->booking_status == 'Cancel')
                                            <span class="badge error"> {{$bs->booking_status}} </span>
                                            @elseif ($bs->booking_status == 'Success')
                                            <span class="badge badge-success"> {{$bs->booking_status}} </span>
                                            @else 
                                            <span class="badge badge-warning"> {{$bs->booking_status}} </span>
                                            @endif
                                        </td>

                                        <td> {{ 'RM '.$bs->total_pay}} </td>
                                        <td>
                                            <label for="my-modal-6" class="btn btn-sm btn-primary text text-sm">Update Status</label>
                                            <!-- Put this part before </body> tag -->
                                            <input type="checkbox" id="my-modal-6" class="modal-toggle" />
                                            <div class="modal">
                                                <div class="modal-box w-11/12 max-w-xs">
                                                    <label for="my-modal-6"
                                                        class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                                    <form  method="POST" action="{{ route('bookings.updateStatus', $bs->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                            <div>
                                                                <input type="hidden" id="id" name="id" value="{{$bs->id}}"
                                                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                            </div>
                                                            <label for="booking_status"  class="block text-sm font-medium text-gray-700">Booking Status</label>
                                                            <div class="mt-1">
                                                                <select id="booking_status" name="booking_status"
                                                                    class="select select-sm select-bordered">
                                                                    <option value="Pending"> Pending </option>
                                                                    <option value="Check In"> Check In </option>
                                                                    <option value="Check Out"> Check Out</option>
                                                                    <option value="Payment Success">Payment Success</option>
                                                                    {{-- <option value="Success"> Success </option> --}}
                                                                </select>
                                                            </div>
                                                            @error('booking_status')
                                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                                            @enderror
                                                        <div class="mt-6 p-4">
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg btn btn-sm text-white">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
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
    </div>
</x-app-layout>