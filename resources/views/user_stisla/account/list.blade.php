@extends('user_stisla.layout.layout')
@section('title',trans('admin.account_upgrade'))
@section('page')
    @if($User->category_id > 0 && $User->vip > time())
        <div class="alert alert-info" role="alert">
            <p class="mb-0">
                {{ trans('admin.you_are_currently_in_the_category') }}
                <b>"{!! $User->category->title ?? trans('admin.normal_user') !!}"</b>
                {{ trans('admin.you_are_up_to_date') }}
                <b>"{!! getJDateTimestamp($User->vip) !!}"</b>
              {{ trans('admin.you_have_credit') }}
            </p>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            <p class="mb-0">
                {{  trans('admin.you_are_currently_in_the_category') }}
                <b>"{!! trans('admin.normal_user') !!}"</b>
               @if(isRtl()){{ trans('admin.you_are') }}@endif
            </p>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-custom table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="250">{{ trans('admin.description') }}</th>
                    @foreach($list as $item)
                        <th class="text-center" style="background-color: {!! $item->icon ?? '' !!}">{!! $item->title ?? '' !!}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{ trans('admin.executive_fee') }}</td>
                @foreach($list as $item)
                    <th class="text-center">%{!! $item->commission ?? '0' !!}</th>
                @endforeach
            </tr>
            <tr>
                <td class="text-center">{{ trans('admin.simultaneous_projects') }}</td>
                @foreach($list as $item)
                    <th class="text-center">{!! $item->offer_synchronic ?? '0' !!}</th>
                @endforeach
            </tr>
            <tr>
                <td class="text-center">{{ trans('admin.offer_per_month') }}</td>
                @foreach($list as $item)
                    <th class="text-center">{!! $item->offer_month ?? '0' !!}</th>
                @endforeach
            </tr>
            <tr>
                <td class="text-center">{{ trans('admin.project_per_month') }}</td>
                @foreach($list as $item)
                    <th class="text-center">{!! $item->project_month ?? '0' !!}</th>
                @endforeach
            </tr>
            @if(lng() == 'fa' || lng() == 'ar')
            <tr>
                <td class="text-center">{{ trans('admin.SMS_commands') }}</td>
                @foreach($list as $item)
                    <th class="text-center">@if($item->sms == '1') <span class="la la-check" style="color: green"></span> @else <span class="la la-times" style="color: red"></span> @endif</th>
                @endforeach
            </tr>
            @endif
            <tr>
                <td class="text-center">{{ trans('admin.statistical_charts') }}</td>
                @foreach($list as $item)
                    <th class="text-center">@if($item->stat == '1') <span class="la la-check" style="color: green"></span> @else <span class="la la-times" style="color: red"></span> @endif</th>
                @endforeach
            </tr>
            <tr>
                <th class="text-center">{{ trans('admin.price') }}</th>
                @foreach($list as $item)
                    <th class="text-center">
                        @if($item->price > 0)
                            <b>{!! number_format($item->price) ?? 0 !!} {{ trans('admin.usd') }} </b>
                        @else
                            <b>{{ trans('admin.free') }}</b>
                        @endif
                    </th>
                @endforeach
            </tr>
            <tr>
                <th class="text-center">{{ trans('admin.upgrade') }}</th>
                @foreach($list as $item)
                    <th class="text-center">@if($item->price > 0)<a href="/user/account/add/{!! $item->id !!}" class="btn" style="background-color: {!! $item->icon ?? '' !!}">{{ trans('admin.upgrade') }}</a>@endif</th>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
@stop
