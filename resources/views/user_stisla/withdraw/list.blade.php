@extends('user_stisla.layout.layout')
@section('title',trans('admin.deposit_income'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.credit_statistics') }}</h4></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <span>{{ trans('admin.wallet_balance') }}</span>
                            <div class="h-10" style="height: 10px;"></div>
                            <b style="color: green">{!! number_format($User->wallet) ?? 0 !!}</b>
                            <sub style="color: green">{{ trans('admin.usd') }}</sub>
                        </div>
                        <div class="col-4 text-center">
                            <span>{{ trans('admin.removable_income') }}</span>
                            <div class="h-10" style="height: 10px;"></div>
                            <b style="color: green">{!! number_format($User->credit) ?? 0 !!}</b>
                            <sub style="color: green">{{ trans('admin.usd') }}</sub>
                        </div>
                        <div class="col-4 text-center">
                            <span>{{ trans('admin.the_minimum_amount_that_can_be_withdrawn') }}</span>
                            <div class="h-10" style="height: 10px;"></div>
                            <b style="color: green">{!! number_format(getOption('minimum_payout',0)) ?? 0 !!}</b>
                            <sub style="color: green">{{ trans('admin.usd') }}</sub>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.access') }}</h4></div>
                <div class="card-body">
                    <div class="pt-3"></div>
                    <div class="row">
                        <div class="col-6 text-center">
                            <a href="/user/financial/bank" class="btn btn-warning">{{ trans('admin.register_account_number') }}</a>
                        </div>
                        <div class="col-6 text-center">
                            <button data-toggle="modal" @if(count($banks) == 0) data-target="#no_bank" @else data-target="#order" @endif class="btn btn-primary">{{ trans('admin.submit_a_deposit_request') }}</button>
                        </div>
                    </div>
                    <div class="pt-3"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.list_of_deposit_requests') }}</h4></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.Bank') }}</th>
                        <th class="text-center">{{ trans('admin.sheba') }}</th>
                        <th class="text-center">{{ trans('admin.card') }}</th>
                        <th class="text-center">{{ trans('admin.amount') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-center">{!! $item->bank->bank->title ?? '-' !!}</td>
                            <td class="text-center">{!! $item->bank->shaba ?? '-' !!}</td>
                            <td class="text-center">{!! $item->bank->card ?? '-' !!}</td>
                            <td class="text-center">{!! number_format($item->amount) ?? '0' !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">{!! getMode('withdraw',$item->mode) !!}</td>
                            <td class="text-center">
                                @if($item->mode == 'request')
                                    <a class="delete-item" href="/admin/financial/withdraw/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="no_bank" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ trans('admin.you_have_not_registered_any_account_number_for_depositing_income_at_the_moment.Please_register_an_account_number_through_the_link_below') }}</p>
                    <div class="text-center">
                        <a href="/user/financial/bank" class="btn btn-warning">{{ trans('admin.register_account_number') }}</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.exit') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">{{ trans('admin.submit_a_deposit_request') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/user/financial/withdraw/new/store">
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('admin.bank_selection') }}</label>
                        <select name="bank_id" class="form-control" required>
                            @foreach($banks as $bank)
                                @if($bank->mode == 'publish')
                                <option value="{!! $bank->id ?? '' !!}">{!! $bank->bank->title ?? '' !!} - {!! $bank->shaba ?? '-' !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.amount') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control text-center" name="amount" value="{!! $User->credit ?? '' !!}">
                            <span class="input-group-append">
                                <span class="input-group-text">{{ trans('admin.usd') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('admin.submit_a_request') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop
