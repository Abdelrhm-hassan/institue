@extends('admin_stisla.layout.layout')
@section('title',trans('admin.documents'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{!! trans('admin.search') !!}</h4></div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label>{!! trans('admin.phone') !!}</label>
                            <input type="text" class="form-control" name="phone" value="{!! $_GET['phone'] ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-4">
                            <label>{!! trans('admin.name') !!}</label>
                            <input type="text" class="form-control" name="name" value="{!! $_GET['name'] ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-4">
                            <label>{!! trans('admin.type') !!}</label>
                            <select name="type" class="form-control custom-select">
                                @foreach($types as $type)
                                    <option @if(isset($_GET['type']) && $_GET['type'] == $type->name) selected @endif value="{!! $type->name ?? '' !!}">{!! $type->title ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{!! trans('admin.search') !!}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.explanation_of_the_document') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.mobile') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.name') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.type') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.project') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.amount') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td dir="ltr">{!! strip_tags($item->description) ?? '' !!}</td>
                            <td dir="ltr" class="text-center">{!! $item->user->phone ?? '' !!}</td>
                            <td class="text-center">{!! $item->user->name ?? '' !!}</td>
                            <td class="text-center">
                                @if($item->type == 'increase' || $item->type == 'add')
                                    <div class="badge badge-success">{{ trans('admin.deposit') }}</div>
                                @else
                                    <div class="badge badge-danger">{{ trans('admin.harvest') }}</div>
                                @endif
                            </td>
                            <td class="text-center">{!! $item->project->title ?? '-' !!}</td>
                            <td class="text-center">{!! number_format($item->amount) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
        @if($list->hasPages())
            <div class="card-footer text-center">
                {!! $list->links() !!}
            </div>
        @endif
    </div>
@stop
