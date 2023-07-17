@extends('layouts.main')

@section('content')
    @if (session()->has('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                alert('{{ $error }}')
            </script>
        @endforeach
    @endif
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Keaktifan Pegawai
    </h2>


    <!-- Cards -->
    <div class="grid gap-6 mb-8 grid-cols-2 ">
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
                    {{ $memberThisMonth }}
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
                    {{ $memberThisYear }}
                </p>
            </div>
        </div>
    </div>

    <div id="chart" style=""></div>

    <!-- New Table -->



    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript">

     $.get("/keaktifan-bulanan",{id:'{{ $id }}'},
        function (data, textStatus, jqXHR) {
            var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Member',
                data: data.dataBulanan
            }],
            xaxis: {
                categories: data.month
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
        },
        
     );
      
    </script>
@endsection
