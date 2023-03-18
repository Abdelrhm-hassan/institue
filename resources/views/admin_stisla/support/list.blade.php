@extends('admin_stisla.layout.layout')
@section('title',trans('admin.support'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.display_filter') }}</h4>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ trans('admin.user_name') }}</label>
                            <input type="text" class="form-control" name="username" value="{!! $_GET['username'] ?? '' !!}">
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('admin.email') }}</label>
                            <input type="email" class="form-control" name="username" value="{!! $_GET['email'] ?? '' !!}">
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('admin.phone_number') }}</label>
                            <input type="text" class="form-control" name="phone" value="{!! $_GET['phone'] ?? '' !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!! $_GET['title'] ?? '' !!}">
                        </div>
                        <div class="col-6 col-md-3">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="new" @if(isset($_GET['mode']) && $_GET['mode'] == 'new') selected @endif>{{ trans('admin.new') }}</option>
                                <option value="waiting" @if(isset($_GET['mode']) && $_GET['mode'] == 'waiting') selected @endif>{{ trans('admin.waiting_for_an_answer') }}</option>
                                <option value="answered" @if(isset($_GET['mode']) && $_GET['mode'] == 'answered') selected @endif>{{ trans('admin.has_been_answered') }}</option>
                                <option value="closed" @if(isset($_GET['mode']) && $_GET['mode'] == 'closed') selected @endif>{{ trans('admin.closed') }}</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3">
                            <label>{{ trans('admin.department') }}</label>
                            <select name="category_id" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                @foreach($categories as $category)
                                    <option @if(isset($_GET['category_id']) && $_GET['category_id'] == $category->id) selected @endif value="{!! $category->id !!}">{!! $category->title ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-3">
                            <label>{{ trans('admin.view_order') }}</label>
                            <select name="order" class="form-control custom-select">
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
                        <th class="text-center">{{ trans('admin.user') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.department') }}</th>
                        <th class="text-center">{{ trans('admin.creation_date') }}</th>
                        <th class="text-center">{{ trans('admin.update_date') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td><a title="{{ trans('admin.post_reply') }}" href="/admin/support/reply/{!! $item->id !!}">{!! $item->title ?? '' !!}</a></td>
                            <td class="text-center">{!! userUrl($item->user) !!}</td>
                            <td class="text-center">{!! getMode('ticket', $item->mode) !!}</td>
                            <td class="text-center">{!! $item->category->title ?? '' !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">{!! getJDate($item->updated_at) !!}</td>
                            <td class="text-center">
                                <a title="{{ trans('admin.management') }}" href="javascript:void(0);" data-toggle="modal" data-target="#editor-{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a title="{{ trans('admin.post_reply') }}" href="/admin/support/reply/{!! $item->id !!}"><i class="fas fa-envelope"></i></a>
                                <a class="delete-item" href="/admin/support/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editor-{!! $item->id !!}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" action="/admin/support/edit/store/{!! $item->id !!}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>{{ trans('admin.department') }}</label>
                                                <select name="category_id" class="form-control custom-select">
                                                    @foreach($categories as $category)
                                                        <option @if($item->category_id == $category->id) selected @endif value="{!! $category->id !!}">{!! $category->title ?? '' !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{ trans('admin.status') }}</label>
                                                <select name="mode" class="form-control custom-select">
                                                    <option value="new" @if($item->mode == 'new') selected @endif>{{ trans('admin.new') }}</option>
                                                    <option value="waiting" @if($item->mode == 'waiting') selected @endif>{{ trans('admin.waiting_for_an_answer') }}</option>
                                                    <option value="answered" @if($item->mode == 'answered') selected @endif>{{ trans('admin.has_been_answered') }}</option>
                                                    <option value="closed" @if($item->mode == 'closed') selected @endif>{{ trans('admin.closed') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.exit') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ trans('admin.submit') }}</button>
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
@endsection
