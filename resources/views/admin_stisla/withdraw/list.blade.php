@extends('admin_stisla.layout.layout')
@section('title',trans('admin.deposit_request'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{!! trans('admin.search') !!}</h4></div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>{{ trans('admin.Bank') }}</label>
                            <select name="bank_id" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                @foreach($banks as $bank)
                                    <option value="{!! $bank->id !!}" @if(isset($_GET['bank_id']) && $_GET['bank_id'] == $bank->id) selected @endif>{!! $bank->title ?? '-' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="request" @if(isset($_GET['mode']) && $_GET['mode'] == 'request') selected @endif>{{ trans('admin.applying_for') }}</option>
                                <option value="process" @if(isset($_GET['mode']) && $_GET['mode'] == 'process') selected @endif>{{ trans('admin.draft') }}</option>
                                <option value="done" @if(isset($_GET['mode']) && $_GET['mode'] == 'done') selected @endif>{{ trans('admin.deposit') }}</option>
                                <option value="reject" @if(isset($_GET['mode']) && $_GET['mode'] == 'reject') selected @endif>{{ trans('admin.reject_the_request') }}</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>{{ trans('admin.view_order') }}</label>
                            <select name="order" class="form-control custom-select">
                                <option value="new">{{ trans('admin.new_to_old') }}</option>
                                <option value="old" @if(isset($_GET['order']) && $_GET['order'] == 'old') selected @endif>{{ trans('admin.old_to_new') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" value="{!! trans('admin.search') !!}" class="btn btn-primary">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.user') }}</th>
                        <th class="text-center">{{ trans('admin.Bank') }}</th>
                        <th class="text-center">{{ trans('admin.requested_amount') }}</th>
                        <th class="text-center">{{ trans('admin.card') }}</th>
                        <th class="text-center">{{ trans('admin.depositable') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-center" title="{!! $item->user->email ?? '' !!}">{!! $item->user->name ?? '' !!}</td>
                            <td class="text-center">{!! $item->bank->bank->title ?? '-' !!}</td>
                            <td class="text-center">{!! number_format($item->amount) ?? 0 !!}</td>
                            <td class="text-center">{!! $item->bank->card ?? '-' !!}</td>
                            <td class="text-center">{!! number_format($item->user->credit) ?? 0 !!}</td>
                            <td class="text-center">{!! getMode('withdraw',$item->mode) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                @if($item->mode != 'reject')
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#action-{!! $item->id !!}"><i class="fas fa-wallet"></i></a>
                                @endif
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="action-{!! $item->id !!}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelTitleId"></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/admin/withdraw/action">
                                        <input type="hidden" name="id" value="{!! $item->id !!}">
                                        <input type="hidden" name="user_id" value="{!! $item->user_id !!}">
                                        <div class="modal-body">
                                            <div class="alert alert-warning" role="alert">
                                                <strong>{{ trans('admin.if_the_deposit_is_made,_use_the_registration_option_with_a_deduction_to_deduct_the_deposit_amount_from_the_user_account') }}</strong>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('admin.status') }}</label>
                                                <select name="mode" class="form-control custom-select">
                                                    <option value="request" @if($item->mode == 'request') selected @endif>{{ trans('admin.applying_for') }}</option>
                                                    <option value="process" @if($item->mode == 'process') selected @endif>{{ trans('admin.draft') }}</option>
                                                    <option value="done" @if($item->mode == 'done') selected @endif>{{ trans('admin.deposit') }}</option>
                                                    <option value="reject" @if($item->mode == 'reject') selected @endif>{{ trans('admin.reject_the_request') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('admin.description_to_the_user') }}</label>
                                                <textarea class="form-control" style="height: 200px;" rows="7">{!! $item->description ?? '' !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="save" class="btn btn-primary">{{ trans('admin.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
