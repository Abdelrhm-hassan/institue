@extends('admin_stisla.layout.layout')
@section('title',trans('admin.to_register_your_account_online_order'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.search') }}</h4></div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.name') }}</label>
                            <input type="text" class="form-control" name="username" value="{{ $_GET['username'] ?? '' }}">
                        </div>
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.phone') }}</label>
                            <input type="text" class="form-control" name="phone" value="{{ $_GET['phone'] ?? '' }}">
                        </div>
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="draft" @if(isset($_GET['mode']) && $_GET['mode'] == 'draft') selected @endif>{{ trans('admin.draft') }}</option>
                                <option value="reject"@if(isset($_GET['mode']) && $_GET['mode'] == 'reject') selected @endif>{{ trans('admin.reject_the_request') }}</option>
                                <option value="accept"@if(isset($_GET['mode']) && $_GET['mode'] == 'accept') selected @endif>{{ trans('admin.accept_/_enable') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
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
                       <th class="text-center">{!! trans('admin.user') !!}</th>
                       <th class="text-center">{{ trans('admin.score') }}</th>
                       <th class="text-center">{{ trans('admin.type_of_application') }}</th>
                       <th class="text-center">{{ trans('admin.status') }}</th>
                       <th class="text-center">{{ trans('admin.date') }}</th>
                       <th class="text-center">{!! trans('admin.management') !!}</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($list as $item)
                       <tr>
                           <td class="text-center"><a href="/admin/user/edit/{!! $item->user_id !!}">{!! $item->user->username ?? '' !!}</a></td>
                           <td class="text-center">{!! $item->user->point ?? 0 !!}</td>
                           <td class="text-center">
                               @if($item->type == 'disable')
                                   {{ trans('admin.deactivation') }}
                               @else
                                   {{ trans('admin.activation') }}
                               @endif
                           </td>
                           <td class="text-center">
                               @if($item->mode == 'draft')
                                   <span class="badge badge-warning">{{ trans('admin.draft') }}</span>
                               @elseif($item->mode == 'reject')
                                   <span class="badge badge-danger">{{ trans('admin.failed') }}</span>
                               @else
                                   <span class="badge badge-success">{{ trans('admin.accept_/_enable') }}</span>
                               @endif
                           </td>
                           <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                           <td class="text-center">
                               @if($item->mode == 'draft')
                                   <a href="/admin/user/online/action?id={!! $item->id !!}&mode=reject" title="{{ trans('admin.reject_the_request') }}"><i style="color: red" class="fas fa-times-circle"></i></a>
                                   <a href="/admin/user/online/action?id={!! $item->id !!}&mode=accept" title="{{ trans('admin.confirm_request') }}"><i style="color: green" class="fas fa-check-circle"></i></a>
                               @else
                                   <a href="/admin/user/online/action?id={!! $item->id !!}&mode=reject" title="{{ trans('admin.reject_the_request') }}"><i style="color: red" class="fas fa-times-circle"></i></a>
                               @endif
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
