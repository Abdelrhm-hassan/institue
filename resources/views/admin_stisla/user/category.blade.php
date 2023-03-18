@extends('admin_stisla.layout.layout')
@section('title',trans('admin.user_category'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header no-actions bordered"><h4>{{ trans('admin.user_category') }}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/user/group/edit/store/{!! $edit->id !!}" @else action="/admin/user/group/new/store" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{!! trans('admin.title') !!}</label>
                            <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.color') }}</label>
                            <input type="text" class="form-control text-center" dir="ltr" style="font-family: Arial !important;" name="icon" value="{!! $edit->icon ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.price') !!}</label>
                            <input type="number" class="form-control text-center" name="price" value="{!! $edit->price ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.discount_percentage_added_per_month') }}</label>
                            <input type="number" class="form-control text-center" name="discount" value="{!! $edit->discount ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.executive_fee_(%)') }}</label>
                            <input type="number" class="form-control text-center" name="commission" value="{!! $edit->commission ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.simultaneous_offer_(executor)') }}</label>
                            <input type="number" class="form-control text-center" name="offer_synchronic" value="{!! $edit->offer_synchronic ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.offer_per_month') }}</label>
                            <input type="number" class="form-control text-center" name="offer_month" value="{!! $edit->offer_month ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.project_per_month') }}</label>
                            <input type="number" class="form-control text-center" name="project_month" value="{!! $edit->project_month ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.order') }}</label>
                            <input type="number" class="form-control text-center" name="sort" value="{!! $edit->sort ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" name="sms" value="0">
                                    <input type="checkbox" name="sms" value="1" @if(isset($edit) && $edit->sms == 1) checked @endif>&nbsp;{{ trans('admin.SMS') }}
                                </div>
                                <div class="col-6">
                                    <input type="hidden" name="stat" value="0">
                                    <input type="checkbox" name="stat" value="1" @if(isset($edit) && $edit->stat == 1) checked @endif>&nbsp;{{ trans('admin.statistical_chart') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card has-shadow">
                <div class="card-header no-actions bordered"><h4>{{ trans('admin.list') }}</h4></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 p-0">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.title') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.project_per_month') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.offer_per_month') }}</th>
                                <th class="text-center" width="100">{{ trans('admin.wage') }}</th>
                                <th class="text-center" width="100">{{ trans('admin.price') }}</th>
                                <th class="text-center" width="150">{!! trans('admin.management') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{!! $item->title ?? '-' !!}</td>
                                    <td class="text-center">{!! $item->project_month ?? 0 !!}</td>
                                    <td class="text-center">{!! $item->offer_month ?? 0 !!}</td>
                                    <td class="text-center">%{!! $item->commission ?? 0 !!}</td>
                                    <td class="text-center">@if($item->price==0){{ trans('admin.free') }}@else{!! number_format($item->price) ?? 0 !!}@endif</td>
                                    <td class="text-center">
                                        <a href="/admin/user/group/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                        <a class="delete-item" href="/admin/user/group/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
