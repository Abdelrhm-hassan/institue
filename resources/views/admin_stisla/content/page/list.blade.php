@extends('admin_stisla.layout.layout')
@section('title',trans('admin.page'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.display_filter') }}</h4>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!! $_GET['title'] ?? '' !!}">
                        </div>
                        <div class="col-4">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="draft">{{ trans('admin.draft') }}</option>
                                <option value="publish">{{ trans('admin.publish') }}</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>{{ trans('admin.view_order') }}</label>
                            <select name="order" class="form-control">
                                <option value="new">{{ trans('admin.new_to_old') }}</option>
                                <option value="old">{{ trans('admin.old_to_new') }}</option>
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
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.creation_date') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! getMode('public', $item->mode) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a href="/p/{!! $item->slug !!}" target="_blank" title="{{ trans('admin.view_page') }}"><i class="fas fa-eye"></i></a>
                                <a href="/admin/page/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/page/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
