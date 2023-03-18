@extends('admin_stisla.layout.layout')
@section('title',trans('admin.manage_SMS_templates'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.SMS_registration') }}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/setting/sms/edit/store/{{{ $edit->id }}}" @else action="/admin/setting/sms/new/store" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.code') }}</label>
                            <input type="text" class="form-control text-right" dir="ltr" name="type" value="{{ $edit->type ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.text') }}</label>
                            <textarea class="form-control" style="height: 200px;" name="text" rows="5">{{ $edit->text ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{{ trans('admin.save') }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="card has-shadow">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.text') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.code') }}</th>
                                <th class="text-center" width="100">{{ trans('admin.management') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->text ?? '' }}</td>
                                    <td class="text-center">{{ $item->type ?? '' }}</td>
                                    <td class="text-center">
                                        <a href="/admin/setting/sms/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                        <a class="delete-item" href="/admin/setting/sms/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
