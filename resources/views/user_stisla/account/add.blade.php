@extends('user_stisla.layout.layout')
@section('title',trans('admin.purchase'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>{!! $plan->title ?? '' !!}</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.executive_fee') }}</th>
                        <th class="text-center">{{ trans('admin.simultaneous_projects') }}</th>
                        <th class="text-center">{{ trans('admin.offer_per_month') }}</th>
                        <th class="text-center">{{ trans('admin.project_per_month') }}</th>
                        @if(lng() == 'fa' || lng() == 'ar')<th class="text-center">{{ trans('admin.SMS_commands') }}</th>@endif
                        <th class="text-center">{{ trans('admin.statistical_charts') }}</th>
                        <th class="text-center">{{ trans('admin.price') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">%{!! $plan->commission ?? 0 !!}</td>
                        <td class="text-center">{!! $plan->offer_synchronic ?? 0 !!}</td>
                        <td class="text-center">{!! $plan->offer_month ?? 0 !!}</td>
                        <td class="text-center">{!! $plan->project_month ?? 0 !!}</td>
                        @if(lng() == 'fa' || lng() == 'ar')<td class="text-center">@if($plan->sms == '1') <span class="la la-check" style="color: green"></span> @else <span class="la la-times" style="color: red"></span> @endif</td>@endif
                        <td class="text-center">@if($plan->charts == '1') <span class="la la-check" style="color: green"></span> @else <span class="la la-times" style="color: red"></span> @endif</td>
                        <td class="text-center">{!! number_format($plan->price) ?? 0 !!}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.purchase') }}</h4>
                </div>
                <form method="post" action="/user/account/pay">
                    <input type="hidden" name="plan_id" value="{!! $plan->id !!}">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.Validity_time') }}</label>
                            <select name="expire" id="expire" class="form-control">
                                @for($i=1;$i<=12;$i++)
                                    <option data-price="{!! number_format(($plan->price * $i) - (($i -1) * ($plan->discount/100) * $plan->price)) !!}" data-expire="@if(lng() == 'fa'){!! jdate('Y/m/d',($i * 30 * 86400) + time()) !!}@else{!! date('Y/m/d',($i * 30 * 86400) + time()) !!}@endif" value="{!! $i !!}">{!! $i !!} {{ trans('admin.month') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="text-center py-4">
                            <h1 style="color: green" id="price-holder">{!! number_format($plan->price) ?? 0 !!}</h1>
                            <span style="color: green;">{{ trans('admin.usd') }}</span>
                        </div>
                        <div class="text-center">
                            <span style="color: blue">{{ trans('admin.Validity_period_until_date') }}</span>
                            <span id="date-holder" style="color: green">@if(lng() == 'fa'){!! jdate('Y/m/d',time() + (86400 * 30)) !!}@else{!! date('Y/m/d',time() + (86400 * 30)) !!}@endif</span>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="submit" class="btn btn-primary" value="{{ trans('admin.the_payment') }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-7">
            @if($plan->discount > 0)
                <div class="alert alert-info" role="alert">
                    <span>{{ trans('admin.Included_for_each_additional_month_purchase') }}</span>
                    <b style="color: orange;">{!! $plan->discount ?? 0 !!}</b>
                    <span>{{ trans('admin.You_get_a_percentage_discount') }}</span>
                </div>
            @endif
        </div>
    </div>
@stop
@section('script')
    <script>
        $('#expire').on('change', function (){
           var price = $(this).find('option:selected').attr('data-price');
           var date = $(this).find('option:selected').attr('data-expire');
           $('#price-holder').text(price);
           $('#date-holder').text(date);
        });
    </script>
@stop
