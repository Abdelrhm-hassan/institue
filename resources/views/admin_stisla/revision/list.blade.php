@extends('admin_stisla.layout.layout')
@section('title',trans('admin.list_of_review_requests'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.search') }}</h4></div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.type') }}</label>
                            <select name="category_id" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id ?? '' }}" @if(isset($_GET['category_id']) && $_GET['category_id'] == $category->id) selected @endif>{{ $category->title ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <label>{{ trans('admin.status') }}</label>
                            <select class="form-control custom-select" name="mode">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="new" @if(isset($_GET['mode']) && $_GET['mode'] == 'new') selected @endif>{{ trans('admin.new') }}</option>
                                <option value="supporter" @if(isset($_GET['mode']) && $_GET['mode'] == 'supporter') selected @endif>{{ trans('admin.backup_response') }}</option>
                                <option value="employer" @if(isset($_GET['mode']) && $_GET['mode'] == 'employer') selected @endif>{{ trans('admin.employer_response') }}</option>
                                <option value="contractor" @if(isset($_GET['mode']) && $_GET['mode'] == 'contractor') selected @endif>{{ trans('admin.executive_moderator') }}</option>
                                <option value="close" @if(isset($_GET['mode']) && $_GET['mode'] == 'close') selected @endif>{{ trans('admin.closed') }}</option>
                                <option value="done" @if(isset($_GET['mode']) && $_GET['mode'] == 'done') selected @endif>{{ trans('admin.dispute_resolution') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $_GET['name'] ?? '' }}">
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.phone') }}</label>
                            <input type="text" class="form-control" name="phone" value="{{ $_GET['phone'] ?? '' }}">
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
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.project') }}</th>
                        <th class="text-center">{{ trans('admin.type') }}</th>
                        <th class="text-center">{{ trans('admin.employer') }}</th>
                        <th class="text-center">{{ trans('admin.contractor') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.status') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.created_at') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td><a href="/admin/project/list?id={{ $item->project_id }}">{{ $item->project->title ?? '' }}</a></td>
                            <td class="text-center">{{ $item->category->title ?? '' }}</td>
                            <td class="text-center"><a href="/admin/user/list?id={{ $item->project->user_id ?? '' }}">{{ $item->project->user->name ?? '' }}</a></td>
                            <td class="text-center"><a href="/admin/user/list?id={{ $item->project->contractor_id ?? '' }}">{{ $item->project->contractor->name ?? '-' }}</a></td>
                            <td class="text-center">{!! getMode('revision',$item->mode) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a title="{{ trans('admin.view_review_request') }}" href="/admin/revision/reply/{!! $item->id !!}"><i class="fas fa-comment"></i></a>
                                <a href="javascript:void(0);" title="{{ trans('admin.switching') }}" data-toggle="modal" data-target="#modal_edit_{{ $item->id }}"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal_edit_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelTitleId">{{ $item->project->title ?? '' }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/admin/revision/action?action=edit">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="form-group">
                                                <label>{{ trans('admin.status') }}</label>
                                                <select name="mode" class="form-control custom-select">
                                                    <option value="done">{{ trans('admin.dispute_resolution') }}</option>
                                                    <option value="close">{{ trans('admin.closed') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.exit') }}
                                            </button>
                                            <button type="submit" class="btn btn-primary">{{ trans('admin.save') }}</button>
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
