<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="icon-base bx bxs-truck icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">42</h4>
                    </div>
                    <p class="mb-2">On route vehicles</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+18.2%</span>
                        <span class="text-body-secondary">than last week</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="icon-base bx bx-error icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">8</h4>
                    </div>
                    <p class="mb-2">Vehicles with errors</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">-8.7%</span>
                        <span class="text-body-secondary">than last week</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-danger"><i
                                    class="icon-base bx bx-git-repo-forked icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">27</h4>
                    </div>
                    <p class="mb-2">Deviated from route</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+4.3%</span>
                        <span class="text-body-secondary">than last week</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-info"><i
                                    class="icon-base bx bx-time-five icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">13</h4>
                    </div>
                    <p class="mb-2">Late vehicles</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">-2.5%</span>
                        <span class="text-body-secondary">than last week</span>
                    </p>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->
        <!-- Vehicles overview -->
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Vehicles Overview</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="vehiclesOverview" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base bx bx-dots-vertical-rounded icon-lg text-body-secondary"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="vehiclesOverview">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-none d-lg-flex vehicles-progress-labels mb-6">
                        <div class="vehicles-progress-label on-the-way-text" style="width: 39.7%;">On the way</div>
                        <div class="vehicles-progress-label unloading-text" style="width: 28.3%;">Unloading</div>
                        <div class="vehicles-progress-label loading-text" style="width: 17.4%;">Loading</div>
                        <div class="vehicles-progress-label waiting-text text-nowrap" style="width: 14.6%;">Waiting
                        </div>
                    </div>
                    <div class="vehicles-overview-progress progress rounded-3 mb-6 bg-transparent overflow-hidden"
                        style="height: 46px;">
                        <div class="progress-bar fw-medium text-start shadow-none bg-lighter text-heading px-4 rounded-0"
                            role="progressbar" style="width: 39.7%" aria-valuenow="39.7" aria-valuemin="0"
                            aria-valuemax="100">39.7%</div>
                        <div class="progress-bar fw-medium text-start shadow-none bg-primary px-4" role="progressbar"
                            style="width: 28.3%" aria-valuenow="28.3" aria-valuemin="0" aria-valuemax="100">28.3%</div>
                        <div class="progress-bar fw-medium text-start shadow-none text-bg-info px-2 px-sm-4"
                            role="progressbar" style="width: 17.4%" aria-valuenow="17.4" aria-valuemin="0"
                            aria-valuemax="100">17.4%</div>
                        <div class="progress-bar fw-medium text-start shadow-none snackbar text-paper px-1 px-sm-3 rounded-0 px-lg-4"
                            role="progressbar" style="width: 14.6%" aria-valuenow="14.6" aria-valuemin="0"
                            aria-valuemax="100">14.6%</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-border-top-0">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class="icon-base bx bx-car icon-lg text-heading"></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">On the way</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">2hr 10min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>39.7%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class="icon-base bx bx-down-arrow-circle icon-lg text-heading"></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Unloading</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">3hr 15min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>28.3%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class="icon-base bx bx-up-arrow-circle icon-lg text-heading"></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Loading</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">1hr 24min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>17.4%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class="icon-base bx bx-time-five icon-lg text-heading"></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Waiting</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">5hr 19min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>14.6%</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Vehicles overview -->

        <!-- Shipment statistics-->
        <div class="col-xxl-6 col-lg-7">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Shipment statistics</h5>
                        <p class="card-subtitle">Total number of deliveries 23.8k</p>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-label-primary">January</button>
                        <button type="button" class="btn btn-label-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);">January</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">February</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">March</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">April</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">May</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">June</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">July</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">August</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">September</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">October</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">November</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">December</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="shipmentStatisticsChart" style="min-height: 320px;" class="">
                        <div id="apexcharts58a1x77w" class="apexcharts-canvas apexcharts58a1x77w apexcharts-theme-"
                            style="width: 548px; height: 320px;"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" class="apexcharts-svg"
                                xmlns:data="ApexChartsNS" transform="translate(0, 0)" width="548" height="320">
                                <foreignObject x="0" y="0" width="548" height="320">
                                    <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom"
                                        xmlns="http://www.w3.org/1999/xhtml"
                                        style="height: 40px; right: 0px; position: absolute; left: 0px; top: 287px;">
                                        <div class="apexcharts-legend-series" rel="1" seriesname="Shipment"
                                            data:collapsed="false" style="margin: 0px 10px;"><span
                                                class="apexcharts-legend-marker" rel="1" data:collapsed="false"
                                                style="height: 8px; width: 8px; left: -3px; top: 0px;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                                                    height="100%">
                                                    <path d="M 0, 0 
           m -4, 0 
           a 4,4 0 1,0 8,0 
           a 4,4 0 1,0 -8,0" fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        cx="0" cy="0" shape="circle"
                                                        class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle"
                                                        style="transform: translate(50%, 50%);"></path>
                                                </svg></span><span class="apexcharts-legend-text" rel="1" i="0"
                                                data:default-text="Shipment" data:collapsed="false"
                                                style="color: var(--bs-heading-color); font-size: 13px; font-weight: 400; font-family: var(--bs-font-family-base);">Shipment</span>
                                        </div>
                                        <div class="apexcharts-legend-series" rel="2" seriesname="Delivery"
                                            data:collapsed="false" style="margin: 0px 10px;"><span
                                                class="apexcharts-legend-marker" rel="2" data:collapsed="false"
                                                style="height: 8px; width: 8px; left: -3px; top: 0px;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                                                    height="100%">
                                                    <path d="M 0, 0 
           m -4, 0 
           a 4,4 0 1,0 8,0 
           a 4,4 0 1,0 -8,0" fill="var(--bs-primary)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        cx="0" cy="0" shape="circle"
                                                        class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle"
                                                        style="transform: translate(50%, 50%);"></path>
                                                </svg></span><span class="apexcharts-legend-text" rel="2" i="1"
                                                data:default-text="Delivery" data:collapsed="false"
                                                style="color: var(--bs-heading-color); font-size: 13px; font-weight: 400; font-family: var(--bs-font-family-base);">Delivery</span>
                                        </div>
                                    </div>
                                    <style type="text/css">
                                        .apexcharts-flip-y {
                                            transform: scaleY(-1) translateY(-100%);
                                            transform-origin: top;
                                            transform-box: fill-box;
                                        }

                                        .apexcharts-flip-x {
                                            transform: scaleX(-1);
                                            transform-origin: center;
                                            transform-box: fill-box;
                                        }

                                        .apexcharts-legend {
                                            display: flex;
                                            overflow: auto;
                                            padding: 0 10px;
                                        }

                                        .apexcharts-legend.apexcharts-legend-group-horizontal {
                                            flex-direction: column;
                                        }

                                        .apexcharts-legend-group {
                                            display: flex;
                                        }

                                        .apexcharts-legend-group-vertical {
                                            flex-direction: column-reverse;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom,
                                        .apexcharts-legend.apx-legend-position-top {
                                            flex-wrap: wrap
                                        }

                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            flex-direction: column;
                                            bottom: 0;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            justify-content: flex-start;
                                            align-items: flex-start;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                            justify-content: center;
                                            align-items: center;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                            justify-content: flex-end;
                                            align-items: flex-end;
                                        }

                                        .apexcharts-legend-series {
                                            cursor: pointer;
                                            line-height: normal;
                                            display: flex;
                                            align-items: center;
                                        }

                                        .apexcharts-legend-text {
                                            position: relative;
                                            font-size: 14px;
                                        }

                                        .apexcharts-legend-text *,
                                        .apexcharts-legend-marker * {
                                            pointer-events: none;
                                        }

                                        .apexcharts-legend-marker {
                                            position: relative;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            cursor: pointer;
                                            margin-right: 1px;
                                        }

                                        .apexcharts-legend-series.apexcharts-no-click {
                                            cursor: auto;
                                        }

                                        .apexcharts-legend .apexcharts-hidden-zero-series,
                                        .apexcharts-legend .apexcharts-hidden-null-series {
                                            display: none !important;
                                        }

                                        .apexcharts-inactive-legend {
                                            opacity: 0.45;
                                        }
                                    </style>
                                </foreignObject>
                                <rect width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0"
                                    stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g>
                                <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g>
                                <g class="apexcharts-yaxis" rel="0" transform="translate(34.442169189453125, 0)">
                                    <g class="apexcharts-yaxis-texts-g"><text x="20" y="34.333333333333336"
                                            text-anchor="end" dominant-baseline="auto" font-size="13px"
                                            font-family="var(--bs-font-family-base)" font-weight="400"
                                            fill="var(--bs-secondary-color)"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: var(--bs-font-family-base);">
                                            <tspan>50%</tspan>
                                            <title>50%</title>
                                        </text><text x="20" y="88.63383333333334" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px"
                                            font-family="var(--bs-font-family-base)" font-weight="400"
                                            fill="var(--bs-secondary-color)"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: var(--bs-font-family-base);">
                                            <tspan>37.5%</tspan>
                                            <title>37.5%</title>
                                        </text><text x="20" y="142.93433333333334" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px"
                                            font-family="var(--bs-font-family-base)" font-weight="400"
                                            fill="var(--bs-secondary-color)"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: var(--bs-font-family-base);">
                                            <tspan>25%</tspan>
                                            <title>25%</title>
                                        </text><text x="20" y="197.23483333333334" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px"
                                            font-family="var(--bs-font-family-base)" font-weight="400"
                                            fill="var(--bs-secondary-color)"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: var(--bs-font-family-base);">
                                            <tspan>12.5%</tspan>
                                            <title>12.5%</title>
                                        </text><text x="20" y="251.53533333333334" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px"
                                            font-family="var(--bs-font-family-base)" font-weight="400"
                                            fill="var(--bs-secondary-color)"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: var(--bs-font-family-base);">
                                            <tspan>0%</tspan>
                                            <title>0%</title>
                                        </text></g>
                                </g>
                                <g class="apexcharts-inner apexcharts-graphical"
                                    transform="translate(79.68638203938802, 30)">
                                    <defs>
                                        <clipPath id="gridRectMask58a1x77w">
                                            <rect width="426.8379597981771" height="217.202" x="0" y="0" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="gridRectBarMask58a1x77w">
                                            <rect width="464.32638549804693" height="224.202" x="-18.744212849934897"
                                                y="-3.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="gridRectMarkerMask58a1x77w">
                                            <rect width="438.8379597981771" height="229.202" x="-6" y="-6" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="forecastMask58a1x77w"></clipPath>
                                        <clipPath id="nonForecastMask58a1x77w"></clipPath>
                                    </defs>
                                    <line x1="0" y1="0" x2="0" y2="217.202" stroke="#b6b6b6" stroke-dasharray="3"
                                        stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1"
                                        height="217.202" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                        stroke-width="1"></line>
                                    <g class="apexcharts-grid">
                                        <g class="apexcharts-gridlines-horizontal">
                                            <line x1="-15.244212849934895" y1="54.3005" x2="442.082172648112"
                                                y2="54.3005" stroke="var(--bs-border-color)" stroke-dasharray="8"
                                                stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line x1="-15.244212849934895" y1="108.601" x2="442.082172648112"
                                                y2="108.601" stroke="var(--bs-border-color)" stroke-dasharray="8"
                                                stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            <line x1="-15.244212849934895" y1="162.9015" x2="442.082172648112"
                                                y2="162.9015" stroke="var(--bs-border-color)" stroke-dasharray="8"
                                                stroke-linecap="butt" class="apexcharts-gridline"></line>
                                        </g>
                                        <g class="apexcharts-gridlines-vertical"></g>
                                        <line x1="0" y1="217.202" x2="426.8379597981771" y2="217.202"
                                            stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                        <line x1="0" y1="1" x2="0" y2="217.202" stroke="transparent"
                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                    </g>
                                    <g class="apexcharts-grid-borders">
                                        <line x1="-15.244212849934895" y1="0" x2="442.082172648112" y2="0"
                                            stroke="var(--bs-border-color)" stroke-dasharray="8" stroke-linecap="butt"
                                            class="apexcharts-gridline"></line>
                                        <line x1="-15.244212849934895" y1="217.202" x2="442.082172648112" y2="217.202"
                                            stroke="var(--bs-border-color)" stroke-dasharray="8" stroke-linecap="butt"
                                            class="apexcharts-gridline"></line>
                                    </g>
                                    <g class="apexcharts-bar-series apexcharts-plot-series">
                                        <g class="apexcharts-series" rel="1" seriesName="Shipment" data:realIndex="0">
                                            <path
                                                d="M -7.113965996636285 213.203 L -7.113965996636285 56.129479999999994 C -7.113965996636285 54.129479999999994 -5.113965996636285 52.129479999999994 -3.113965996636285 52.129479999999994 L 3.1139659966362854 52.129479999999994 C 5.113965996636285 52.129479999999994 7.113965996636285 54.129479999999994 7.113965996636285 56.129479999999994 L 7.113965996636285 213.203 C 7.113965996636285 215.203 5.113965996636285 217.203 3.113965996636285 217.203 L -3.1139659966362854 217.203 C -5.113965996636285 217.203 -7.113965996636285 215.203 -7.113965996636285 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M -7.113965996636285 213.203 L -7.113965996636285 56.129479999999994 C -7.113965996636285 54.129479999999994 -5.113965996636285 52.129479999999994 -3.113965996636285 52.129479999999994 L 3.1139659966362854 52.129479999999994 C 5.113965996636285 52.129479999999994 7.113965996636285 54.129479999999994 7.113965996636285 56.129479999999994 L 7.113965996636285 213.203 C 7.113965996636285 215.203 5.113965996636285 217.203 3.113965996636285 217.203 L -3.1139659966362854 217.203 C -5.113965996636285 217.203 -7.113965996636285 215.203 -7.113965996636285 213.203 Z "
                                                pathFrom="M -7.113965996636285 217.203 L -7.113965996636285 217.203 L 7.113965996636285 217.203 L 7.113965996636285 217.203 L 7.113965996636285 217.203 L 7.113965996636285 217.203 L 7.113965996636285 217.203 L -7.113965996636285 217.203 Z"
                                                cy="52.128479999999996" cx="7.113965996636285" j="0" val="38"
                                                barHeight="165.07352" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 40.31247398093895 213.203 L 40.31247398093895 25.721200000000007 C 40.31247398093895 23.721200000000007 42.31247398093895 21.721200000000007 44.31247398093895 21.721200000000007 L 50.54040597421152 21.721200000000007 C 52.54040597421152 21.721200000000007 54.54040597421152 23.721200000000007 54.54040597421152 25.721200000000007 L 54.54040597421152 213.203 C 54.54040597421152 215.203 52.54040597421152 217.203 50.54040597421152 217.203 L 44.31247398093895 217.203 C 42.31247398093895 217.203 40.31247398093895 215.203 40.31247398093895 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 40.31247398093895 213.203 L 40.31247398093895 25.721200000000007 C 40.31247398093895 23.721200000000007 42.31247398093895 21.721200000000007 44.31247398093895 21.721200000000007 L 50.54040597421152 21.721200000000007 C 52.54040597421152 21.721200000000007 54.54040597421152 23.721200000000007 54.54040597421152 25.721200000000007 L 54.54040597421152 213.203 C 54.54040597421152 215.203 52.54040597421152 217.203 50.54040597421152 217.203 L 44.31247398093895 217.203 C 42.31247398093895 217.203 40.31247398093895 215.203 40.31247398093895 213.203 Z "
                                                pathFrom="M 40.31247398093895 217.203 L 40.31247398093895 217.203 L 54.54040597421152 217.203 L 54.54040597421152 217.203 L 54.54040597421152 217.203 L 54.54040597421152 217.203 L 54.54040597421152 217.203 L 40.31247398093895 217.203 Z"
                                                cy="21.720200000000006" cx="54.54040597421152" j="1" val="45"
                                                barHeight="195.4818" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 87.73891395851419 213.203 L 87.73891395851419 77.84968 C 87.73891395851419 75.84968 89.73891395851419 73.84968 91.73891395851419 73.84968 L 97.96684595178675 73.84968 C 99.96684595178675 73.84968 101.96684595178675 75.84968 101.96684595178675 77.84968 L 101.96684595178675 213.203 C 101.96684595178675 215.203 99.96684595178675 217.203 97.96684595178675 217.203 L 91.73891395851419 217.203 C 89.73891395851419 217.203 87.73891395851419 215.203 87.73891395851419 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 87.73891395851419 213.203 L 87.73891395851419 77.84968 C 87.73891395851419 75.84968 89.73891395851419 73.84968 91.73891395851419 73.84968 L 97.96684595178675 73.84968 C 99.96684595178675 73.84968 101.96684595178675 75.84968 101.96684595178675 77.84968 L 101.96684595178675 213.203 C 101.96684595178675 215.203 99.96684595178675 217.203 97.96684595178675 217.203 L 91.73891395851419 217.203 C 89.73891395851419 217.203 87.73891395851419 215.203 87.73891395851419 213.203 Z "
                                                pathFrom="M 87.73891395851419 217.203 L 87.73891395851419 217.203 L 101.96684595178675 217.203 L 101.96684595178675 217.203 L 101.96684595178675 217.203 L 101.96684595178675 217.203 L 101.96684595178675 217.203 L 87.73891395851419 217.203 Z"
                                                cy="73.84868" cx="101.96684595178675" j="2" val="33"
                                                barHeight="143.35332" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 135.16535393608942 213.203 L 135.16535393608942 56.129479999999994 C 135.16535393608942 54.129479999999994 137.16535393608942 52.129479999999994 139.16535393608942 52.129479999999994 L 145.39328592936198 52.129479999999994 C 147.39328592936198 52.129479999999994 149.39328592936198 54.129479999999994 149.39328592936198 56.129479999999994 L 149.39328592936198 213.203 C 149.39328592936198 215.203 147.39328592936198 217.203 145.39328592936198 217.203 L 139.16535393608942 217.203 C 137.16535393608942 217.203 135.16535393608942 215.203 135.16535393608942 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 135.16535393608942 213.203 L 135.16535393608942 56.129479999999994 C 135.16535393608942 54.129479999999994 137.16535393608942 52.129479999999994 139.16535393608942 52.129479999999994 L 145.39328592936198 52.129479999999994 C 147.39328592936198 52.129479999999994 149.39328592936198 54.129479999999994 149.39328592936198 56.129479999999994 L 149.39328592936198 213.203 C 149.39328592936198 215.203 147.39328592936198 217.203 145.39328592936198 217.203 L 139.16535393608942 217.203 C 137.16535393608942 217.203 135.16535393608942 215.203 135.16535393608942 213.203 Z "
                                                pathFrom="M 135.16535393608942 217.203 L 135.16535393608942 217.203 L 149.39328592936198 217.203 L 149.39328592936198 217.203 L 149.39328592936198 217.203 L 149.39328592936198 217.203 L 149.39328592936198 217.203 L 135.16535393608942 217.203 Z"
                                                cy="52.128479999999996" cx="149.39328592936198" j="3" val="38"
                                                barHeight="165.07352" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 182.59179391366465 213.203 L 182.59179391366465 82.19372000000001 C 182.59179391366465 80.19372000000001 184.59179391366465 78.19372000000001 186.59179391366465 78.19372000000001 L 192.8197259069372 78.19372000000001 C 194.8197259069372 78.19372000000001 196.8197259069372 80.19372000000001 196.8197259069372 82.19372000000001 L 196.8197259069372 213.203 C 196.8197259069372 215.203 194.8197259069372 217.203 192.8197259069372 217.203 L 186.59179391366465 217.203 C 184.59179391366465 217.203 182.59179391366465 215.203 182.59179391366465 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 182.59179391366465 213.203 L 182.59179391366465 82.19372000000001 C 182.59179391366465 80.19372000000001 184.59179391366465 78.19372000000001 186.59179391366465 78.19372000000001 L 192.8197259069372 78.19372000000001 C 194.8197259069372 78.19372000000001 196.8197259069372 80.19372000000001 196.8197259069372 82.19372000000001 L 196.8197259069372 213.203 C 196.8197259069372 215.203 194.8197259069372 217.203 192.8197259069372 217.203 L 186.59179391366465 217.203 C 184.59179391366465 217.203 182.59179391366465 215.203 182.59179391366465 213.203 Z "
                                                pathFrom="M 182.59179391366465 217.203 L 182.59179391366465 217.203 L 196.8197259069372 217.203 L 196.8197259069372 217.203 L 196.8197259069372 217.203 L 196.8197259069372 217.203 L 196.8197259069372 217.203 L 182.59179391366465 217.203 Z"
                                                cy="78.19272000000001" cx="196.8197259069372" j="4" val="32"
                                                barHeight="139.00928" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 230.01823389123987 213.203 L 230.01823389123987 4.001 C 230.01823389123987 2.0010000000000003 232.01823389123987 0.001 234.01823389123987 0.001 L 240.24616588451244 0.001 C 242.24616588451244 0.001 244.24616588451244 2.001 244.24616588451244 4.001 L 244.24616588451244 213.203 C 244.24616588451244 215.203 242.24616588451244 217.203 240.24616588451244 217.203 L 234.01823389123987 217.203 C 232.01823389123987 217.203 230.01823389123987 215.203 230.01823389123987 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 230.01823389123987 213.203 L 230.01823389123987 4.001 C 230.01823389123987 2.0010000000000003 232.01823389123987 0.001 234.01823389123987 0.001 L 240.24616588451244 0.001 C 242.24616588451244 0.001 244.24616588451244 2.001 244.24616588451244 4.001 L 244.24616588451244 213.203 C 244.24616588451244 215.203 242.24616588451244 217.203 240.24616588451244 217.203 L 234.01823389123987 217.203 C 232.01823389123987 217.203 230.01823389123987 215.203 230.01823389123987 213.203 Z "
                                                pathFrom="M 230.01823389123987 217.203 L 230.01823389123987 217.203 L 244.24616588451244 217.203 L 244.24616588451244 217.203 L 244.24616588451244 217.203 L 244.24616588451244 217.203 L 244.24616588451244 217.203 L 230.01823389123987 217.203 Z"
                                                cy="0" cx="244.24616588451244" j="5" val="50" barHeight="217.202"
                                                barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 277.44467386881513 213.203 L 277.44467386881513 12.689080000000013 C 277.44467386881513 10.689080000000013 279.44467386881513 8.689080000000013 281.44467386881513 8.689080000000013 L 287.6726058620877 8.689080000000013 C 289.6726058620877 8.689080000000013 291.6726058620877 10.689080000000013 291.6726058620877 12.689080000000013 L 291.6726058620877 213.203 C 291.6726058620877 215.203 289.6726058620877 217.203 287.6726058620877 217.203 L 281.44467386881513 217.203 C 279.44467386881513 217.203 277.44467386881513 215.203 277.44467386881513 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 277.44467386881513 213.203 L 277.44467386881513 12.689080000000013 C 277.44467386881513 10.689080000000013 279.44467386881513 8.689080000000013 281.44467386881513 8.689080000000013 L 287.6726058620877 8.689080000000013 C 289.6726058620877 8.689080000000013 291.6726058620877 10.689080000000013 291.6726058620877 12.689080000000013 L 291.6726058620877 213.203 C 291.6726058620877 215.203 289.6726058620877 217.203 287.6726058620877 217.203 L 281.44467386881513 217.203 C 279.44467386881513 217.203 277.44467386881513 215.203 277.44467386881513 213.203 Z "
                                                pathFrom="M 277.44467386881513 217.203 L 277.44467386881513 217.203 L 291.6726058620877 217.203 L 291.6726058620877 217.203 L 291.6726058620877 217.203 L 291.6726058620877 217.203 L 291.6726058620877 217.203 L 277.44467386881513 217.203 Z"
                                                cy="8.688080000000014" cx="291.6726058620877" j="6" val="48"
                                                barHeight="208.51391999999998" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 324.87111384639036 213.203 L 324.87111384639036 47.44140000000001 C 324.87111384639036 45.44140000000001 326.87111384639036 43.44140000000001 328.87111384639036 43.44140000000001 L 335.09904583966295 43.44140000000001 C 337.09904583966295 43.44140000000001 339.09904583966295 45.44140000000001 339.09904583966295 47.44140000000001 L 339.09904583966295 213.203 C 339.09904583966295 215.203 337.09904583966295 217.203 335.09904583966295 217.203 L 328.87111384639036 217.203 C 326.87111384639036 217.203 324.87111384639036 215.203 324.87111384639036 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 324.87111384639036 213.203 L 324.87111384639036 47.44140000000001 C 324.87111384639036 45.44140000000001 326.87111384639036 43.44140000000001 328.87111384639036 43.44140000000001 L 335.09904583966295 43.44140000000001 C 337.09904583966295 43.44140000000001 339.09904583966295 45.44140000000001 339.09904583966295 47.44140000000001 L 339.09904583966295 213.203 C 339.09904583966295 215.203 337.09904583966295 217.203 335.09904583966295 217.203 L 328.87111384639036 217.203 C 326.87111384639036 217.203 324.87111384639036 215.203 324.87111384639036 213.203 Z "
                                                pathFrom="M 324.87111384639036 217.203 L 324.87111384639036 217.203 L 339.09904583966295 217.203 L 339.09904583966295 217.203 L 339.09904583966295 217.203 L 339.09904583966295 217.203 L 339.09904583966295 217.203 L 324.87111384639036 217.203 Z"
                                                cy="43.44040000000001" cx="339.09904583966295" j="7" val="40"
                                                barHeight="173.7616" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 372.2975538239656 213.203 L 372.2975538239656 38.753319999999995 C 372.2975538239656 36.753319999999995 374.2975538239656 34.753319999999995 376.2975538239656 34.753319999999995 L 382.5254858172382 34.753319999999995 C 384.5254858172382 34.753319999999995 386.5254858172382 36.753319999999995 386.5254858172382 38.753319999999995 L 386.5254858172382 213.203 C 386.5254858172382 215.203 384.5254858172382 217.203 382.5254858172382 217.203 L 376.2975538239656 217.203 C 374.2975538239656 217.203 372.2975538239656 215.203 372.2975538239656 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 372.2975538239656 213.203 L 372.2975538239656 38.753319999999995 C 372.2975538239656 36.753319999999995 374.2975538239656 34.753319999999995 376.2975538239656 34.753319999999995 L 382.5254858172382 34.753319999999995 C 384.5254858172382 34.753319999999995 386.5254858172382 36.753319999999995 386.5254858172382 38.753319999999995 L 386.5254858172382 213.203 C 386.5254858172382 215.203 384.5254858172382 217.203 382.5254858172382 217.203 L 376.2975538239656 217.203 C 374.2975538239656 217.203 372.2975538239656 215.203 372.2975538239656 213.203 Z "
                                                pathFrom="M 372.2975538239656 217.203 L 372.2975538239656 217.203 L 386.5254858172382 217.203 L 386.5254858172382 217.203 L 386.5254858172382 217.203 L 386.5254858172382 217.203 L 386.5254858172382 217.203 L 372.2975538239656 217.203 Z"
                                                cy="34.75232" cx="386.5254858172382" j="8" val="42"
                                                barHeight="182.44968" barWidth="14.22793199327257"></path>
                                            <path
                                                d="M 419.7239938015408 213.203 L 419.7239938015408 60.47352 C 419.7239938015408 58.47352 421.7239938015408 56.47352 423.7239938015408 56.47352 L 429.9519257948134 56.47352 C 431.9519257948134 56.47352 433.9519257948134 58.47352 433.9519257948134 60.47352 L 433.9519257948134 213.203 C 433.9519257948134 215.203 431.9519257948134 217.203 429.9519257948134 217.203 L 423.7239938015408 217.203 C 421.7239938015408 217.203 419.7239938015408 215.203 419.7239938015408 213.203 Z "
                                                fill="var(--bs-warning)" fill-opacity="1" stroke="var(--bs-warning)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 419.7239938015408 213.203 L 419.7239938015408 60.47352 C 419.7239938015408 58.47352 421.7239938015408 56.47352 423.7239938015408 56.47352 L 429.9519257948134 56.47352 C 431.9519257948134 56.47352 433.9519257948134 58.47352 433.9519257948134 60.47352 L 433.9519257948134 213.203 C 433.9519257948134 215.203 431.9519257948134 217.203 429.9519257948134 217.203 L 423.7239938015408 217.203 C 421.7239938015408 217.203 419.7239938015408 215.203 419.7239938015408 213.203 Z "
                                                pathFrom="M 419.7239938015408 217.203 L 419.7239938015408 217.203 L 433.9519257948134 217.203 L 433.9519257948134 217.203 L 433.9519257948134 217.203 L 433.9519257948134 217.203 L 433.9519257948134 217.203 L 419.7239938015408 217.203 Z"
                                                cy="56.47252" cx="433.9519257948134" j="9" val="37"
                                                barHeight="160.72948" barWidth="14.22793199327257"></path>
                                            <g class="apexcharts-bar-goals-markers">
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)"></g>
                                            </g>
                                            <g class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g>
                                        </g>
                                    </g>
                                    <g class="apexcharts-line-series apexcharts-plot-series">
                                        <g class="apexcharts-series" zIndex="1" seriesName="Delivery"
                                            data:longestSeries="true" rel="1" data:realIndex="1">
                                            <path
                                                d="M 0 117.28908C 16.599253992151333 117.28908 30.827185985423903 95.56888 47.426439977575235 95.56888C 64.02569396972658 95.56888 78.25362596299914 117.28908 94.85287995515047 117.28908C 111.4521339473018 117.28908 125.68006594057438 78.19272000000001 142.2793199327257 78.19272000000001C 158.87857392487703 78.19272000000001 173.10650591814962 95.56888 189.70575991030094 95.56888C 206.30501390245226 95.56888 220.53294589572485 26.064240000000012 237.13219988787617 26.064240000000012C 253.73145388002752 26.064240000000012 267.9593858733001 78.19272000000001 284.5586398654514 78.19272000000001C 301.15789385760274 78.19272000000001 315.38582585087534 52.128479999999996 331.98507984302665 52.128479999999996C 348.584333835178 52.128479999999996 362.81226582845056 104.25696 379.4115198206019 104.25696C 396.0107738127532 104.25696 410.2387058060258 69.50464 426.8379597981771 69.50464"
                                                fill="none" fill-opacity="1" stroke="var(--bs-primary)"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="3"
                                                stroke-dasharray="0" class="apexcharts-line" index="1"
                                                clip-path="url(#gridRectBarMask58a1x77w)"
                                                pathTo="M 0 117.28908C 16.599253992151333 117.28908 30.827185985423903 95.56888 47.426439977575235 95.56888C 64.02569396972658 95.56888 78.25362596299914 117.28908 94.85287995515047 117.28908C 111.4521339473018 117.28908 125.68006594057438 78.19272000000001 142.2793199327257 78.19272000000001C 158.87857392487703 78.19272000000001 173.10650591814962 95.56888 189.70575991030094 95.56888C 206.30501390245226 95.56888 220.53294589572485 26.064240000000012 237.13219988787617 26.064240000000012C 253.73145388002752 26.064240000000012 267.9593858733001 78.19272000000001 284.5586398654514 78.19272000000001C 301.15789385760274 78.19272000000001 315.38582585087534 52.128479999999996 331.98507984302665 52.128479999999996C 348.584333835178 52.128479999999996 362.81226582845056 104.25696 379.4115198206019 104.25696C 396.0107738127532 104.25696 410.2387058060258 69.50464 426.8379597981771 69.50464"
                                                pathFrom="M 0 217.202 L 0 217.202 L 47.426439977575235 217.202 L 94.85287995515047 217.202 L 142.2793199327257 217.202 L 189.70575991030094 217.202 L 237.13219988787617 217.202 L 284.5586398654514 217.202 L 331.98507984302665 217.202 L 379.4115198206019 217.202 L 426.8379597981771 217.202"
                                                fill-rule="evenodd"></path>
                                            <g class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                data:realIndex="1">
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 0, 117.28908 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="0" cy="117.28908" shape="circle"
                                                        class="apexcharts-marker wzoe1de06" rel="0" j="0" index="1"
                                                        default-marker-size="5"></path>
                                                    <path d="M 47.426439977575235, 95.56888 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="47.426439977575235" cy="95.56888" shape="circle"
                                                        class="apexcharts-marker wv37e2bcn" rel="1" j="1" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 94.85287995515047, 117.28908 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="94.85287995515047" cy="117.28908" shape="circle"
                                                        class="apexcharts-marker wtmsl7kh6" rel="2" j="2" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 142.2793199327257, 78.19272000000001 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="142.2793199327257" cy="78.19272000000001" shape="circle"
                                                        class="apexcharts-marker wiqk3v5ss" rel="3" j="3" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 189.70575991030094, 95.56888 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="189.70575991030094" cy="95.56888" shape="circle"
                                                        class="apexcharts-marker wrd2b1moc" rel="4" j="4" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 237.13219988787617, 26.064240000000012 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="237.13219988787617" cy="26.064240000000012" shape="circle"
                                                        class="apexcharts-marker wrrbb9oqql" rel="5" j="5" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 284.5586398654514, 78.19272000000001 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="284.5586398654514" cy="78.19272000000001" shape="circle"
                                                        class="apexcharts-marker wl6sm1ocbf" rel="6" j="6" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 331.98507984302665, 52.128479999999996 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="331.98507984302665" cy="52.128479999999996" shape="circle"
                                                        class="apexcharts-marker wyikowmm" rel="7" j="7" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 379.4115198206019, 104.25696 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="379.4115198206019" cy="104.25696" shape="circle"
                                                        class="apexcharts-marker w9wptsrm8" rel="8" j="8" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                                <g class="apexcharts-series-markers"
                                                    clip-path="url(#gridRectMarkerMask58a1x77w)">
                                                    <path d="M 426.8379597981771, 69.50464 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-white)" fill-opacity="1" stroke="var(--bs-primary)" stroke-opacity="0.9"
                                                        stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                        cx="426.8379597981771" cy="69.50464" shape="circle"
                                                        class="apexcharts-marker wl5str0rc" rel="9" j="9" index="1"
                                                        default-marker-size="5"></path>
                                                </g>
                                            </g>
                                        </g>
                                        <g class="apexcharts-datalabels apexcharts-hidden-element-shown"
                                            data:realIndex="0"></g>
                                        <g class="apexcharts-datalabels" data:realIndex="1"></g>
                                    </g>
                                    <line x1="-15.244212849934895" y1="0" x2="442.082172648112" y2="0" stroke="#b6b6b6"
                                        stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                        class="apexcharts-ycrosshairs"></line>
                                    <line x1="-15.244212849934895" y1="0" x2="442.082172648112" y2="0" stroke="#b6b6b6"
                                        stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                        class="apexcharts-ycrosshairs-hidden"></line>
                                    <g class="apexcharts-xaxis" transform="translate(0, 0)">
                                        <g class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text x="0"
                                                y="245.202" text-anchor="middle" dominant-baseline="auto"
                                                font-size="10px" font-family="var(--bs-font-family-base)"
                                                font-weight="400" fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>1 Jan</tspan>
                                                <title>1 Jan</title>
                                            </text><text x="47.42643997757524" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>2 Jan</tspan>
                                                <title>2 Jan</title>
                                            </text><text x="94.85287995515048" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>3 Jan</tspan>
                                                <title>3 Jan</title>
                                            </text><text x="142.2793199327257" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>4 Jan</tspan>
                                                <title>4 Jan</title>
                                            </text><text x="189.70575991030094" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>5 Jan</tspan>
                                                <title>5 Jan</title>
                                            </text><text x="237.1321998878762" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>6 Jan</tspan>
                                                <title>6 Jan</title>
                                            </text><text x="284.5586398654514" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>7 Jan</tspan>
                                                <title>7 Jan</title>
                                            </text><text x="331.98507984302665" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>8 Jan</tspan>
                                                <title>8 Jan</title>
                                            </text><text x="379.4115198206019" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>9 Jan</tspan>
                                                <title>9 Jan</title>
                                            </text><text x="426.8379597981771" y="245.202" text-anchor="middle"
                                                dominant-baseline="auto" font-size="10px"
                                                font-family="var(--bs-font-family-base)" font-weight="400"
                                                fill="var(--bs-secondary-color)"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: var(--bs-font-family-base);">
                                                <tspan>10 Jan</tspan>
                                                <title>10 Jan</title>
                                            </text></g>
                                    </g>
                                    <g class="apexcharts-yaxis-annotations"></g>
                                    <g class="apexcharts-xaxis-annotations"></g>
                                    <g class="apexcharts-point-annotations"></g>
                                </g>
                            </svg>
                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                <div class="apexcharts-tooltip-title"
                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0"
                                    style="order: 1;"><span class="apexcharts-tooltip-marker"
                                        style="background-color: var(--bs-warning);"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1"
                                    style="order: 2;"><span class="apexcharts-tooltip-marker"
                                        style="background-color: var(--bs-primary);"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light">
                                <div class="apexcharts-xaxistooltip-text"
                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                            </div>
                            <div
                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Shipment statistics -->

        <!-- Delivery Performance -->
        <div class="col-xxl-4 col-lg-5">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1 me-2">Delivery Performance</h5>
                        <p class="card-subtitle">12% increase in this month</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn text-body-secondary p-0" type="button" id="deliveryPerformance"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base bx bx-dots-vertical-rounded icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryPerformance">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class="icon-base bx bx-cube icon-lg"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-1 fw-normal">Packages in transit</h6>
                                    <p class="text-success mb-0">
                                        <i class="icon-base bx bx-chevron-up icon-lg me-1"></i>
                                        25.8%
                                    </p>
                                </div>
                                <div class="user-progress">
                                    <h6 class="mb-0">10k</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-info"><i
                                        class="icon-base bx bxs-truck icon-lg"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-1 fw-normal">Packages out for delivery</h6>
                                    <p class="text-success mb-0">
                                        <i class="icon-base bx bx-chevron-up icon-lg me-1"></i>
                                        4.3%
                                    </p>
                                </div>
                                <div class="user-progress">
                                    <h6 class="mb-0">5k</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class="icon-base bx bx-check-circle icon-lg"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-1 fw-normal">Packages delivered</h6>
                                    <p class="text-danger mb-0">
                                        <i class="icon-base bx bx-chevron-down icon-lg me-1"></i>
                                        12.5
                                    </p>
                                </div>
                                <div class="user-progress">
                                    <h6 class="mb-0">15k</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="icon-base bx bxs-offer icon-lg"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-1 fw-normal">Delivery success rate</h6>
                                    <p class="text-success mb-0">
                                        <i class="icon-base bx bx-chevron-up icon-lg me-1"></i>
                                        35.6%
                                    </p>
                                </div>
                                <div class="user-progress">
                                    <h6 class="mb-0">95%</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6 align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-secondary"><i
                                        class="icon-base bx bx-time-five icon-lg"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-1 fw-normal">Average delivery time</h6>
                                    <p class="text-danger mb-0">
                                        <i class="icon-base bx bx-chevron-down icon-lg me-1"></i>
                                        2.15
                                    </p>
                                </div>
                                <div class="user-progress">
                                    <h6 class="mb-0">2.5 Days</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class="icon-base bx bx-group icon-lg"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-1 fw-normal">Customer satisfaction</h6>
                                    <p class="text-success mb-0">
                                        <i class="icon-base bx bx-chevron-up icon-lg me-1"></i>
                                        5.7%
                                    </p>
                                </div>
                                <div class="user-progress">
                                    <h6 class="mb-0">4.5/5</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Delivery Performance -->

        <!-- Reasons for delivery exceptions -->
        <div class="col-xxl-4 col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Reasons for delivery exceptions</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base bx bx-dots-vertical-rounded icon-lg text-body-secondary"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="deliveryExceptionsChart" style="min-height: 400px;" class="">
                        <div id="apexchartss6l3ac0y" class="apexcharts-canvas apexchartss6l3ac0y apexcharts-theme-"
                            style="width: 460px; height: 400px;"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" class="apexcharts-svg"
                                xmlns:data="ApexChartsNS" transform="translate(0, 0)" width="460" height="400">
                                <foreignObject x="0" y="0" width="460" height="400">
                                    <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom"
                                        xmlns="http://www.w3.org/1999/xhtml"
                                        style="right: 0px; position: absolute; left: 0px; top: 351px; max-height: 198px;">
                                        <div class="apexcharts-legend-series" rel="1" seriesname="Incorrectxaddress"
                                            data:collapsed="false" style="margin: 5px 15px;"><span
                                                class="apexcharts-legend-marker" rel="1" data:collapsed="false"
                                                style="height: 12px; width: 12px; left: 0px; top: 0px;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                                                    height="100%">
                                                    <path d="M 0, 0 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="var(--bs-success)" fill-opacity="1" stroke="#ffffff" stroke-opacity="0.9"
                                                        stroke-linecap="butt" stroke-width="1" stroke-dasharray="0"
                                                        cx="0" cy="0" shape="circle"
                                                        class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle"
                                                        style="transform: translate(50%, 50%);"></path>
                                                </svg></span><span class="apexcharts-legend-text" rel="1" i="0"
                                                data:default-text="Incorrect%20address" data:collapsed="false"
                                                style="color: var(--bs-heading-color); font-size: 13px; font-weight: 400; font-family: var(--bs-font-family-base);">Incorrect
                                                address</span></div>
                                        <div class="apexcharts-legend-series" rel="2" seriesname="Weatherxconditions"
                                            data:collapsed="false" style="margin: 5px 15px;"><span
                                                class="apexcharts-legend-marker" rel="2" data:collapsed="false"
                                                style="height: 12px; width: 12px; left: 0px; top: 0px;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                                                    height="100%">
                                                    <path d="M 0, 0 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="color-mix(in sRGB, var(--bs-success) 80%, var(--bs-paper-bg))" fill-opacity="1"
                                                        stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="butt"
                                                        stroke-width="1" stroke-dasharray="0" cx="0" cy="0"
                                                        shape="circle"
                                                        class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle"
                                                        style="transform: translate(50%, 50%);"></path>
                                                </svg></span><span class="apexcharts-legend-text" rel="2" i="1"
                                                data:default-text="Weather%20conditions" data:collapsed="false"
                                                style="color: var(--bs-heading-color); font-size: 13px; font-weight: 400; font-family: var(--bs-font-family-base);">Weather
                                                conditions</span></div>
                                        <div class="apexcharts-legend-series" rel="3" seriesname="FederalxHolidays"
                                            data:collapsed="false" style="margin: 5px 15px;"><span
                                                class="apexcharts-legend-marker" rel="3" data:collapsed="false"
                                                style="height: 12px; width: 12px; left: 0px; top: 0px;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                                                    height="100%">
                                                    <path d="M 0, 0 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="color-mix(in sRGB, var(--bs-success) 60%, var(--bs-paper-bg))" fill-opacity="1"
                                                        stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="butt"
                                                        stroke-width="1" stroke-dasharray="0" cx="0" cy="0"
                                                        shape="circle"
                                                        class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle"
                                                        style="transform: translate(50%, 50%);"></path>
                                                </svg></span><span class="apexcharts-legend-text" rel="3" i="2"
                                                data:default-text="Federal%20Holidays" data:collapsed="false"
                                                style="color: var(--bs-heading-color); font-size: 13px; font-weight: 400; font-family: var(--bs-font-family-base);">Federal
                                                Holidays</span></div>
                                        <div class="apexcharts-legend-series" rel="4" seriesname="Damagexduringxtransit"
                                            data:collapsed="false" style="margin: 5px 15px;"><span
                                                class="apexcharts-legend-marker" rel="4" data:collapsed="false"
                                                style="height: 12px; width: 12px; left: 0px; top: 0px;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                                                    height="100%">
                                                    <path d="M 0, 0 
           m -5, 0 
           a 5,5 0 1,0 10,0 
           a 5,5 0 1,0 -10,0" fill="color-mix(in sRGB, var(--bs-success) 40%, var(--bs-paper-bg))" fill-opacity="1"
                                                        stroke="#ffffff" stroke-opacity="0.9" stroke-linecap="butt"
                                                        stroke-width="1" stroke-dasharray="0" cx="0" cy="0"
                                                        shape="circle"
                                                        class="apexcharts-legend-marker apexcharts-marker apexcharts-marker-circle"
                                                        style="transform: translate(50%, 50%);"></path>
                                                </svg></span><span class="apexcharts-legend-text" rel="4" i="3"
                                                data:default-text="Damage%20during%20transit" data:collapsed="false"
                                                style="color: var(--bs-heading-color); font-size: 13px; font-weight: 400; font-family: var(--bs-font-family-base);">Damage
                                                during transit</span></div>
                                    </div>
                                    <style type="text/css">
                                        .apexcharts-flip-y {
                                            transform: scaleY(-1) translateY(-100%);
                                            transform-origin: top;
                                            transform-box: fill-box;
                                        }

                                        .apexcharts-flip-x {
                                            transform: scaleX(-1);
                                            transform-origin: center;
                                            transform-box: fill-box;
                                        }

                                        .apexcharts-legend {
                                            display: flex;
                                            overflow: auto;
                                            padding: 0 10px;
                                        }

                                        .apexcharts-legend.apexcharts-legend-group-horizontal {
                                            flex-direction: column;
                                        }

                                        .apexcharts-legend-group {
                                            display: flex;
                                        }

                                        .apexcharts-legend-group-vertical {
                                            flex-direction: column-reverse;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom,
                                        .apexcharts-legend.apx-legend-position-top {
                                            flex-wrap: wrap
                                        }

                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            flex-direction: column;
                                            bottom: 0;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            justify-content: flex-start;
                                            align-items: flex-start;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                            justify-content: center;
                                            align-items: center;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                            justify-content: flex-end;
                                            align-items: flex-end;
                                        }

                                        .apexcharts-legend-series {
                                            cursor: pointer;
                                            line-height: normal;
                                            display: flex;
                                            align-items: center;
                                        }

                                        .apexcharts-legend-text {
                                            position: relative;
                                            font-size: 14px;
                                        }

                                        .apexcharts-legend-text *,
                                        .apexcharts-legend-marker * {
                                            pointer-events: none;
                                        }

                                        .apexcharts-legend-marker {
                                            position: relative;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            cursor: pointer;
                                            margin-right: 1px;
                                        }

                                        .apexcharts-legend-series.apexcharts-no-click {
                                            cursor: auto;
                                        }

                                        .apexcharts-legend .apexcharts-hidden-zero-series,
                                        .apexcharts-legend .apexcharts-hidden-null-series {
                                            display: none !important;
                                        }

                                        .apexcharts-inactive-legend {
                                            opacity: 0.45;
                                        }
                                    </style>
                                </foreignObject>
                                <g class="apexcharts-inner apexcharts-graphical" transform="translate(0, 15)">
                                    <defs>
                                        <clipPath id="gridRectMasks6l3ac0y">
                                            <rect width="460" height="321" x="0" y="0" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="gridRectBarMasks6l3ac0y">
                                            <rect width="464" height="325" x="-2" y="-2" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="gridRectMarkerMasks6l3ac0y">
                                            <rect width="460" height="321" x="0" y="0" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="forecastMasks6l3ac0y"></clipPath>
                                        <clipPath id="nonForecastMasks6l3ac0y"></clipPath>
                                    </defs>
                                    <g class="apexcharts-pie">
                                        <g transform="translate(0, 0) scale(1)">
                                            <circle r="117.49073170731708" cx="230" cy="160.5" fill="transparent">
                                            </circle>
                                            <g class="apexcharts-slices">
                                                <g class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="Incorrectxaddress" rel="1" data:realIndex="0">
                                                    <path
                                                        d="M 230 7.914634146341456 A 152.58536585365854 152.58536585365854 0 0 1 341.2299447109354 56.0481293978079 L 315.64705742742024 80.07205963631208 A 117.49073170731708 117.49073170731708 0 0 0 230 43.00926829268292 L 230 7.914634146341456 z "
                                                        fill="var(--bs-success)" fill-opacity="1" stroke="#ffffff"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                        stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-0" index="0"
                                                        j="0" data:angle="46.8" data:startAngle="0" data:strokeWidth="0"
                                                        data:value="13"
                                                        data:pathOrig="M 230 7.914634146341456 A 152.58536585365854 152.58536585365854 0 0 1 341.2299447109354 56.0481293978079 L 315.64705742742024 80.07205963631208 A 117.49073170731708 117.49073170731708 0 0 0 230 43.00926829268292 L 230 7.914634146341456 z ">
                                                    </path>
                                                </g>
                                                <g class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="Weatherxconditions" rel="2" data:realIndex="1">
                                                    <path
                                                        d="M 341.2299447109354 56.0481293978079 A 152.58536585365854 152.58536585365854 0 0 1 334.4518706021921 271.7299447109354 L 310.4279403636879 246.14705742742024 A 117.49073170731708 117.49073170731708 0 0 0 315.64705742742024 80.07205963631208 L 341.2299447109354 56.0481293978079 z "
                                                        fill="color-mix(in sRGB, var(--bs-success) 80%, var(--bs-paper-bg))"
                                                        fill-opacity="1" stroke="#ffffff" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-1" index="0"
                                                        j="1" data:angle="90.00000000000001" data:startAngle="46.8"
                                                        data:strokeWidth="0" data:value="25"
                                                        data:pathOrig="M 341.2299447109354 56.0481293978079 A 152.58536585365854 152.58536585365854 0 0 1 334.4518706021921 271.7299447109354 L 310.4279403636879 246.14705742742024 A 117.49073170731708 117.49073170731708 0 0 0 315.64705742742024 80.07205963631208 L 341.2299447109354 56.0481293978079 z ">
                                                    </path>
                                                </g>
                                                <g class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="FederalxHolidays" rel="3" data:realIndex="2">
                                                    <path
                                                        d="M 334.4518706021921 271.7299447109354 A 152.58536585365854 152.58536585365854 0 0 1 140.312572235568 283.9441540685286 L 160.94068062138737 255.551998632767 A 117.49073170731708 117.49073170731708 0 0 0 310.4279403636879 246.14705742742024 L 334.4518706021921 271.7299447109354 z "
                                                        fill="color-mix(in sRGB, var(--bs-success) 60%, var(--bs-paper-bg))"
                                                        fill-opacity="1" stroke="#ffffff" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-2" index="0"
                                                        j="2" data:angle="79.19999999999999" data:startAngle="136.8"
                                                        data:strokeWidth="0" data:value="22"
                                                        data:pathOrig="M 334.4518706021921 271.7299447109354 A 152.58536585365854 152.58536585365854 0 0 1 140.312572235568 283.9441540685286 L 160.94068062138737 255.551998632767 A 117.49073170731708 117.49073170731708 0 0 0 310.4279403636879 246.14705742742024 L 334.4518706021921 271.7299447109354 z ">
                                                    </path>
                                                </g>
                                                <g class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="Damagexduringxtransit" rel="4" data:realIndex="3">
                                                    <path
                                                        d="M 140.312572235568 283.9441540685286 A 152.58536585365854 152.58536585365854 0 0 1 229.97336882989012 7.91463647034945 L 229.97949399901538 43.00927008216908 A 117.49073170731708 117.49073170731708 0 0 0 160.94068062138737 255.551998632767 L 140.312572235568 283.9441540685286 z "
                                                        fill="color-mix(in sRGB, var(--bs-success) 40%, var(--bs-paper-bg))"
                                                        fill-opacity="1" stroke="#ffffff" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-3" index="0"
                                                        j="3" data:angle="144" data:startAngle="216"
                                                        data:strokeWidth="0" data:value="40"
                                                        data:pathOrig="M 140.312572235568 283.9441540685286 A 152.58536585365854 152.58536585365854 0 0 1 229.97336882989012 7.91463647034945 L 229.97949399901538 43.00927008216908 A 117.49073170731708 117.49073170731708 0 0 0 160.94068062138737 255.551998632767 L 140.312572235568 283.9441540685286 z ">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                        <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)">
                                            <text x="230" y="190.5" text-anchor="middle" dominant-baseline="auto"
                                                font-size="15px" font-family="var(--bs-font-family-base)"
                                                font-weight="400" fill="var(--bs-body-color)"
                                                class="apexcharts-text apexcharts-datalabel-label"
                                                style="font-family: var(--bs-font-family-base);">AVG.
                                                Exceptions</text><text x="230" y="156.5" text-anchor="middle"
                                                dominant-baseline="auto" font-size="24px"
                                                font-family="var(--bs-font-family-base)" font-weight="500"
                                                fill="var(--bs-heading-color)"
                                                class="apexcharts-text apexcharts-datalabel-value"
                                                style="font-family: var(--bs-font-family-base);">30%</text></g>
                                    </g>
                                    <line x1="0" y1="0" x2="460" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                        stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line x1="0" y1="0" x2="460" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                        stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                    </line>
                                </g>
                                <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g>
                            </svg>
                            <div class="apexcharts-tooltip apexcharts-theme-false">
                                <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0"
                                    style="order: 1;"><span class="apexcharts-tooltip-marker"
                                        style="background-color: var(--bs-success);"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-1"
                                    style="order: 2;"><span class="apexcharts-tooltip-marker"
                                        style="background-color: color-mix(in sRGB, var(--bs-success) 80%, var(--bs-paper-bg));"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-2"
                                    style="order: 3;"><span class="apexcharts-tooltip-marker"
                                        style="background-color: color-mix(in sRGB, var(--bs-success) 60%, var(--bs-paper-bg));"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-3"
                                    style="order: 4;"><span class="apexcharts-tooltip-marker"
                                        style="background-color: color-mix(in sRGB, var(--bs-success) 40%, var(--bs-paper-bg));"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Reasons for delivery exceptions -->

        <!-- Orders by Countries -->
        <div class="col-xxl-4 col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Orders by Countries</h5>
                        <p class="card-subtitle">62 deliveries in progress</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn text-body-secondary p-0" type="button" id="ordersCountries"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base bx bx-dots-vertical-rounded icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="ordersCountries">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill rounded-0 timeline-indicator-advanced" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-new" aria-controls="navs-justified-new"
                                    aria-selected="true">New</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-link-preparing"
                                    aria-controls="navs-justified-link-preparing" aria-selected="false"
                                    tabindex="-1">Preparing</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-link-shipping"
                                    aria-controls="navs-justified-link-shipping" aria-selected="false"
                                    tabindex="-1">Shipping</button>
                            </li>
                        </ul>
                        <div class="tab-content border-0  mx-1">
                            <div class="tab-pane fade active show" id="navs-justified-new" role="tabpanel">
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-6 border-left-dashed">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                            <i class="icon-base bx bx-check-circle"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase">sender</small>
                                            </div>
                                            <h6 class="my-50">Myrtle Ullrich</h6>
                                            <p class="text-body mb-0">101 Boulder, California(CA), 95959</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-6 border-transparent">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                            <i class="icon-base bx bx-map"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase">Receiver</small>
                                            </div>
                                            <h6 class="my-50">Barry Schowalter</h6>
                                            <p class="text-body mb-0">939 Orange, California(CA), 92118</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border border-dashed my-4"></div>
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-6 border-left-dashed">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                            <i class="icon-base bx bx-check-circle"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase">sender</small>
                                            </div>
                                            <h6 class="my-50">Veronica Herman</h6>
                                            <p class="text-body mb-0">162 Windsor, California(CA), 95492</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-6 border-transparent">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                            <i class="icon-base bx bx-map"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase">Receiver</small>
                                            </div>
                                            <h6 class="my-50">Helen Jacobs</h6>
                                            <p class="text-body mb-0">487 Sunset, California(CA), 94043</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-6 border-left-dashed">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                            <i class="icon-base bx bx-check-circle"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase">sender</small>
                                            </div>
                                            <h6 class="my-50">Barry Schowalter</h6>
                                            <p class="text-body mb-0">939 Orange, California(CA), 92118</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-6 border-transparent border-left-dashed">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                            <i class="icon-base bx bx-map"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase">Receiver</small>
                                            </div>
                                            <h6 class="my-50">Myrtle Ullrich</h6>
                                            <p class="text-body mb-0">101 Boulder, California(CA), 95959</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border border-dashed my-4"></div>
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-6 border-left-dashed">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                            <i class="icon-base bx bx-check-circle"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase">sender</small>
                                            </div>
                                            <h6 class="my-50">Veronica Herman</h6>
                                            <p class="text-body mb-0">162 Windsor, California(CA), 95492</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-6 border-transparent">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                            <i class="icon-base bx bx-map"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase">Receiver</small>
                                            </div>
                                            <h6 class="my-50">Helen Jacobs</h6>
                                            <p class="text-body mb-0">487 Sunset, California(CA), 94043</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-6 border-left-dashed">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                            <i class="icon-base bx bx-check-circle"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase">sender</small>
                                            </div>
                                            <h6 class="my-50">Veronica Herman</h6>
                                            <p class="text-body mb-0">101 Boulder, California(CA), 95959</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-6 border-transparent">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                            <i class="icon-base bx bx-map"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase">Receiver</small>
                                            </div>
                                            <h6 class="my-50">Barry Schowalter</h6>
                                            <p class="text-body mb-0">939 Orange, California(CA), 92118</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border border-dashed my-4"></div>
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-6 border-left-dashed">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                            <i class="icon-base bx bx-check-circle"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase">sender</small>
                                            </div>
                                            <h6 class="my-50">Myrtle Ullrich</h6>
                                            <p class="text-body mb-0">162 Windsor, California(CA), 95492</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-6 border-transparent">
                                        <span
                                            class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                            <i class="icon-base bx bx-map"></i>
                                        </span>
                                        <div class="timeline-event ps-1">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase">Receiver</small>
                                            </div>
                                            <h6 class="my-50">Helen Jacobs</h6>
                                            <p class="text-body mb-0">487 Sunset, California(CA), 94043</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Orders by Countries -->

        <!-- On route vehicles Table -->
        <div class="col-12 order-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">On route vehicles</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn text-body-secondary p-0" type="button" id="routeVehicles"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-base bx bx-dots-vertical-rounded icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="routeVehicles">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-datatable">
                    <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                        <div class="row mt-2 justify-content-between">
                            <div
                                class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto my-0">
                            </div>
                            <div
                                class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto my-0">
                            </div>
                        </div>
                        <div class="justify-content-between dt-layout-table mt-n2">
                            <div
                                class="d-md-flex justify-content-between align-items-center col-12 dt-layout-full col-md">
                                <table class="dt-route-vehicles table table-sm dataTable dtr-column"
                                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
                                    style="width: 100%;">
                                    <colgroup>
                                        <col data-dt-column="1" style="width: 58px;">
                                        <col data-dt-column="2" style="width: 178.297px;">
                                        <col data-dt-column="3" style="width: 197.25px;">
                                        <col data-dt-column="4" style="width: 183.406px;">
                                        <col data-dt-column="5" style="width: 214.25px;">
                                        <col data-dt-column="6" style="width: 207.797px;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th data-dt-column="0" class="control dt-orderable-none dtr-hidden"
                                                rowspan="1" colspan="1" aria-label="" style="display: none;"><span
                                                    class="dt-column-title"></span><span class="dt-column-order"></span>
                                            </th>
                                            <th data-dt-column="1" rowspan="1" colspan="1"
                                                class="dt-select dt-orderable-none" aria-label=""><span
                                                    class="dt-column-title"></span><span
                                                    class="dt-column-order"></span><input class="form-check-input"
                                                    type="checkbox" aria-label="Select all rows"></th>
                                            <th data-dt-column="2" rowspan="1" colspan="1"
                                                class="dt-orderable-asc dt-orderable-desc dt-ordering-asc"
                                                aria-sort="ascending" aria-label="location: Activate to invert sorting"
                                                tabindex="0"><span class="dt-column-title"
                                                    role="button">location</span><span class="dt-column-order"></span>
                                            </th>
                                            <th data-dt-column="3" rowspan="1" colspan="1"
                                                class="dt-orderable-asc dt-orderable-desc"
                                                aria-label="starting route: Activate to sort" tabindex="0"><span
                                                    class="dt-column-title" role="button">starting route</span><span
                                                    class="dt-column-order"></span></th>
                                            <th data-dt-column="4" rowspan="1" colspan="1"
                                                class="dt-orderable-asc dt-orderable-desc"
                                                aria-label="ending route: Activate to sort" tabindex="0"><span
                                                    class="dt-column-title" role="button">ending route</span><span
                                                    class="dt-column-order"></span></th>
                                            <th data-dt-column="5" rowspan="1" colspan="1"
                                                class="dt-orderable-asc dt-orderable-desc"
                                                aria-label="warnings: Activate to sort" tabindex="0"><span
                                                    class="dt-column-title" role="button">warnings</span><span
                                                    class="dt-column-order"></span></th>
                                            <th class="w-20 dt-orderable-asc dt-orderable-desc dt-type-numeric"
                                                data-dt-column="6" rowspan="1" colspan="1"
                                                aria-label="progress: Activate to sort" tabindex="0"><span
                                                    class="dt-column-title" role="button">progress</span><span
                                                    class="dt-column-order"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                            <td class="dt-select"><input aria-label="Select row"
                                                    class="form-check-input" type="checkbox"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-start align-items-center user-name">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-4">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-secondary">
                                                                <i class="icon-base bx bxs-truck icon-lg"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="text-heading text-nowrap fw-medium"
                                                            href="app-logistics-fleet.html">VOL-159145</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Paris 19, France
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Dresden, Germany
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge rounded bg-label-success">
                                                    No Warnings
                                                </span>
                                            </td>
                                            <td class="dt-type-numeric">
                                                <div class="d-flex align-items-center">
                                                    <div class="progress w-100" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="text-body ms-3">60%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                            <td class="dt-select"><input aria-label="Select row"
                                                    class="form-check-input" type="checkbox"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-start align-items-center user-name">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-4">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-secondary">
                                                                <i class="icon-base bx bxs-truck icon-lg"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="text-heading text-nowrap fw-medium"
                                                            href="app-logistics-fleet.html">VOL-182964</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Saintes, France
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Roma, Italy
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge rounded bg-label-primary">
                                                    Fuel Problems
                                                </span>
                                            </td>
                                            <td class="dt-type-numeric">
                                                <div class="d-flex align-items-center">
                                                    <div class="progress w-100" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 82%"
                                                            aria-valuenow="82" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="text-body ms-3">82%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                            <td class="dt-select"><input aria-label="Select row"
                                                    class="form-check-input" type="checkbox"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-start align-items-center user-name">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-4">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-secondary">
                                                                <i class="icon-base bx bxs-truck icon-lg"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="text-heading text-nowrap fw-medium"
                                                            href="app-logistics-fleet.html">VOL-276904</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Aulnay-sous-Bois, France
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Torino, Italy
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge rounded bg-label-warning">
                                                    Temperature Not Optimal
                                                </span>
                                            </td>
                                            <td class="dt-type-numeric">
                                                <div class="d-flex align-items-center">
                                                    <div class="progress w-100" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 30%"
                                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="text-body ms-3">30%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                            <td class="dt-select"><input aria-label="Select row"
                                                    class="form-check-input" type="checkbox"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-start align-items-center user-name">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-4">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-secondary">
                                                                <i class="icon-base bx bxs-truck icon-lg"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="text-heading text-nowrap fw-medium"
                                                            href="app-logistics-fleet.html">VOL-300198</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    West Palm Beach, USA
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Dresden, Germany
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge rounded bg-label-danger">
                                                    Ecu Not Responding
                                                </span>
                                            </td>
                                            <td class="dt-type-numeric">
                                                <div class="d-flex align-items-center">
                                                    <div class="progress w-100" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 90%"
                                                            aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="text-body ms-3">90%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                            <td class="dt-select"><input aria-label="Select row"
                                                    class="form-check-input" type="checkbox"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-start align-items-center user-name">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-4">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-secondary">
                                                                <i class="icon-base bx bxs-truck icon-lg"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="text-heading text-nowrap fw-medium"
                                                            href="app-logistics-fleet.html">VOL-302781</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Köln, Germany
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-body">
                                                    Laspezia, Italy
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge rounded bg-label-info">
                                                    Oil Leakage
                                                </span>
                                            </td>
                                            <td class="dt-type-numeric">
                                                <div class="d-flex align-items-center">
                                                    <div class="progress w-100" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 24%"
                                                            aria-valuenow="24" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="text-body ms-3">24%</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row mx-3 justify-content-between">
                            <div
                                class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto my-0">
                                <div class="dt-info" aria-live="polite" id="DataTables_Table_0_info" role="status">
                                    Showing 1 to 5 of 25 entries</div>
                            </div>
                            <div
                                class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto my-0">
                                <div class="dt-paging">
                                    <nav aria-label="pagination">
                                        <ul class="pagination">
                                            <li class="dt-paging-button page-item disabled"><button
                                                    class="page-link previous" role="link" type="button"
                                                    aria-controls="DataTables_Table_0" aria-disabled="true"
                                                    aria-label="Previous" data-dt-idx="previous" tabindex="-1"><i
                                                        class="icon-base bx bx-chevron-left scaleX-n1-rtl icon-18px"></i></button>
                                            </li>
                                            <li class="dt-paging-button page-item active"><button class="page-link"
                                                    role="link" type="button" aria-controls="DataTables_Table_0"
                                                    aria-current="page" data-dt-idx="0">1</button></li>
                                            <li class="dt-paging-button page-item"><button class="page-link" role="link"
                                                    type="button" aria-controls="DataTables_Table_0"
                                                    data-dt-idx="1">2</button></li>
                                            <li class="dt-paging-button page-item"><button class="page-link" role="link"
                                                    type="button" aria-controls="DataTables_Table_0"
                                                    data-dt-idx="2">3</button></li>
                                            <li class="dt-paging-button page-item"><button class="page-link" role="link"
                                                    type="button" aria-controls="DataTables_Table_0"
                                                    data-dt-idx="3">4</button></li>
                                            <li class="dt-paging-button page-item"><button class="page-link" role="link"
                                                    type="button" aria-controls="DataTables_Table_0"
                                                    data-dt-idx="4">5</button></li>
                                            <li class="dt-paging-button page-item"><button class="page-link next"
                                                    role="link" type="button" aria-controls="DataTables_Table_0"
                                                    aria-label="Next" data-dt-idx="next"><i
                                                        class="icon-base bx bx-chevron-right scaleX-n1-rtl icon-18px"></i></button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ On route vehicles Table -->
    </div>
</div>