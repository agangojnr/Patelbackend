@extends('layouts.app')

@section('content')
<div class="header bg-info pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0"> Community Members</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$user}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0"> Mobile App Users</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$appuser}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Pending Applications</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$pending}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fa fa-address-card"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Assistance Request</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$pendingreq}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card bg-gradient-secondary shadow">

                <!-- Chart -->
                <div class="card-body analytics-info">
                    <div id="basic-pie" style="height:400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0 text-white">Indian Native (Home Vilage)</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body text-white">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Vilage Name')}}</th>
                                    <th>{{__('No.')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($natives) > 0)
                                    @foreach ($natives as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{App\Native::where('native_id',$item->native)->value('native_name')}}</td>
                                        <td>{{$item->total}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-12 mb-5  mb-3">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Memebrship Applications</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('application.index')}}" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-4">

            <div class="card bg-gradient-warning mb-3">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0 text-white">Featured Ads</h5>
                            <span class="h2 font-weight-bold mb-0 text-white">{{$nofeatured}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                <i class="fab fa-adversal"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-xl-4">
            <div class="card bg-gradient-primary mb-3">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0 text-white">Running Announcement?</h5>
                            @if ($activeann=='yes')
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif

                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-xl-4">
            <div class="card bg-gradient-danger mb-3">

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0 text-white">Active Ads</h5>
                            <span class="h2 font-weight-bold mb-0 text-white">{{$noactive}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                <i class="fa fa-briefcase"></i>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<!-- This Page JS -->
<script src="{{ asset('assets/libs/echarts/dist/echarts-en.min.js') }}"></script>


<script src="{{ asset('dist/js/pages/chartjs/chartjs.init.js') }}"></script>
<script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js') }}"></script>

<script>
    $(function() {
    "use strict";
    // based on prepared DOM, initialize echarts instance
        var basicpieChart = echarts.init(document.getElementById('basic-pie'));
        var towns = <?php echo $towns; ?>;
        var totals = <?php echo $totals; ?>;
        var townstotal = <?php echo $townstotal; ?>;
        console.log(townstotal);
        var option = {
            // Add title
                title: {
                    text: 'MEMBERSHIP DISTRIBUTION',
                    //subtext: 'Open source information',
                    x: 'center'
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: towns//['IE', 'Opera', 'Safari', 'Firefox', 'Test']
                },

                // Add custom colors
                color: ['#ffbc34', '#00acc1', '#212529', '#f62d51', '#1e88e5'],

                // Display toolbox
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    feature: {
                        mark: {
                            show: true,
                            title: {
                                mark: 'Markline switch',
                                markUndo: 'Undo markline',
                                markClear: 'Clear markline'
                            }
                        },
                        dataView: {
                            show: true,
                            readOnly: false,
                            title: 'View data',
                            lang: ['View chart data', 'Close', 'Update']
                        },
                        magicType: {
                            show: true,
                            title: {
                                pie: 'Switch to pies',
                                funnel: 'Switch to funnel',
                            },
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    y: '20%',
                                    width: '50%',
                                    height: '70%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore: {
                            show: true,
                            title: 'Restore'
                        },
                        saveAsImage: {
                            show: true,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                // Enable drag recalculate
                calculable: true,

                // Add series
                series: [{
                    name: 'Browsers',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    data: townstotal
                    /*[
                        {value: 335, name: 'IE'},
                        {value: 310, name: 'Opera'},
                        {value: 234, name: 'Safari'},
                        {value: 135, name: 'Firefox'},
                        {value: 1548, name: 'Test'}
                    ]*/
                }]
        };

        basicpieChart.setOption(option);
    });
</script>
@endpush
