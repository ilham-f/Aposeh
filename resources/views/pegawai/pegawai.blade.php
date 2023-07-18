@extends('layouts.mainpegawai')

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
                    Aktif
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ count($activeMembers) }}
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
                    Non Aktif
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ count($nonActiveMembers) }}
                </p>
            </div>
        </div>
    </div>

    {{-- Tahun chart --}}
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300" style="text-align: center">
            Keaktifan Anda
        </h4>
        <div class="flex justify-between p-4 text-white">
            <div>
                <label for="year">Pilih Tahun :</label>
                <select name="year" id="year" style="background-color: transparent">
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div id="total"></div>
        </div>
        <div style="position: relative; height: 400px; width: 800px;">
            <canvas id="chart1" style="margin-left: 50px"></canvas>
            <div id="legend" style="position: absolute; left: -80px; top: 0;"></div>
        </div>
    </div>

    {{-- CHART KEAKTIFAN --}}
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 mt-4">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
            Keaktifan Anda
        </h4>
        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
            <!-- Chart legend -->
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                <span>Organic</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                <span>Paid</span>
            </div>
        </div>
    </div>

    {{-- CHART RESPON TIME --}}
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 mt-4 mb-4">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
            Respon Time
        </h4>
        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
            <!-- Chart legend -->
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                <span>Organic</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                <span>Paid</span>
            </div>
        </div>
    </div>

    <script>
        var usernames = @json($usernames);
        var chartData = @json($chartData);
        var labels = @json($labels);

        // console.log(labels);
        function updateChart(selectedYear) {
            var ctx = document.getElementById('chart1').getContext('2d');
            var datasets = [];
            var total = 0;

            var data = chartData[selectedYear] ? chartData[selectedYear] : [];
            var dataset = {
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            };

            datasets.push(dataset);
            total += data.reduce((a, b) => a + b, 0);

            // Sort datasets by year in descending order
            datasets.sort(function(a, b) {
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
        yearSelect.addEventListener('change', function() {
            var selectedYear = yearSelect.value;
            updateChart(selectedYear);
        });

        // Set default chart based on initial selected year
        var initialYear = yearSelect.value;
        updateChart(initialYear);
    </script>
@endsection
