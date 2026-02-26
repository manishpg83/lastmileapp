<div class="container-xxl flex-grow-1 container-p-y font-sans">

    <!-- Top Header & Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h4 class="text-2xl font-bold text-gray-800 mb-1">Dashboard Overview</h4>
            <p class="text-sm text-gray-500">Welcome back! Here's what's happening today.</p>
        </div>
        <div class="w-full md:w-64">
            <select wire:model.live="dateFilter"
                class="form-select w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="this_week">This Week</option>
                <option value="this_month">This Month</option>
                <option value="all">All Time</option>
            </select>
        </div>
    </div>

    <!-- Global Stats Row (Drivers, Customers, Distance, Time) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="rounded-full bg-blue-50 p-3 mr-4 flex items-center justify-center h-12 w-12">
                <i class="bx bx-user text-2xl text-blue-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Drivers</p>
                <h4 class="text-xl font-bold text-gray-900">{{ $totalDrivers }}</h4>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="rounded-full bg-indigo-50 p-3 mr-4 flex items-center justify-center h-12 w-12">
                <i class="bx bx-group text-2xl text-indigo-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Customers</p>
                <h4 class="text-xl font-bold text-gray-900">{{ $totalCustomers }}</h4>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="rounded-full bg-emerald-50 p-3 mr-4 flex items-center justify-center h-12 w-12">
                <i class="bx bx-map-alt text-2xl text-emerald-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Overall KM</p>
                <h4 class="text-xl font-bold text-gray-900">{{ number_format($totalKm, 2) }}</h4>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="rounded-full bg-purple-50 p-3 mr-4 flex items-center justify-center h-12 w-12">
                <i class="bx bx-time text-2xl text-purple-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Overall Hours</p>
                <h4 class="text-xl font-bold text-gray-900">{{ number_format($totalHours, 2) }}</h4>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <!-- Left Column: Delivery Status (Takes up 2/3 on large screens) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Delivery Status Cards -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 shadow-lg">
                <h5 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="bx bx-package mr-2 text-indigo-500 text-xl font-bold"></i> Delivery
                    Status
                </h5>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    <div
                        class="p-4 rounded-xl bg-gray-50 border border-gray-100 hover:bg-indigo-50 transition-colors duration-200">
                        <p class="text-sm font-semibold text-gray-500 mb-1">Total Dockets</p>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-3xl font-black text-indigo-700">{{ $totalDockets }}</h3>
                        </div>
                    </div>

                    <div
                        class="p-4 rounded-xl bg-gray-50 border border-gray-100 hover:bg-green-50 transition-colors duration-200">
                        <p class="text-sm font-semibold text-gray-500 mb-1">Delivered</p>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-3xl font-black text-green-600">{{ $delivered }}</h3>
                        </div>
                    </div>

                    <div
                        class="p-4 rounded-xl bg-gray-50 border border-gray-100 hover:bg-red-50 transition-colors duration-200">
                        <p class="text-sm font-semibold text-gray-500 mb-1">Undelivered</p>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-3xl font-black text-red-600">{{ $undelivered }}</h3>
                        </div>
                    </div>

                    <div
                        class="p-4 rounded-xl bg-gray-50 border border-gray-100 hover:bg-amber-50 transition-colors duration-200">
                        <p class="text-sm font-semibold text-gray-500 mb-1">In Progress</p>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-3xl font-black text-amber-500">{{ $inProgress }}</h3>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Performance Graph -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="bx bx-trending-up mr-2 text-indigo-500 text-xl font-bold"></i>
                        Performance (15 Days)
                    </h5>
                </div>
                <!-- Needs a wrapper with a fixed height or min-height for ApexCharts -->
                <div class="relative w-full overflow-hidden rounded-lg">
                    <div id="deliveryChart" class="w-full min-h-[350px]"></div>
                </div>
            </div>

        </div>

        <!-- Right Column: Averages (Takes up 1/3 on large screens) -->
        <div class="lg:col-span-1 space-y-6">

            <div
                class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden group">
                <!-- Decorative background elements -->
                <div
                    class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10 transition-transform duration-500 group-hover:scale-110">
                </div>
                <div
                    class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-white opacity-10 transition-transform duration-500 group-hover:scale-110">
                </div>

                <h5
                    class="text-lg font-bold mb-6 flex items-center relative z-10 text-white border-b border-indigo-400 pb-3">
                    <i class="bx bx-bar-chart-alt-2 mr-2 text-white text-xl font-bold"></i>
                    Performance Averages
                </h5>

                <div class="space-y-6 relative z-10">
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-indigo-100 font-medium text-sm uppercase tracking-wider">Average Distance</p>
                            <div class="bg-white/20 rounded-full p-2 flex items-center justify-center h-8 w-8">
                                <i class="bx bx-car text-white"></i>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <h3 class="text-4xl font-bold tracking-tight m-0 text-white">{{ number_format($avgKm, 2) }}
                            </h3>
                            <span class="text-indigo-200 mb-1 font-medium">KM / Driver</span>
                        </div>
                    </div>

                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-indigo-100 font-medium text-sm uppercase tracking-wider">Average Duration</p>
                            <div class="bg-white/20 rounded-full p-2 flex items-center justify-center h-8 w-8">
                                <i class="bx bx-stopwatch text-white"></i>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <h3 class="text-4xl font-bold tracking-tight m-0 text-white">
                                {{ number_format($avgHours, 2) }}</h3>
                            <span class="text-indigo-200 mb-1 font-medium">Hrs / Driver</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                const chartOptions = {
                    series: [{
                        name: 'Total Dockets',
                        data: @json($chartData['deliveries'])
                    }, {
                        name: 'Delivered',
                        data: @json($chartData['delivered'])
                    }, {
                        name: 'Undelivered',
                        data: @json($chartData['undelivered'])
                    }],
                    chart: {
                        type: 'area',
                        height: 350,
                        fontFamily: 'inherit',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        }
                    },
                    colors: ['#4f46e5', '#10b981', '#ef4444'], // Tailwind indigo-600, emerald-500, red-500
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.4,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    xaxis: {
                        categories: @json($chartData['labels']),
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: '#6b7280' // gray-500
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val.toFixed(0);
                            },
                            style: {
                                colors: '#6b7280' // gray-500
                            }
                        }
                    },
                    grid: {
                        borderColor: '#e5e7eb', // gray-200
                        strokeDashArray: 4,
                        padding: {
                            top: -20,
                            bottom: -10,
                            left: 0
                        }
                    },
                    tooltip: {
                        theme: 'light',
                        x: {
                            show: true
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        labels: {
                            colors: '#374151' // gray-700
                        }
                    }
                };

                const chart = new ApexCharts(document.querySelector("#deliveryChart"), chartOptions);
                chart.render();
            });
        </script>
    @endpush
</div>
