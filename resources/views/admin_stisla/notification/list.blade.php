@extends('admin_stisla.layout.layout')
@section('title',trans('admin.notification_list'))
@section('page')
    <div class="card has-shadow">
        <form>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label>{{ trans('admin.title') }}</label>
                        <input type="text" class="form-control" name="title" value="{!! $_GET['title'] ?? '' !!}">
                    </div>
                    <div class="col-6">
                        <label>{{ trans('admin.user_name') }}</label>
                        <input type="text" class="form-control" name="username" value="{!! $_GET['username'] ?? '' !!}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>{{ trans('admin.type') }}</label>
                        <select name="type" class="form-control custom-select">
                            <option value="">{{ trans('admin.all') }}</option>
                            <option value="alert" @if(isset($_GET['type']) && $_GET['type'] == 'alert') selected @endif>{{ trans('admin.announcement') }}</option>
                            <option value="email" @if(isset($_GET['type']) && $_GET['type'] == 'email') selected @endif>{{ trans('admin.email') }}</option>
                            <option value="sms" @if(isset($_GET['type']) && $_GET['type'] == 'sms') selected @endif>{{ trans('admin.SMS') }}</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>{{ trans('admin.status') }}</label>
                        <select name="mode" class="form-control custom-select">
                            <option value="">{{ trans('admin.all') }}</option>
                            <option value="send" @if(isset($_GET['mode']) && $_GET['mode'] == 'send') selected @endif>{{ trans('admin.send') }}</option>
                            <option value="viewed" @if(isset($_GET['mode']) && $_GET['mode'] == 'viewed') selected @endif>{{ trans('admin.observed') }}</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>{{ trans('admin.sender') }}</label>
                        <select name="sender" class="form-control custom-select">
                            <option value="">{{ trans('admin.all') }}</option>
                            <option value="auto" @if(isset($_GET['sender']) && $_GET['sender'] == 'auto') selected @endif>{{ trans('admin.system') }}</option>
                            <option value="admin" @if(isset($_GET['sender']) && $_GET['sender'] == 'admin') selected @endif>{{ trans('admin.the_manager') }}</option>
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
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.title') }}</th>
                        <th class="text-center">{{ trans('admin.user') }}</th>
                        <th class="text-center">{{ trans('admin.receiver') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->title ?? '' !!}</td>
                            @if ($item->type=='admin')
                            <td class="text-center">@if($item->user_id == 0){{ trans('admin.all_users') }}@else {{$item->admins->name }}@endif</td>
                            @endif
                            @if ($item->type=='doctor')
                            <td class="text-center">@if($item->user_id == 0){{ trans('admin.all_users') }}@else {{$item->students->name }}@endif</td>
                            @endif
                            @if ($item->type=='student')
                            <td class="text-center">@if($item->user_id == 0){{ trans('admin.all_users') }}@else {{$item->students->name }}@endif</td>
                            @endif
                            <td class="text-center">{!!$item->type !!}</td>
                            <td class="text-center">
                                @if($item->view == 0)
                                    <span class="badge badge-warning">{{ trans('admin.have_not_been_seen') }}</span>
                                @else
                                    <span class="badge badge-success">{{ trans('admin.observed') }}</span>
                                @endif
                            </td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a class="delete-item" href="/admin/notification/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
@endsection
