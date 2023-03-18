@extends('admin_stisla.layout.layout')
@section('title',trans('admin.list_of_managers'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.list_of_managers') }}</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.user_name') }}</th>
                        <th class="text-center">{{ trans('admin.access') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td>{!! $item->username ?? '' !!}</td>
                                <td class="text-center">{!! getAccess($item->access) !!}</td>
                                <td class="text-center">{!! getMode('user', $item->mode) !!}</td>
                                <td class="text-center">
                                    <a href="/admin/manager/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                    <a class="delete-item" href="/admin/manager/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
