@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- left side column starts -->
            <div class="col-lg-8">
                <!-- overview starts -->
                <div class="row">
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Sales | <span>Overall</span></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>₹ {{ $total_amount }}</h6>
                                        <span class="text-black small pt-1 fw-bold">{{ $orders_count }}</span>
                                        <span class="text-black small pt-2 ps-1">Orders</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Recieved Amount</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>₹ {{ $paid_amount }}</h6>
                                        <span class="text-black small pt-2 ps-1">Paid Amounts</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Pending Amounts</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>₹ {{ $pending_amount }}</h6>
                                        <span class="text-black small pt-2 ps-1">Need to collect</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- overview ends -->

                    <!-- recent order starts -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Recent Orders</h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Delivery Charge</th>
                                            <th scope="col">Extra Charge</th>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Paid Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_orders as $recent)
                                        <tr>
                                            <th scope="row"><a href="#">#{{ $recent->id }}</a></th>
                                            <td>{{ $recent->Customer->name }}</td>
                                            <td>{{ $recent->deliver_charge }}</td>
                                            <td>{{ $recent->extra_charge }}</td>
                                            <td>{{ $recent->total_amount }}</td>
                                            <td>{{ $recent->paid_amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- recent order ends -->

                    <!-- line chart report starts -->
                    <!-- <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>
                                <div id="reportsChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Revenue',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div> -->
                    <!-- line chart report ends -->

                </div>
            </div> <!-- left side column ends -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Budget Report -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Check Customer <span>| Records</span></h5>
                        <select id="customer" class="js-select form-select check-customer" name="customer_id">
                            <option selected readonly>Choose customer</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->mobile
                                }}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="p-2 text-center" id="show-customer-record">
                            <h3 class="p-3">No Customer Choosen.</h3>
                        </div>
                    </div>
                </div><!-- End Budget Report -->

                <!-- Website Traffic -->
                <!-- <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                            value: 1048,
                                            name: 'Search Engine'
                                        },
                                        {
                                            value: 735,
                                            name: 'Direct'
                                        },
                                        {
                                            value: 580,
                                            name: 'Email'
                                        },
                                        {
                                            value: 484,
                                            name: 'Union Ads'
                                        },
                                        {
                                            value: 300,
                                            name: 'Video Ads'
                                        }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div> -->
                <!-- End Website Traffic -->
            </div><!-- End Right side columns -->
        </div>
    </section>
</main>
@endsection