@extends('user_stisla.layout.layout')
@section('title',trans('admin.transactions'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.display_filter') }}</h4>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="paid" @if(isset($_GET['mode']) && $_GET['mode'] == 'paid') selected @endif>{{ trans('admin.paid') }}</option>
                                <option value="waiting" @if(isset($_GET['mode']) && $_GET['mode'] == 'waiting') selected @endif>{{ trans('admin.waiting_for_payment') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                            <label>{{ trans('admin.type') }}</label>
                            <select name="type" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="plan"   @if(isset($_GET['type']) && $_GET['type'] == 'plan') selected @endif>{{ trans('admin.buy_a_plan') }}</option>
                                <option value="credit" @if(isset($_GET['type']) && $_GET['type'] == 'credit') selected @endif>{{ trans('admin.increase_credit') }}</option>
                                <option value="factor" @if(isset($_GET['type']) && $_GET['type'] == 'factor') selected @endif>{{ trans('admin.invoice_payment') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                            <label>{{ trans('admin.view_order') }}</label>
                            <select name="order" class="form-control custom-select">
                                <option value="new">{{ trans('admin.new_to_old') }}</option>
                                <option value="old">{{ trans('admin.old_to_new') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.search') }}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.list_of_transactions') }}</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.explanation') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.amount') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.gateway') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.status') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.date') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! number_format($item->amount) ?? '-' !!}</td>
                            <td class="text-center">{!! gateWay($item->gateway) !!}</td>
                            <td class="text-center">{!! getMode('transaction', $item->mode) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#details-{!! $item->id !!}" title="{{ trans('admin.show_details') }}"><i class="fas fa-dice-three"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="details-{!! $item->id !!}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header"><h5>{{ trans('admin.payment_details') }}</h5></div>
                                    <div class="modal-body">
                                        <span>{{ trans('admin.payment_type') }}:</span>&nbsp;&nbsp;<label style="color: #0f74a8">{!! $item->title ?? '' !!}</label>
                                        <div class="pt-4"></div>
                                        @if($item->type == 'plan')
                                            <span>{{ trans('admin.plan') }}</span>&nbsp;&nbsp;<label style="color: #0f74a8">{!! $item->plan->title ?? '' !!}</label>
                                            <div class="pt-4"></div>
                                        @endif
                                        <span>{{ trans('admin.payment_gateway:') }}</span>&nbsp;&nbsp;<label style="color: #0f74a8">{!! gateWay($item->gateway) !!}</label>
                                        <div class="pt-4"></div>
                                        <span>{{ trans('admin.ref_code') }}</span>&nbsp;&nbsp;<label style="color: #0f74a8">{!! $item->ref ?? '-' !!}</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.exit') }}</button>
                                    </div>
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
