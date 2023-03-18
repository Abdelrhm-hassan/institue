@extends('admin_stisla.layout.layout')
@section('title',trans('admin.bank_accounts'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{!! trans('admin.search') !!}</h4></div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="request" @if(isset($_GET['mode']) && $_GET['mode'] == 'draft') selected @endif>{{ trans('admin.draft') }}</option>
                                <option value="process" @if(isset($_GET['mode']) && $_GET['mode'] == 'publish') selected @endif>{{ trans('admin.draft') }}</option>
                                <option value="reject" @if(isset($_GET['mode']) && $_GET['mode'] == 'reject') selected @endif>{{ trans('admin.reject_the_request') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
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
                        <th class="text-center">{{ trans('admin.card') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-center" title="{!! $item->user->email ?? '' !!}">{!! $item->user->name ?? '' !!}</td>
                            <td class="text-center">{!! $item->bank->title ?? '-' !!}</td>
                            <td class="text-center">{!! $item->card ?? '-' !!}</td>
                            <td class="text-center">{!! getMode('bank',$item->mode) !!}</td>
                            <td class="text-center">
                                <a href="/admin/bank/reject/{{ $item->id }}"><i class="fas fa-times-circle" style="color: red"></i></a>
                                <a href="/admin/bank/accept/{{ $item->id }}"><i class="fas fa-check-circle" style="color: green"></i></a>
                            </td>
                        </tr>
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
