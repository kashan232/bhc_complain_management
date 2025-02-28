@include('admin.include.main_header')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<style>
    #map {
        width: 100%;
        height: 400px;
    }

    .list-group-item {
        padding: 5px 8px !important;
    }
</style>
<div id="main-wrapper">
    @include('admin.include.header')
    @include('admin.include.navbar')
    @include('admin.include.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row text-center mt-3 mb-3">
                <div class="col-12">
                    <h2 style="font-weight: bold; padding: 10px 0; color: #1b6131;">Benazir Hari Card</h2>
                </div>
            </div>

            <div class="row">
                @php
                $cards = [
                ['route' => 'all-District', 'icon' => 'fas fa-building', 'title' => 'Total District', 'count' => $districtCount, 'color' => '#DFF6E4'],
                ['route' => 'all-Talukas', 'icon' => 'fas fa-city', 'title' => 'Total Taluka', 'count' => $tehsilCount, 'color' => '#FCE1F3'],
                ['route' => 'all-complaints', 'icon' => 'fas fa-phone-alt', 'title' => 'Total Complaints', 'count' => $totalComplains, 'color' => '#FFEFD5'],
                ['route' => 'closed-complaints', 'icon' => 'fas fa-check-circle', 'title' => 'Closed Complaints', 'count' => $ClosedComplains, 'color' => '#E1ECFF'],
                ['route' => 'in-process-complaints', 'icon' => 'fas fa-spinner', 'title' => 'In-Progress Complaints', 'count' => $InProcessComplains, 'color' => '#F6FDC3'],
                ['route' => 'not-process-complaints', 'icon' => 'fas fa-times', 'title' => 'Un-Resolved Complaints', 'count' => $NotProcessComplains, 'color' => '#FFE5D9'],
                ];
                @endphp

                @foreach($cards as $card)
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="{{ route($card['route']) }}" style="text-decoration: none;">
                        <div class="card text-dark shadow-sm" style="background: {{ $card['color'] }}; border-radius: 12px; transition: transform 0.3s ease;">
                            <div class="card-body text-center py-4">
                                <span class="d-block mb-2" style="font-size: 2rem; color: #333;">
                                    <i class="{{ $card['icon'] }}"></i>
                                </span>
                                <p class="mb-1 font-weight-bold" style="font-size: 1.1rem; color: #555;">{{ $card['title'] }}</p>
                                <h4 class="mb-0 font-weight-bold" style="color: #222;">{{ $card['count'] }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <style>
                .card {
                    border: none;
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                }

                .card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.15);
                }
            </style>

            <div class="row mt-4 mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <canvas id="complaintsChart" width="600" height="500"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-info">
                        <div class="text-center pt-3 pb-3 w-100 bg-dark">
                            <h3 class="text-white mb-0">Districts</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        @foreach($districts as $index => $district)
                                        @if($index % 2 == 0)
                                        <li class="list-group-item district-link" style="font-size: 12px;">
                                            <a href="#" data-district-name="{{ $district->district_name }}">{{ $district->district_name }}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <ul class="list-group">
                                        @foreach($districts as $index => $district)
                                        @if($index % 2 != 0)
                                        <li class="list-group-item district-link" style="font-size: 12px;">
                                            <a href="#" data-district-name="{{ $district->district_name }}">{{ $district->district_name }}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-12 text-center mt-2">
                                    <a href="#" class="btn btn-dark btn-sm">See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="map"></div>
                </div>
            </div>

        </div>
    </div>
    @include('admin.include.powerd_by')
</div>
@include('admin.include.footer_links')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var cityLabels = [];
    var complaintData1 = []; // Number of complaints for each city - Type 1
    var complaintData2 = []; // Number of complaints for each city - Type 2
    var complaintData3 = [];

    var ctx = document.getElementById('complaintsChart').getContext('2d');

    var complaintsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: cityLabels,
            datasets: [{
                    label: 'Un-Resolved',
                    data: complaintData1,
                    backgroundColor: 'rgba(162, 47, 2, 1)',
                    borderColor: 'rgb(162, 47, 2, 1)',
                    borderWidth: 1
                },
                {
                    label: 'In-Progress',
                    data: complaintData2,
                    backgroundColor: 'rgba(139, 158, 1, 1)',
                    borderColor: 'rgb(139, 158, 1, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Closed',
                    data: complaintData3,
                    backgroundColor: 'rgba(0, 112, 236, 1)',
                    borderColor: 'rgb(0, 112, 236, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                x: {
                    type: 'category',
                },
                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    $(document).ready(function() {
        $('.district-link a').on('click', function(e) {
            e.preventDefault();

            var districtName = $(this).data('district-name');

            $.ajax({
                type: 'GET',
                url: '/home-chart',
                data: {
                    districtName: districtName
                },
                success: function(response) {
                    console.log(response);

                    // Update cityLabels with the district name from the response
                    cityLabels = [response.districtName];

                    // Update the chart data
                    complaintsChart.data.labels = cityLabels;
                    complaintsChart.update();

                    // Update the chart datasets with the counts from the response
                    complaintsChart.data.datasets[0].data = [response.notProcessCount];
                    complaintsChart.data.datasets[1].data = [response.inProcessCount];
                    complaintsChart.data.datasets[2].data = [response.closedCount];
                    complaintsChart.update();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>

<script>
    var map = L.map('map').setView([26.3862, 68.1903], 7); // Centered on Sindh

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var cities = {
        !!$districtsData!!
    };

    cities.forEach(cityData => {
        // Extract values from each cityData
        var name = cityData.district_name;
        var coordinates = cityData.coordinates.split(',').map(parseFloat); // Convert coordinates string to array
        var total = cityData.total;

        L.marker(coordinates).addTo(map)
            .bindPopup(`<b>${name}</b><br><b>${total}</b>`)
            .openPopup();
    });
</script>

<!-- <script> -->
<!-- // Function to update the chart data
    // function updateChartData(notProcessCount, inProcessCount, closedCount) {
    //     complaintsChart.data.datasets[0].data = [notProcessCount];
    //     complaintsChart.data.datasets[1].data = [inProcessCount];
    //     complaintsChart.data.datasets[2].data = [closedCount];
    //     complaintsChart.update();
    // }

    // $(document).ready(function() {
    //     $('.district-link a').on('click', function(e) {
    //         e.preventDefault();

    //         var districtName = $(this).data('district-name');

    //         $.ajax({
    //             type: 'GET',
    //             url: '/home-chart', // Adjust the URL based on your route configuration
    //             data: {
    //                 districtName: districtName
    //             },
    //             success: function(response) {
    //                 // Handle the success response
    //                 console.log(response);

    //                 cityLabels = [response.districtName];
    //                 // console.log(cityLabels);
    //                 // Assuming response.notProcessCount, response.inProcessCount, and response.closedCount contain the counts
    //                 updateChartData(response.notProcessCount, response.inProcessCount, response.closedCount);
    //             },
    //             error: function(error) {
    //                 // Handle the error response
    //                 console.error(error);
    //             }
    //         });
    //     });
    // });

    // var cityLabels = [""];
    // var complaintData1 = []; // Number of complaints for each city - Type 1
    // var complaintData2 = []; // Number of complaints for each city - Type 2
    // var complaintData3 = []; // Number of complaints for each city - Type 3

    // var ctx = document.getElementById('complaintsChart').getContext('2d');

    // var complaintsChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: cityLabels,
    //         datasets: [{
    //                 label: 'Not Process Complaints',
    //                 data: complaintData1,
    //                 backgroundColor: 'rgba(255, 99, 132, 1)',
    //                 borderColor: 'rgb(255, 99, 132)',
    //                 borderWidth: 1
    //             },
    //             {
    //                 label: 'In Process Complaints',
    //                 data: complaintData2,
    //                 backgroundColor: 'rgba(255, 255, 0, 1)',
    //                 borderColor: 'rgb(255, 255, 0)',
    //                 borderWidth: 1
    //             },
    //             {
    //                 label: 'Closed Complaints',
    //                 data: complaintData3,
    //                 backgroundColor: 'rgba(75, 192, 192, 1)',
    //                 borderColor: 'rgb(75, 192, 192)',
    //                 borderWidth: 1
    //             }
    //         ]
    //     },
    //     options: {
    //         scales: {
    //             x: {
    //                 type: 'category',
    //                 labels: cityLabels,
    //             },
    //             y: {
    //                 beginAtZero: true,
    //             }
    //         }
    //     }
    // }); -->
<!-- </script> -->





</body>

</html>