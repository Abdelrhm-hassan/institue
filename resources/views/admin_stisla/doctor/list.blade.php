@extends('admin_stisla.layout.layout')
@section('title',trans('admin.garage'))
@section('page')
<div class="card has-shadow">
    <div class="card-header bordered no-actions d-flex align-items-center">
        <h4>{{ trans('admin.display_filter') }}</h4>
    </div>
    <form>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>{{ trans('admin.user_name') }}</label>
                    <input type="text" class="form-control" name="username" value="{!! $_GET['username'] ?? '' !!}">
                </div>
                <div class="col-md-3">
                    <label>{{ trans('admin.email') }}</label>
                    <input type="email" class="form-control" name="username" value="{!! $_GET['email'] ?? '' !!}">
                </div>
                <div class="col-md-3">
                    <label>{{ trans('admin.phone_number') }}</label>
                    <input type="text" class="form-control" name="phone" value="{!! $_GET['phone'] ?? '' !!}">
                </div>
                <div class="col-md-3">
                    <label>{{ trans('admin.status') }}</label>
                    <select name="mode" class="form-control custom-select">
                        <option value="">{{ trans('admin.all') }}</option>
                        <option value="active">{{ trans('admin.active') }}</option>
                        <option value="deactive">{{ trans('admin.inactive') }}</option>
                        <option value="banned">{{ trans('admin.blocked') }}</option>
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
            <h4>{{ trans('admin.doctors') }}</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('admin.name') }}</th>
                        <th class="text-center">{{ trans('admin.email') }}</th>
                        <th class="text-center">{{ trans('admin.phone_number') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td class="text-center">  
                              <img src="{{ asset('assets/doctor/img') }}/{{$item->photo}}"" class="circle" style="border-radius: 40px" width="80" height="80">&nbsp;
                                </td>
                                <td class="text-center">{!! $item->name ?? '' !!}</td>
                                <td class="text-center">{!! $item->email ?? '' !!}</td>
                                <td class="text-center">{!! $item->phone ?? '' !!}</td>
                                <td class="text-center">{!! getMode('user', $item->status) !!}</td>
                                <td class="text-center">
                                    <a title="{{ trans('admin.login_to_the_user_panel') }}" target="_blank" href="/admin/user/login/{!! $item->id !!}"><i class="fas fa-user-secret"></i></a>
                                    <a title="{{ trans('admin.view_user_profiles') }}" href="/admin/doctor/show/{!! $item->id !!}"><i class="fas fa-eye"></i></a>
                                    <a class="" href="/admin/doctor/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                    <a class="delete-item" href="/admin/doctor/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
