<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Top Header & Filter -->
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-1" style="color:#343a40;">Dashboard Overview</h4>
            <p class="text-muted mb-0" style="font-size:0.875rem;">Welcome back! Here's what's happening today.</p>
        </div>
        <div style="min-width:200px;">
            <select wire:model.live="dateFilter" class="form-select">
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="this_week">This Week</option>
                <option value="this_month">This Month</option>
                <option value="all">All Time</option>
            </select>
        </div>
    </div>

    <!-- Global Stats Row -->
    <div class="row g-4 mb-4">

        <!-- Total Drivers -->
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                        style="width:48px;height:48px;background-color:#fff7ed;">
                        <i class="bx bx-user fs-4 icon-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1" style="font-size:0.8rem;font-weight:500;">Total Drivers</p>
                        <h4 class="fw-bold mb-0" style="color:#111827;">{{ $totalDrivers }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                        style="width:48px;height:48px;background-color:#fff7ed;">
                        <i class="bx bx-group fs-4 icon-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1" style="font-size:0.8rem;font-weight:500;">Total Customers</p>
                        <h4 class="fw-bold mb-0" style="color:#111827;">{{ $totalCustomers }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall KM -->
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                        style="width:48px;height:48px;background-color:#fff7ed;">
                        <i class="bx bx-map-alt fs-4 icon-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1" style="font-size:0.8rem;font-weight:500;">Overall KM</p>
                        <h4 class="fw-bold mb-0" style="color:#111827;">{{ number_format($totalKm, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Hours -->
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                        style="width:48px;height:48px;background-color:#fff7ed;">
                        <i class="bx bx-time fs-4 icon-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1" style="font-size:0.8rem;font-weight:500;">Overall Hours</p>
                        <h4 class="fw-bold mb-0" style="color:#111827;">{{ number_format($totalHours, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Content Grid -->
    <div class="row g-4 mb-4">

        <!-- Left Column: Delivery Status + Chart -->
        <div class="col-lg-8">
            <div class="d-flex flex-column gap-4">

                <!-- Delivery Status Cards -->
                <div class="card border-0 shadow-sm" style="border-radius:16px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4 d-flex align-items-center" style="color:#1f2937;">
                            <i class="bx bx-package me-2 fs-5 icon-primary"></i> Delivery Status
                        </h5>
                        <div class="row g-3">

                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 h-100 dashboard-stat-card"
                                    style="background-color:#f9fafb;border:1px solid #f3f4f6;"
                                    data-hover-color="#eef2ff">
                                    <p class="fw-semibold text-muted mb-2" style="font-size:0.8rem;">Total Dockets</p>
                                    <h3 class="fw-black mb-0 icon-primary" style="font-size:2rem;">{{ $totalDockets }}
                                    </h3>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 h-100 dashboard-stat-card"
                                    style="background-color:#f9fafb;border:1px solid #f3f4f6;"
                                    data-hover-color="#f0fdf4">
                                    <p class="fw-semibold text-muted mb-2" style="font-size:0.8rem;">Delivered</p>
                                    <h3 class="fw-black mb-0" style="font-size:2rem;color:#16a34a;">{{ $delivered }}
                                    </h3>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 h-100 dashboard-stat-card"
                                    style="background-color:#f9fafb;border:1px solid #f3f4f6;"
                                    data-hover-color="#fef2f2">
                                    <p class="fw-semibold text-muted mb-2" style="font-size:0.8rem;">Undelivered</p>
                                    <h3 class="fw-black mb-0" style="font-size:2rem;color:#dc2626;">{{ $undelivered }}
                                    </h3>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 h-100 dashboard-stat-card"
                                    style="background-color:#f9fafb;border:1px solid #f3f4f6;"
                                    data-hover-color="#fffbeb">
                                    <p class="fw-semibold text-muted mb-2" style="font-size:0.8rem;">In Progress</p>
                                    <h3 class="fw-black mb-0" style="font-size:2rem;color:#d97706;">{{ $inProgress }}
                                    </h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Performance Graph -->
                <div class="card border-0 shadow-sm" style="border-radius:16px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 d-flex align-items-center" style="color:#1f2937;">
                            <i class="bx bx-trending-up me-2 fs-5 icon-primary"></i> Performance (15 Days)
                        </h5>
                        <div id="deliveryChart" style="min-height:350px;width:100%;"></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Column: Performance Averages -->
        <div class="col-lg-4">
            <div class="card border-0 shadow h-100 position-relative overflow-hidden"
                style="border-radius:16px;background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);">

                <!-- Decorative circles -->
                <div class="position-absolute rounded-circle"
                    style="width:128px;height:128px;background:rgba(255,255,255,0.1);top:-32px;right:-32px;pointer-events:none;">
                </div>
                <div class="position-absolute rounded-circle"
                    style="width:96px;height:96px;background:rgba(255,255,255,0.1);bottom:-32px;left:-32px;pointer-events:none;">
                </div>

                <div class="card-body p-4 position-relative" style="z-index:1;">
                    <h5 class="fw-bold mb-4 d-flex align-items-center pb-3 text-white"
                        style="border-bottom:1px solid rgba(255,255,255,0.25);font-size:1rem;">
                        <i class="bx bx-bar-chart-alt-2 me-2 text-white"></i> Performance Averages
                    </h5>

                    <!-- Average Distance -->
                    <div class="rounded-3 p-4 mb-3 perf-card"
                        style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="text-uppercase mb-0 fw-medium"
                                style="font-size:0.7rem;color:rgba(199,210,254,1);letter-spacing:0.05em;">Average
                                Distance</p>
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:32px;height:32px;background:rgba(255,255,255,0.2);">
                                <i class="bx bx-car text-white" style="font-size:0.9rem;"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-end gap-2">
                            <h3 class="fw-bold mb-0 text-white" style="font-size:2.25rem;line-height:1;">
                                {{ number_format($avgKm, 2) }}
                            </h3>
                            <span class="mb-1 fw-medium" style="color:rgba(199,210,254,1);font-size:0.875rem;">KM /
                                Driver</span>
                        </div>
                    </div>

                    <!-- Average Duration -->
                    <div class="rounded-3 p-4 perf-card"
                        style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="text-uppercase mb-0 fw-medium"
                                style="font-size:0.7rem;color:rgba(199,210,254,1);letter-spacing:0.05em;">Average
                                Duration</p>
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:32px;height:32px;background:rgba(255,255,255,0.2);">
                                <i class="bx bx-stopwatch text-white" style="font-size:0.9rem;"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-end gap-2">
                            <h3 class="fw-bold mb-0 text-white" style="font-size:2.25rem;line-height:1;">
                                {{ number_format($avgHours, 2) }}
                            </h3>
                            <span class="mb-1 fw-medium" style="color:rgba(199,210,254,1);font-size:0.875rem;">Hrs /
                                Driver</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            // Hover effects for stat cards
            document.querySelectorAll('.dashboard-stat-card').forEach(function (el) {
                var defaultBg = '#f9fafb';
                var hoverBg = el.getAttribute('data-hover-color') || '#f3f4f6';
                el.addEventListener('mouseenter', function () { el.style.backgroundColor = hoverBg; });
                el.addEventListener('mouseleave', function () { el.style.backgroundColor = defaultBg; });
            });

            document.querySelectorAll('.perf-card').forEach(function (el) {
                el.addEventListener('mouseenter', function () { el.style.background = 'rgba(255,255,255,0.2)'; });
                el.addEventListener('mouseleave', function () { el.style.background = 'rgba(255,255,255,0.1)'; });
            });

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
                        toolbar: { show: false },
                        zoom: { enabled: false }
                    },
                    colors: ['#f97316', '#10b981', '#ef4444'],
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 2 },
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
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { style: { colors: '#6b7280' } }
                    },
                    yaxis: {
                        labels: {
                            formatter: function (val) { return val.toFixed(0); },
                            style: { colors: '#6b7280' }
                        }
                    },
                    grid: {
                        borderColor: '#e5e7eb',
                        strokeDashArray: 4,
                        padding: { top: -20, bottom: -10, left: 0 }
                    },
                    tooltip: { theme: 'light', x: { show: true } },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        labels: { colors: '#374151' }
                    }
                };

                const chart = new ApexCharts(document.querySelector("#deliveryChart"), chartOptions);
                chart.render();
            });
        </script>
    @endpush

</div>