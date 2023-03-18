@extends('admin_stisla.layout.layout')
@section('title',trans('admin.comments'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header">{{ trans('admin.search') }}</div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.user_name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $_GET['name'] ?? '' }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.project_number') }} / {{ trans('admin.project_title') }}</label>
                            <input type="text" class="form-control" name="project_number" value="{{ $_GET['project_number'] ?? '' }}">
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
                        <th>{{ trans('admin.first_name_and_last_name') }}</th>
                        <th class="text-center">{{ trans('admin.project') }}</th>
                        <th class="text-center">{{ trans('admin.creation_date') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! userUrl($item->user) ?? '' !!}</td>
                            <td class="text-center"><a href="/project/{!! $item->project_id !!}" target="_blank">{!! $item->project->title ?? '' !!}</a></td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center" width="80">{!! getMode('public', $item->mode) !!}</td>
                            <td class="text-center" width="70">
                                <a href="/admin/comment/action/{!! $item->id !!}/@if($item->mode == 'publish'){{{'draft'}}}@else{{{'publish'}}}@endif" title="{{ trans('admin.switching') }}"><i class="fas fa-refresh"></i></a>
                                <a class="delete-item" href="/admin/comment/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr style="background: #fafafa">
                            <td colspan="7">{{ trans('admin.text') }}:
                                <b style="color: #424242">{!! $item->text ?? '' !!}</b>
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
