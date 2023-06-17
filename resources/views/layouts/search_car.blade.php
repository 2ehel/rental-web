<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('search') }}" method="GET">
            <div class="flex justify-end px-5">
                <div class="form-control">
                    <input type="datetime-local" name="start_date" class="input input-bordered" />
                </div>

                <div class="form-control">
                    <div class="input-group">
                        <select class="select select-bordered">
                            <option disabled selected>Pick category</option>
                            <option>T-shirts</option>
                            <option>Mugs</option>
                        </select>
                        <button class="btn btn-square">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($car_list as $car)
                    <div class="card w-96 bg-base-100 shadow-xl">
                        <figure>
                            @isset($car->image)
                                <img src="{{ Storage::url($car->image) }}" width="300" height="300">
                            @endisset
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ $car->brand . ' ' . $car->model . ' (' . $car->year_register . ')' }}</h2>
                            <p>Charge Per Hour : {{ $car->charge_per_hour }}</p>
                            <p>Charge Per day : {{ $car->charge_per_day }}</p>
                            {{-- <p>{{ $car->description }}</p> --}}
                            @if ($car->description != null)
                                @php
                                    $descriptions = json_decode($car->description);
                                @endphp
                                @forelse ($descriptions as $desc => $d)
                                    @if ($d == 'Auto')
                                        <svg data-v-51eda008="" xmlns="http://www.w3.org/2000/svg" width="30"
                                            height="35" viewBox="0 0 42.258 41.036">
                                            <g data-v-51eda008="" id="Group_589" data-name="Group 589"
                                                transform="translate(-1100.017 -504.845)">
                                                <path data-v-51eda008="" id="Path_291" data-name="Path 291"
                                                    d="M340.061,691.205v13.017a4.1,4.1,0,0,1-4.1,4.1H306.32a4.1,4.1,0,0,1-4.1-4.1V686.536a4.1,4.1,0,0,1,4.1-4.1h29.638a4.1,4.1,0,0,1,4.1,4.1"
                                                    transform="translate(798.3 -162.945)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_292" data-name="Path 292"
                                                    d="M340.061,691.205v13.017a4.1,4.1,0,0,1-4.1,4.1H306.32a4.1,4.1,0,0,1-4.1-4.1V686.536a4.1,4.1,0,0,1,4.1-4.1h29.638a4.1,4.1,0,0,1,4.1,4.1"
                                                    transform="translate(798.3 -162.945)" fill="none"
                                                    stroke="#0092ff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1"></path>
                                                <path data-v-51eda008="" id="Path_293" data-name="Path 293"
                                                    d="M307.339,688.685l.023,13.633a2.253,2.253,0,0,0,4.506,0v-5.244h6.387v5.244a2.253,2.253,0,0,0,4.506,0v-5.322h6.3v-4.419h-6.312v-3.886a2.269,2.269,0,1,0-4.538,0v3.807h-6.352v-3.813a2.262,2.262,0,1,0-4.524,0Z"
                                                    transform="translate(799.018 -162.387)" fill="#03d8ff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_294" data-name="Path 294"
                                                    d="M307.339,688.685l.023,13.633a2.253,2.253,0,0,0,4.506,0v-5.244h6.387v5.244a2.253,2.253,0,0,0,4.506,0v-5.322h6.3v-4.419h-6.312v-3.886a2.269,2.269,0,1,0-4.538,0v3.807h-6.352v-3.813a2.262,2.262,0,1,0-4.524,0Z"
                                                    transform="translate(799.018 -162.387)" fill="#fff"
                                                    stroke="#0092ff" stroke-width="1" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_295" data-name="Path 295"
                                                    d="M328.667,704.567a2.274,2.274,0,0,1-2.273-2.274v-13.6a2.273,2.273,0,0,1,4.546,0v13.6A2.274,2.274,0,0,1,328.667,704.567Z"
                                                    transform="translate(801.689 -162.386)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_296" data-name="Path 296"
                                                    d="M328.667,704.567h0a2.274,2.274,0,0,1-2.273-2.274v-13.6a2.273,2.273,0,0,1,4.546,0v13.6A2.274,2.274,0,0,1,328.667,704.567Z"
                                                    transform="translate(801.689 -162.386)" fill="none"
                                                    stroke="#0092ff" stroke-width="1" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_297" data-name="Path 297"
                                                    d="M326.953,698.045h-4.546V680.853a2.273,2.273,0,1,1,4.546,0Z"
                                                    transform="translate(801.13 -163.485)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_298" data-name="Path 298"
                                                    d="M326.953,698.045h-4.546V680.853a2.273,2.273,0,1,1,4.546,0Z"
                                                    transform="translate(801.13 -163.485)" fill="none"
                                                    stroke="#0092ff" stroke-width="1" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_299" data-name="Path 299"
                                                    d="M329.882,677.319A4.882,4.882,0,1,1,325,672.438,4.882,4.882,0,0,1,329.882,677.319Z"
                                                    transform="translate(800.809 -164.346)" fill="#fff"
                                                    stroke="#0092ff" stroke-width="1" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_300" data-name="Path 300"
                                                    d="M338.4,693.072v3.257" transform="translate(803.372 -161.454)"
                                                    fill="none" stroke="#0092ff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1"></path>
                                                <path data-v-51eda008="" id="Path_301" data-name="Path 301"
                                                    d="M318.086,672.906a4.914,4.914,0,0,1,3.1-2.784Z"
                                                    transform="translate(800.524 -164.671)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_302" data-name="Path 302"
                                                    d="M318.086,672.906a4.914,4.914,0,0,1,3.1-2.784"
                                                    transform="translate(800.524 -164.671)" fill="none"
                                                    stroke="#28323c" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1"></path>
                                                <path data-v-51eda008="" id="Path_303" data-name="Path 303"
                                                    d="M318.086,672.906a4.914,4.914,0,0,1,3.1-2.784Z"
                                                    transform="translate(800.524 -164.671)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_304" data-name="Path 304"
                                                    d="M318.086,672.906a4.914,4.914,0,0,1,3.1-2.784"
                                                    transform="translate(800.524 -164.671)" fill="none"
                                                    stroke="#0092ff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1"></path>
                                            </g>
                                        </svg>
                                        <span>Auto</span>
                                    @elseif ($d == 'Manual')
                                        <span>Manual</span>
                                    @elseif ($d == '5_seat')
                                        <svg data-v-51eda008="" xmlns="http://www.w3.org/2000/svg" width="30"
                                            height="35" viewBox="0 0 30.547 37.539">
                                            <g data-v-51eda008="" id="Group_588" data-name="Group 588"
                                                transform="translate(-1007.609 -508.902)">
                                                <path data-v-51eda008="" id="Path_283" data-name="Path 283"
                                                    d="M231.73,673.853a4.845,4.845,0,1,1-2.769,2.455"
                                                    transform="translate(789.898 -164.185)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_284" data-name="Path 284"
                                                    d="M231.73,673.853a4.845,4.845,0,1,1-2.769,2.455"
                                                    transform="translate(789.898 -164.185)" fill="none"
                                                    stroke="#0092ff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1"></path>
                                                <path data-v-51eda008="" id="Path_285" data-name="Path 285"
                                                    stroke="#0092ff"
                                                    d="M233.836,684.5a10.786,10.786,0,0,1,10.787,10.786V708.6H223.05V695.289A10.784,10.784,0,0,1,233.836,684.5Z"
                                                    fill="none" transform="translate(789.139 -162.655)"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_286" data-name="Path 286"
                                                    d="M219.961,703.476a1.783,1.783,0,0,1,.317-2.5l10.914-8.462,2.353-1.825,1.815-1.406L244,682.458a1.783,1.783,0,1,1,2.186,2.819l-23.72,18.516A1.785,1.785,0,0,1,219.961,703.476Z"
                                                    transform="translate(788.653 -162.994)" fill="#fff"
                                                    stroke="#0092ff" stroke-width="1" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_287" data-name="Path 287"
                                                    d="M221.131,702.9a26.843,26.843,0,0,1,25.043.018,1.542,1.542,0,0,1,.608,2.074,1.375,1.375,0,0,1-1.832.613,25.254,25.254,0,0,0-22.567.051,1.36,1.36,0,0,1-1.782-.585l-.04-.068A1.523,1.523,0,0,1,221.131,702.9Z"
                                                    transform="translate(788.761 -160.514)" fill="#fff"
                                                    stroke="#0092ff" stroke-width="1.027" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_288" data-name="Path 288"
                                                    d="M221.173,688.917s1.129-3.8,4.207-5.236Z"
                                                    transform="translate(788.876 -162.77)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_289" data-name="Path 289"
                                                    d="M221.173,688.917s1.129-3.8,4.207-5.236"
                                                    transform="translate(788.876 -162.77)" fill="none"
                                                    stroke="#0092ff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1"></path>
                                                <g data-v-51eda008="" id="Group_231" data-name="Group 231"
                                                    transform="translate(1037.656 533.238)">
                                                    <path data-v-51eda008="" id="Path_290" data-name="Path 290"
                                                        d="M245.386,694.493v3.58"
                                                        transform="translate(-245.386 -694.493)" fill="none"
                                                        stroke="#0092ff" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <span>5 seats</span>
                                    @elseif ($d == '7_seat')
                                        <svg data-v-51eda008="" xmlns="http://www.w3.org/2000/svg" width="30"
                                            height="35" viewBox="0 0 30.547 37.539">
                                            <g data-v-51eda008="" id="Group_588" data-name="Group 588"
                                                transform="translate(-1007.609 -508.902)">
                                                <path data-v-51eda008="" id="Path_283" data-name="Path 283"
                                                    d="M231.73,673.853a4.845,4.845,0,1,1-2.769,2.455"
                                                    transform="translate(789.898 -164.185)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_284" data-name="Path 284"
                                                    d="M231.73,673.853a4.845,4.845,0,1,1-2.769,2.455"
                                                    transform="translate(789.898 -164.185)" fill="none"
                                                    stroke="#0092ff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1"></path>
                                                <path data-v-51eda008="" id="Path_285" data-name="Path 285"
                                                    stroke="#0092ff"
                                                    d="M233.836,684.5a10.786,10.786,0,0,1,10.787,10.786V708.6H223.05V695.289A10.784,10.784,0,0,1,233.836,684.5Z"
                                                    fill="none" transform="translate(789.139 -162.655)"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_286" data-name="Path 286"
                                                    d="M219.961,703.476a1.783,1.783,0,0,1,.317-2.5l10.914-8.462,2.353-1.825,1.815-1.406L244,682.458a1.783,1.783,0,1,1,2.186,2.819l-23.72,18.516A1.785,1.785,0,0,1,219.961,703.476Z"
                                                    transform="translate(788.653 -162.994)" fill="#fff"
                                                    stroke="#0092ff" stroke-width="1" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_287" data-name="Path 287"
                                                    d="M221.131,702.9a26.843,26.843,0,0,1,25.043.018,1.542,1.542,0,0,1,.608,2.074,1.375,1.375,0,0,1-1.832.613,25.254,25.254,0,0,0-22.567.051,1.36,1.36,0,0,1-1.782-.585l-.04-.068A1.523,1.523,0,0,1,221.131,702.9Z"
                                                    transform="translate(788.761 -160.514)" fill="#fff"
                                                    stroke="#0092ff" stroke-width="1.027" fill-rule="evenodd"></path>
                                                <path data-v-51eda008="" id="Path_288" data-name="Path 288"
                                                    d="M221.173,688.917s1.129-3.8,4.207-5.236Z"
                                                    transform="translate(788.876 -162.77)" fill="#fff"
                                                    fill-rule="evenodd">
                                                </path>
                                                <path data-v-51eda008="" id="Path_289" data-name="Path 289"
                                                    d="M221.173,688.917s1.129-3.8,4.207-5.236"
                                                    transform="translate(788.876 -162.77)" fill="none"
                                                    stroke="#0092ff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1"></path>
                                                <g data-v-51eda008="" id="Group_231" data-name="Group 231"
                                                    transform="translate(1037.656 533.238)">
                                                    <path data-v-51eda008="" id="Path_290" data-name="Path 290"
                                                        d="M245.386,694.493v3.58"
                                                        transform="translate(-245.386 -694.493)" fill="none"
                                                        stroke="#0092ff" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <span>7 seats</span>
                                    @endif
                                @empty
                                @endforelse
                            @endif

                            <div class="card-actions justify-end">
                                <button class="btn btn-primary">Buy Now</button>
                            </div>
                        </div>

                    </div>
                @empty
                    <h5>No car available!</h5>
                @endforelse
            </div>
        </div>


    </div>

    {{-- @isset($availableCars)
            <div class="p-2">
                @include('layouts.car_listing')
            </div>
            @endisset --}}
    {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-dashboard />
            </div> --}}
</x-app-layout>
