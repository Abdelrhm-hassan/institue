@extends('admin_stisla.layout.layout')
@section('title',trans('admin.register_a_new_document'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.register_a_new_document') }}</h4></div>
                <form method="post" action="/admin/document/new/store">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.user') }}</label>
                            <select name="user_id" class="form-control selectpicker" data-live-search="true">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name ?? '' }} - {{ $user->phone ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label>{{ trans('admin.type') }}</label>
                                    <select name="type" class="form-control custom-select">
                                        <option value="increase">{{ trans('admin.deposit_to_account') }}</option>
                                        <option value="decrease">{{ trans('admin.withdraw_from_bank_account') }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>{{ trans('admin.amount') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-center" dir="ltr" name="amount">
                                        <span class="input-group-append"><span class="input-group-text">{{ trans('admin.usd') }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.transaction_description') }}</label>
                            <textarea class="summernote" rows="7" name="description"></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="submit" class="btn btn-primary" value="{{ trans('admin.save') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
