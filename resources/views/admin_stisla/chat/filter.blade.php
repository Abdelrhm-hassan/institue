@extends('admin_stisla.layout.layout')
@section('title',trans('admin.word_filter'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.filter') }}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/chat/filter/edit/store/{!! $edit->id !!}" @else action="/admin/chat/filter/new/store" @endif>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ trans('admin.phrase') }}</label>
                        <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
                </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.list') }}</h4></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.phrase') }}</th>
                                <th class="text-center" width="120">{!! trans('admin.management') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{!! $item->title ?? '' !!}</td>
                                    <td class="text-center">
                                        <a href="/admin/chat/filter/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                        <a class="delete-item" href="/admin/chat/filter/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
        </div>
    </div>
@stop
