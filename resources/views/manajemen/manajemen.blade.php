@extends('layouts.main')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard Monitoring
    </h2>
    <!-- CTA -->
    <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
        {{-- href="https://github.com/estevanmaito/windmill-dashboard" --}}>
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
            <span>Jumlah Member</span>
        </div>
        {{-- <span>View more &RightArrow;</span> --}}
    </a>
    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    By Month Year
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    405
                </p>
            </div>
        </div>



        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    By Year
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    6389
                </p>
            </div>
        </div>
    </div>

    {{-- Tahun chart --}}
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300" style="text-align: center">
            Jumlah Pasien
        </h4>
        <div>
            <label for="year">Pilih Tahun :</label>
            <select name="year" id="year">
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div style="position: relative; height: 400px; width: 800px;">
            <canvas id="chart1" style="margin-left: 50px"></canvas>
            <div id="legend" style="position: absolute; left: -80px; top: 0;"></div>
            <div id="total" style="position: absolute; right: 10px; top: 10px;"></div>
        </div>
    </div>

    <script>
        var chartData = @json($chartData);
        var usernames = @json($usernames);
        var labels = @json($labels);

        function updateChart(selectedYear) {
            var ctx = document.getElementById('chart1').getContext('2d');
            var datasets = [];
            var total = 0;
            usernames.forEach(function (username, index) {
                var data = chartData[username][selectedYear] ? chartData[username][selectedYear] : [];
                var dataset = {
                    label: username,
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                };
                datasets.push(dataset);
                total += data.reduce((a, b) => a + b, 0);
            });

            // Sort datasets by year in descending order
            datasets.sort(function (a, b) {
                var yearA = parseInt(a.label);
                var yearB = parseInt(b.label);
                return yearB - yearA;
            });

            // Reverse the sorted datasets to display in descending order
            datasets.reverse();

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            document.getElementById('total').innerText = 'Total: ' + total;
        }

        var yearSelect = document.getElementById('year');
        yearSelect.addEventListener('change', function () {
            var selectedYear = yearSelect.value;
            updateChart(selectedYear);
        });

        // Set default chart based on initial selected year
        var initialYear = yearSelect.value;
        updateChart(initialYear);
    </script>




    <!-- New Table -->
    <div iv class="w-full overflow-hidden rounded-lg shadow-xs" style="margin-top: 40px">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Pegawai</th>
                        <th class="px-4 py-3">Response Time</th>
                        <th class="px-4 py-3">Keaktifan Pegawai</th>
                        <th class="px-4 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div>
                                <p class="font-semibold">Hans Burger</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    10x Developer
                                </p>
                            </div>
        </div>
        </td>
        <td class="px-4 py-3 text-sm">
            $ 863.45
        </td>
        <td class="px-4 py-3 text-xs">
            <span
                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                Approved
            </span>
        </td>
        <td class="px-4 py-3 text-sm">
            6/10/2020
        </td>
        </tr>

        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                    <!-- Avatar with inset shadow -->
                    {{-- <div
              class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
              <img
                class="object-cover w-full h-full rounded-full"
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&facepad=3&fit=facearea&s=707b9c33066bf8808c934c8ab394dff6"
                alt=""
                loading="lazy"
              />
              <div
                class="absolute inset-0 rounded-full shadow-inner"
                aria-hidden="true"
              ></div>
            </div> --}}
                    <div>
                        <p class="font-semibold">Jolina Angelie</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            Unemployed
                        </p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 text-sm">
                $ 369.95
            </td>
            <td class="px-4 py-3 text-xs">
                <span
                    class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                    Pending
                </span>
            </td>
            <td class="px-4 py-3 text-sm">
                6/10/2020
            </td>
        </tr>

        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                    <!-- Avatar with inset shadow -->
                    {{-- <div
              class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
              <img
                class="object-cover w-full h-full rounded-full"
                src="https://images.unsplash.com/photo-1551069613-1904dbdcda11?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                alt=""
                loading="lazy"
              />
              <div
                class="absolute inset-0 rounded-full shadow-inner"
                aria-hidden="true"
              ></div>
            </div> --}}
                    <div>
                        <p class="font-semibold">Sarah Curry</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            Designer
                        </p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 text-sm">
                $ 86.00
            </td>
            <td class="px-4 py-3 text-xs">
                <span
                    class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                    Denied
                </span>
            </td>
            <td class="px-4 py-3 text-sm">
                6/10/2020
            </td>
        </tr>

        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                    <!-- Avatar with inset shadow -->
                    {{-- <div
              class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
            >
              <img
                class="object-cover w-full h-full rounded-full"
                src="https://images.unsplash.com/photo-1551006917-3b4c078c47c9?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                alt=""
                loading="lazy"
              />
              <div
                class="absolute inset-0 rounded-full shadow-inner"
                aria-hidden="true"
              ></div>
            </div> --}}
                    <div>
                        <p class="font-semibold">Rulia Joberts</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            Actress
                        </p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 text-sm">
                $ 1276.45
            </td>
            <td class="px-4 py-3 text-xs">
                <span
                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Approved
                </span>
            </td>
            <td class="px-4 py-3 text-sm">
                6/10/2020
            </td>
        </tr>

        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                    <!-- Avatar with inset shadow -->
                    {{-- <div
              class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
            >
              <img
                class="object-cover w-full h-full rounded-full"
                src="https://images.unsplash.com/photo-1546456073-6712f79251bb?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                alt=""
                loading="lazy"
              />
              <div
                class="absolute inset-0 rounded-full shadow-inner"
                aria-hidden="true"
              ></div>
            </div> --}}
                    <div>
                        <p class="font-semibold">Wenzel Dashington</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            Actor
                        </p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 text-sm">
                $ 863.45
            </td>
            <td class="px-4 py-3 text-xs">
                <span
                    class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                    Expired
                </span>
            </td>
            <td class="px-4 py-3 text-sm">
                6/10/2020
            </td>
        </tr>

        </tbody>
        </table>
    </div>
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">
            Showing 21-30 of 100
        </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    <li>
                        <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="Previous">
                            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>
                    <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                            1
                        </button>
                    </li>
                    <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                            2
                        </button>
                    </li>
                    <li>
                        <button
                            class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                            3
                        </button>
                    </li>
                    <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                            4
                        </button>
                    </li>
                    <li>
                        <span class="px-3 py-1">...</span>
                    </li>
                    <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                            8
                        </button>
                    </li>
                    <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                            9
                        </button>
                    </li>
                    <li>
                        <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="Next">
                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>
                </ul>
            </nav>
        </span>
    </div>
    </div>

    <!-- Charts -->
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Charts
    </h2>
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Revenue
            </h4>
            <canvas id="pie"></canvas>
            <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                    <span>Shirts</span>
                </div>
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                    <span>Shoes</span>
                </div>
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                    <span>Bags</span>
                </div>
            </div>
        </div>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Traffic
            </h4>
            <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <div id="grafik"></div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">

    var pasien = 2;
    var bulan = 1;
    Highcharts.chart('grafik', {
        title : {
            text: 'Grafik Pasien setiap Bulan'
        },
        xAxis : {
            categories : bulan
        },
        yAxis : {
            title : {
                text : 'Jumlah pasien Bulanan'
            }
        },
        plotOptions: {
            series: {
                allowPointSelect:true
            }
        },
        series: [
            {
                name: 'Jumlah Pasien',
                data: pasien
            }
        ]

    });
    </script>

@endsection

