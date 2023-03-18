@extends('admin_stisla.layout.layout')
@section('title',trans('admin.the_report'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{!! trans('admin.search') !!}</h4></div>
        <form>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.reporter_user_email') }}</label>
                        <input type="email" name="email" dir="ltr" class="form-control text-right" value="{!! $_GET['email'] ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.chat_number') }}</label>
                        <input type="number" class="form-control" name="id" min="1" value="{!! $_GET['id'] ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.condition') }}</label>
                        <select name="mode" class="form-control">
                            <option value="">{{ trans('admin.all') }}</option>
                            <option value="request" @if(isset($_GET['mode']) && $_GET['mode'] == 'request') selected @endif>{{ trans('admin.applying_for') }}</option>
                            <option value="done" @if(isset($_GET['mode']) && $_GET['mode'] == 'done') selected @endif>{{ trans('admin.survey') }}</option>
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
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.chat_number') }}</th>
                        <th class="text-center">{{ trans('admin.reporter') }}</th>
                        <th class="text-center">{{ trans('admin.chat_users') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-center">{!! $item->chat_id ?? '' !!}</td>
                            <td class="text-center">{!! $item->reporter->name ?? '' !!}</td>
                            <td class="text-center">{!! getChatUsers($item->chat_id)['text'] !!}</td>
                            <td class="text-center">{!! getMode('chat',$item->mode) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#report_{!! $item->id !!}"><i class="fas fa-exchange"></i></a>
                                <a href="/admin/chat/report/view/{!! $item->chat_id ?? '' !!}" title="{{ trans('admin.view_chat') }}"><i class="fas fa-comment"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"><b style="color: red">{{ trans('admin.reason_for_violation') }}</b>&nbsp;&nbsp;{!! $item->description ?? '' !!}</td>
                        </tr>
                        <div class="modal fade" id="report_{!! $item->id !!}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelTitleId">{{ trans('admin.condition') }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/admin/chat/report/action">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{!! $item->id !!}">
                                                <label>{{ trans('admin.expert_Description') }}</label>
                                                <textarea class="form-control" name="result" rows="6">{!! $item->result ?? '' !!}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('admin.status') }}</label>
                                                <select name="mode" class="form-control">
                                                    <option value="request" @if($item->mode == 'request') selected @endif>{{ trans('admin.the_report') }}</option>
                                                    <option value="done" @if($item->mode == 'done') selected @endif>{{ trans('admin.survey') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">{{ trans('admin.record') }}</button>
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
