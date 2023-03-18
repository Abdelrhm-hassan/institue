@extends('user_stisla.layout.layout')
@section('title',trans('admin.transactions'))
@section('page')
    <style>
        @media (max-width: 1370px){
            .responsive_text{
                font-size: .9em;
            }
        }
    </style>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.general_credit_statistics') }}</h4></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 text-center" style="color: green;">
                            <span>{{ trans('admin.total_validity') }}</span>
                            <div class="py-2" style="font-size: 1.2em;">
                                <label>{!! number_format($User->credit + $User->wallet) !!}</label>&nbsp;<sub>{{ trans('admin.usd') }}</sub>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 text-center" style="color: red;">
                            <span>{{ trans('admin.mortgage_amount') }}</span>
                            <div class="py-2" style="font-size: 1.2em;">
                                <label>{!! getUserPledgeAmount($User->id) !!}</label>&nbsp;<sub>{{ trans('admin.usd') }}</sub>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 text-center" style="color: blue;">
                            <span>{{ trans('admin.removable') }}</span>
                            <div class="py-2" style="font-size: 1.2em;">
                                <label>{!! number_format($User->credit) !!}</label>&nbsp;<sub>{{ trans('admin.usd') }}</sub>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card has-shadow">
                        <div class="card-body" style="background-color: #0F6FD5;color: white">
                            <span>{{ trans('admin.total_revenue') }}</span>
                            <div class="py-2 text-right">
                                {!! number_format($report['income']['total']) ?? 0 !!}&nbsp;<sub>{{ trans('admin.usd') }}</sub>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card has-shadow" style="background-color: #0F6FD5;color: white">
                        <div class="card-body">
                            <span>{{ trans('admin.earn_today') }}</span>
                            <div class="py-2 text-right">
                                {!! number_format($report['income']['today']) ?? 0 !!}&nbsp;<sub>{{ trans('admin.usd') }}</sub>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card has-shadow" style="background-color: #0F6FD5;color: white">
                        <div class="card-body">
                            <span class="responsive_text">{{ trans('admin.monthly_income') }}</span>
                            <div class="py-2 text-right">
                                {!! number_format($report['income']['month']) ?? 0 !!}&nbsp;<sub>{{ trans('admin.usd') }}</sub>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.earnings_chart_for_the_last_6_days') }}</h4></div>
                <div class="card-body p-1" @if(!isMobile()) style="height: 238px;" @endif>
                    <canvas id="income-six-days" @if(isMobile()) height="200" @else height="90" @endif></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.search_financial_documents') }}</h4></div>
        <form>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.type_of_document') }}</label>
                        <select name="name" class="form-control custom-select">
                            <option value="">{!! trans('admin.all') !!}</option>
                            @foreach($types as $type)
                                <option value="{{ $type->name ?? '' }}" @if(isset($_GET['name']) && $_GET['name'] == $type->name) selected @endif>{{ $type->description ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mt-3 mt-md-0">
                        <label>{{ trans('admin.document_status') }}</label>
                        <select name="mode" class="form-control custom-select">
                            <option value="">{!! trans('admin.all') !!}</option>
                            <option value="add" @if(isset($_GET['mode']) && $_GET['mode'] == 'add') selected @endif>{{ trans('admin.increase') }}</option>
                            <option value="minus" @if(isset($_GET['mode']) && $_GET['mode'] == 'minus') selected @endif>{{ trans('admin.decrease') }}</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mt-3 mt-md-0">
                        <label>{{ trans('admin.view_order') }}</label>
                        <select name="order" class="form-control custom-select">
                            <option value="new">{{ trans('admin.new_to_old') }}</option>
                            <option value="old" @if(isset($_GET['order']) && $_GET['order'] == 'old') selected @endif>{{ trans('admin.old_to_new') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="{!! trans('admin.search') !!}">
        </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.description') }}</th>
                        <th class="text-center">{{ trans('admin.project') }}</th>
                        <th class="text-center">{{ trans('admin.amount') }}&nbsp;<sub>{{ trans('admin.(usd)') }}</sub></th>
                        <th class="text-center">{{ trans('admin.document_status') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->description ?? '-' !!}</td>
                            <td class="text-center"><a href="/user/project/details/{{ $item->project_id ?? '' }}">{!! $item->project->title ?? '-' !!}</a></td>
                            <td class="text-center">{!! number_format($item->amount) ?? 0 !!}</td>
                            <td class="text-center">
                                @if($item->type == 'add' || $item->type == 'increase')
                                    <span class="badge badge-success">{{ trans('admin.increase') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ trans('admin.decrease') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {!! getJDate($item->created_at) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($list->hasPages())
            <div class="card-footer text-center">
                {!! $list->links() !!}
            </div>
        @endif
    </div>
@stop
@section('script')
    <script src="/assets/admin/vendors/js/chart/chart.min.js"></script>
    <script>
        $(function () {
            var ctx = document.getElementById('income-six-days').getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['{!! getDateByNum(5) !!}','{!! getDateByNum(4) !!}','{!! getDateByNum(3) !!}','{!! getDateByNum(2) !!}','{!! getDateByNum(1) !!}','{!! getDateByNum(0) !!}'],
                    datasets: [{
                        label: "{{ trans('admin.income') }}",
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
                        data: [{!! getUserIncomeDay($User->id,5) !!},{!! getUserIncomeDay($User->id,4) !!},{!! getUserIncomeDay($User->id,3) !!},{!! getUserIncomeDay($User->id,2) !!},{!! getUserIncomeDay($User->id,1) !!},{!! getUserIncomeDay($User->id,0) !!}]
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
@stop
