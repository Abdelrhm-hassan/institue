@extends('admin_stisla.layout.layout')
@section('title',trans('admin.list'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">{{ trans('admin.search') }}</div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!!  $_GET['title'] ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-6"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.search') }}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions text-right">
            <a href="/admin/product/gallery/new">{{ trans('admin.create_a_new_gallery') }}</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.name') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.number_of_slides') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-center">{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! getMode('public', $item->mode) !!}</td>
                            <td class="text-center">{!! $item->images_count ?? 0 !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a href="/admin/product/gallery/edit/{!! $item->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/product/gallery/delete/{!! $item->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
                                <a href="/admin/product/gallery/slide/{!! $item->id !!}" title="{!! trans('admin.add_a_slide') !!}"><i class="la la-image"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($list->hasPages())
            <div class="card-footer">
                {!! $list->appends($_GET)->links() !!}
            </div>
        @endif
    </div>
@endsection
