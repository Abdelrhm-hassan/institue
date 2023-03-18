@extends('user_stisla.layout.layout')
@section('title',trans('admin.wallet'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.increase_wallet_inventory') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="/user/financial/wallet/pay">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" placeholder="{{ trans('admin.usd') }}" class="form-control" name="amount">
                                <span class="input-group-append">
                                    <label class="input-group-text">{{ trans('admin.usd') }}</label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{{ trans('admin.the_payment') }}">
                        </div>
                        <div style="height: 2px;"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.wallet_balance') }}</h4>
                </div>
                <div class="card-body">
                    <div class="py-4 text-center">
                        <h1 style="color: green;">{!! number_format($User->credit) ?? 0 !!}</h1>
                        <h5>{{ trans('admin.usd') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(lng() == 'fa')
        <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.increase_SMS_account_balance') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="/user/financial/sms/pay">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" placeholder="{{ trans('admin.usd') }}" class="form-control" name="amount">
                                <span class="input-group-append">
                                    <label class="input-group-text">{{ trans('admin.usd') }}</label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{{ trans('admin.the_payment') }}">
                        </div>
                        <div style="height: 2px;"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.SMS_panel_inventory') }}</h4>
                </div>
                <div class="card-body">
                    <div class="py-4 text-center">
                        <h1 style="color: green;">{!! number_format($User->sms_credit) ?? 0 !!}</h1>
                        <h5>{{ trans('admin.usd') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.Transfer_funds_from_wallet_to_SMS_wallet') }}</h4></div>
                <div class="card-body">
                    <form method="post" action="/user/financial/wallet/transfer">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" placeholder="{{ trans('admin.usd') }}" class="form-control text-center" dir="ltr" name="amount">
                                <span class="input-group-append">
                                    <label class="input-group-text">{{ trans('admin.usd') }}</label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{{ trans('admin.the_payment') }}">
                        </div>
                        <div style="height: 2px;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop
