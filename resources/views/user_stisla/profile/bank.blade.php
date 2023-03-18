@extends('user_stisla.layout.layout')
@section('title',trans('admin.bank_accounts'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>{{ trans('admin.registration_/_editing_of_bank_accounts') }}</h4>
        </div>
        <form method="post" @if(isset($edit)) action="/user/financial/bank/edit/store/{!! $edit->id !!}" @else action="/user/financial/bank/new/store" @endif>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <label>{{ trans('admin.Bank') }}</label>
                            <select name="bank_id" class="form-control custom-select">
                                @foreach($banks as $bank)
                                    <option value="{!! $bank->id !!}" @if(isset($edit) && $edit->bank_id == $bank->id) selected @endif>{!! $bank->title ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <label>{{ trans('admin.sheba_number') }}</label>
                            <input type="text" required class="form-control text-center" dir="ltr" name="shaba" value="{!! $edit->shaba ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.card_number') }}</label>
                            <input type="text" required class="form-control text-center" dir="ltr" name="card" value="{!! $edit->card ?? '' !!}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.Bank') }}</th>
                        <th class="text-center">{{ trans('admin.sheba') }}</th>
                        <th class="text-center">{{ trans('admin.card') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-center">{!! $item->bank->title ?? '-' !!}</td>
                            <td class="text-center">{!! $item->shaba ?? '-' !!}</td>
                            <td class="text-center">{!! $item->card ?? '' !!}</td>
                            <td class="text-center">{!! getMode('bank',$item->mode) ?? '' !!}</td>
                            <td class="text-center">
                                @if($item->mode == 'draft')
                                <a href="/user/financial/bank/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/user/financial/bank/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
