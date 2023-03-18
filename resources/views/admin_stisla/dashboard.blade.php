@extends('admin_stisla.layout.layout')
@section('title',trans('admin.dashboard'))
@section('page')

       
      
    <div class="row mt-4">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions d-flex align-items-center">
                    <h4>{{ trans('admin.doctors') }}</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="count-animate" style="padding-top: 18px;padding-bottom: 18px;">{!! $count['doctor'] ?? '0' !!}</h1>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions d-flex align-items-center">
                    <h4>{{ trans('admin.total_managers') }}</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="count-animate" style="padding-top: 18px;padding-bottom: 18px;">{!! $count['admin'] ?? 0 !!}</h1>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions d-flex align-items-center">
                    <h4>{{ trans('admin.students') }}</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="count-animate" style="padding-top: 18px;padding-bottom: 18px;">{!! $count['student'] ?? 0 !!}</h1>
                </div>
            </div>
        </div>
    </div>
     <div class="row mt-4">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions d-flex align-items-center">
                    <h4>{{ trans('admin.subject') }}</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="count-animate" style="padding-top: 18px;padding-bottom: 18px;">{!! $count['subject'] ?? '0' !!}</h1>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions d-flex align-items-center">
                    <h4>{{ trans('admin.class_room') }}</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="count-animate" style="padding-top: 18px;padding-bottom: 18px;">{!! $count['classroom'] ?? 0 !!}</h1>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions d-flex align-items-center">
                    <h4>{{ trans('admin.all_accident') }}</h4>
                </div>
                <div class="card-body text-center">
                    <h1 class="count-animate" style="padding-top: 18px;padding-bottom: 18px;">{!! $count['project'] ?? 0 !!}</h1>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="card has-shadow mt-4">-->
    <!--    <div class="card-header bordered no-actions d-flex align-items-center">-->
    <!--        <h4>{{ trans('admin.users_of_the_last_eight_days') }}</h4>-->
    <!--    </div>-->
    <!--    <div class="card-body">-->
    <!--        <div class="chart">-->
    <!--            <canvas id="users-ten-days"></canvas>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
@endsection
@section('script')
    <script src="/assets/admin/vendors/js/chart/chart.min.js"></script>
    <script>
        $(function () {
            var ctx = document.getElementById('users-ten-days').getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['{!! getDateByNum(7) !!}','{!! getDateByNum(6) !!}','{!! getDateByNum(5) !!}','{!! getDateByNum(4) !!}','{!! getDateByNum(3) !!}','{!! getDateByNum(2) !!}','{!! getDateByNum(1) !!}','{!! getDateByNum(0) !!}'],
                    datasets: [{
                        label: "{{ trans('admin.user') }}",
                        borderColor: "#08a6c3",
                        pointBackgroundColor: "#08a6c3",
                        pointHoverBorderColor: "#08a6c3",
                        pointHoverBackgroundColor: "#08a6c3",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        fill: true,
                        backgroundColor: "transparent",
                        borderWidth: 3,
                        data: ['{!! userCountByDay(7) !!}','{!! userCountByDay(6) !!}','{!! userCountByDay(5) !!}','{!! userCountByDay(4) !!}','{!! userCountByDay(3) !!}','{!! userCountByDay(2) !!}','{!! userCountByDay(1) !!}','{!! userCountByDay(0) !!}']
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: 'rgba(47, 49, 66, 0.8)',
                        titleFontSize: 13,
                        titleFontColor: '#fff',
                        caretSize: 0,
                        cornerRadius: 4,
                        xPadding: 10,
                        displayColors: false,
                        yPadding: 10
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                display: true,
                                beginAtZero: true
                            },
                            gridLines: {
                                drawBorder: true,
                                display: true
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                drawBorder: true,
                                display: true
                            },
                            ticks: {
                                display: true
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
