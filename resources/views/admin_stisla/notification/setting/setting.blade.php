@extends('admin_stisla.layout.layout')
@section('title',trans('admin.notification_settings'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">{{ trans('admin.automatic_user_notifications') }}</div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ trans('admin.title') }}</th>
                    <th class="text-center">{{ trans('admin.SMS') }}</th>
                    <th class="text-center">{{ trans('admin.email') }}</th>
                    <th class="text-center">{{ trans('admin.announcement') }}</th>
                    <th class="text-center">{{ trans('admin.active') }}</th>
                    <th class="text-center">{{ trans('admin.settings') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $item)
                    @if($item->admin == 0)
                    <tr>
                        <td>{!! $item->title ?? '' !!}</td>
                        <td class="text-center"><input type="checkbox" class="sms_enable" data-id="{!! $item->id !!}" @if($item->sms_enable == 1) checked @endif /></td>
                        <td class="text-center"><input type="checkbox" class="email_enable" data-id="{!! $item->id !!}" @if($item->email_enable == 1) checked @endif /></td>
                        <td class="text-center"><input type="checkbox" class="alert_enable" data-id="{!! $item->id !!}" @if($item->alert_enable == 1) checked @endif /></td>
                        <td class="text-center"><input type="checkbox" class="mode" data-id="{!! $item->id !!}" @if($item->mode == 'publish') checked @endif /></td>
                        <td class="text-center">
                            <a href="/admin/notification/setting/edit/{!! $item->id !!}" title="{{ trans('admin.content_editing') }}"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $('.sms_enable').click(function () {
                let id   = $(this).attr('data-id');
                if($(this).prop('checked')){
                    $.post('/admin/notification/setting/action/'+id,{'sms_enable':1});
                }else{
                    $.post('/admin/notification/setting/action/'+id,{'sms_enable':0});
                }
            });
            $('.email_enable').click(function () {
                let id   = $(this).attr('data-id');
                if($(this).prop('checked')){
                    $.post('/admin/notification/setting/action/'+id,{'email_enable':1});
                }else{
                    $.post('/admin/notification/setting/action/'+id,{'email_enable':0});
                }
            });
            $('.alert_enable').click(function () {
                let id   = $(this).attr('data-id');
                if($(this).prop('checked')){
                    $.post('/admin/notification/setting/action/'+id,{'alert_enable':1});
                }else{
                    $.post('/admin/notification/setting/action/'+id,{'alert_enable':0});
                }
            });
            $('.mode').click(function () {
                let id   = $(this).attr('data-id');
                if($(this).prop('checked')){
                    $.post('/admin/notification/setting/action/'+id,{'mode':'publish'});
                }else{
                    $.post('/admin/notification/setting/action/'+id,{'mode':'draft'});
                }
            });
        })
    </script>
@endsection
