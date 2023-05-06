<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->category == 'Admin')
            @endif
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="table w-full">
                                <thead class="bg-gray-50 text-center dark:bg-gray-700">
                                    <tr>
                                        <th>History Number</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Booking Number</th>
                                        <th>Invoice Number</th>
                                        {{-- <th class="text-xs">Total Pay</th> --}}
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    {{-- {{dd($bookings)}} --}}
                                    @forelse ($history as $bh)
                                    <tr>
                                        <td class="font-bold">
                                            <div class="text-sm"> {{ $bh->history_no }}</div>
                                        </td>
                                        <td class="text-sm">{{ $bh->title }}</td>
                                        <td class="text-sm">{{ $bh->status }}</td>
                                        <td class="text-sm">{{ $bh->description }}</td>
                                        <td class="text-sm">{{ $bh->booking_no }}</td>
                                        <td class="text-sm">{{ $bh->invoice_no }}</td>
                                        
                                      
                                        {{-- <td>
                                            <label for="my-modal-6" class="btn btn-sm btn-primary text text-sm">Update
                                                Status</label>
                                            <input type="checkbox" id="my-modal-6" class="modal-toggle" />
                                            <div class="modal">
                                                <div class="modal-box w-11/12 max-w-xs">
                                                    <label for="my-modal-6"
                                                        class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                                    <form method="POST"
                                                        action="{{ route('bookings.updateStatus', $bs->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div>
                                                            <input type="hidden" id="id" name="id" value="{{$bs->id}}"
                                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                                        </div>
                                                        <label for="booking_status"
                                                            class="block text-sm font-medium text-gray-700">Booking
                                                            Status</label>
                                                        <div class="mt-1">
                                                            <select id="booking_status" name="booking_status"
                                                                class="select select-sm select-bordered">
                                                                <option value="Booking Receive"> Booking Receive </option>
                                                                <option value="Pickup Car"> Pickup Car</option>
                                                                <option value="Cancel"> Cancel</option>
                                                                <option value="Payment Success">Payment Success</option>

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
                                        </td> --}}

                                    </tr>
                                    @empty
                                    <tr>
                                        <td> Sorry There Are No Data For Now  </td>
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