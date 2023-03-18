@extends('admin_stisla.layout.layout')
@section('title',trans('admin.financial_settings'))
@section('page')
    <div class="alert alert-warning" role="alert">
        <strong>{{ trans('admin.attention') }}</strong>
        <span>{{ trans('admin.please_enter_the_information_of_each_port_accurately_and_without_spaces_through_the_env_file_in_the_root_folder') }}</span>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>
                    {{ trans('admin.banks_that_are_parties_to_the_contract_for_deposit') }}
                    </h4>
                </div>
                <div class="card-body">
                    <form method="post"  @if(isset($edit)) action="/admin/setting/bank/edit/store/{!! $edit->id !!}" @else action="/admin/setting/bank/store" @endif>
                        <div class="form-group">
                            <label>{{ trans('admin.bank_title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" @if(isset($edit)) value="{{ trans('admin.edit') }}" @else value="{{ trans('admin.added') }}" @endif>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <td>{{ trans('admin.bank_title') }}</td>
                                <td width="100" class="text-center">{{ trans('admin.management') }}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{!! $item->title ?? '' !!}</td>
                                    <td class="text-center">
                                        <a href="/admin/setting/bank/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                        <a class="delete-item" href="/admin/setting/bank/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.financial_settings') }}</h4>
                </div>
                <div class="card-body">
                    <form action="/admin/setting/store" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-12">
                                    <label>{{ trans('admin.select_default_payment_gateway') }}</label>
                                    <select class="form-control custom-select" name="default_gateway">
                                        @if(lng() == 'fa' || lng() == 'ar')
                                            <option value="zarinpal" @if(getOption('default_gateway') == 'zarinpal') selected @endif>{{ trans('admin.zarinpal') }}</option>
                                        @else
                                            <option value="paypal" @if(getOption('default_gateway') == 'paypal') selected @endif>{{ trans('admin.paypal') }}</option>
                                            <option value="stripe" @if(getOption('default_gateway') == 'stripe') selected @endif>Stripe</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.SMS_fee') }}</h4></div>
                <form method="post" action="/admin/setting/store">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label>{{ trans('admin.the_cost_of_each_SMS') }}</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="sms_price" value="{!! getOption('sms_price') !!}">
                                        <span class="input-group-append">
                                            <label class="input-group-text">{{ trans('admin.usd') }}</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>{{ trans('admin.number_of_characters_per_SMS') }}</label>
                                    <div class="input-group-append">
                                        <input class="form-control" name="sms_char_count" type="number" value="{!! getOption('sms_char_count') !!}">
                                        <span class="input-group-append"><label class="input-group-text">{{ trans('admin.character') }}</label></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
