@extends('user_stisla.layout.layout')
@section('title', trans('admin.online_project'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.search') }}</h4></div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{{ $_GET['title'] ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ trans('admin.search') }}">
                </div>
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.list') }}</h4></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.title') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.pages') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.paid') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.status') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{ $item->title ?? '' }}</td>
                            <td class="text-center">{{ $item->page_count ?? '-' }}</td>
                            <td class="text-center">{{ processFinalOnline($User->id,$item->id,$item->mode,$item->amount) }}</td>
                            <td class="text-center">{!! getMode('project', $item->mode) !!}</td>
                            <td class="text-center">
                                @if($item->mode == 'publish')
                                    <a class="delete-item" href="/user/online/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                                @endif
                                <a href="javascript:void(0);" class="project_details" data-mode="{{ $item->mode }}" data-title="{{ $item->title ?? '' }}" data-id="{{ $item->id }}"><i class="fas fa-cog"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="projectDetails" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title"></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0" id="project_content">
                    <div class="text-center p-5 m-5">
                        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        <div class="mt-4">{{ trans('admin.investigating_the_project_and_finding_an_executor') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRevision" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">{{ trans('admin.submit_a_review_request') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ trans('admin.category') }}</label>
                            <select name="category_id" class="form-control custom-select">
                                @foreach($revision_types as $RT)
                                    <option value="{{ $RT->id ?? '' }}">{{ $RT->title ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.please_explain_your_reason_for_requesting_a_review') }}</label>
                            <textarea class="form-control" name="description" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.cancel_and_exit') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('admin.submit_a_review_request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        let interval;
        $(function (){
            $('.project_details').on('click touch', function (){
                $('#project_content').html(`<div class="text-center p-5 m-5">
                        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        <div class="mt-4">{{ trans('admin.investigating_the_project_and_finding_an_executor') }}</div>
                    </div>`);
                clearInterval(interval);
                let title = $(this).attr('data-title');
                let id    = $(this).attr('data-id');
                let mode  = $(this).attr('data-mode');
                $('#projectDetails').find('.modal-title').text(title);
                $('#projectDetails').modal('show');
                if(mode == 'process' || mode == 'publish') {
                    interval = setInterval(function () {
                        let scroll = $('.details-text-container').scrollTop();
                        $.get('/user/online/details?id=' + id, function (data) {
                            $('#project_content').html(data);
                            if(scroll)
                                $('.details-text-container').scrollTop(scroll);
                        });
                    }, 5000);
                }
                if(mode == 'done'){

                    $.get('/user/online/details?id=' + id, function (data) {
                        $('#project_content').html(data);
                        $('.details-text-container').scrollTop(scroll);
                    });
                }
            })
        })
    </script>
    <script>
        $(function (){
            $('body').on('click touch', '.btn-revision', function (e){
               e.preventDefault();
                clearInterval(interval);
               let url = $(this).attr('href');
               $('#modalRevision').find('form').attr('action',url);
               $('#projectDetails').modal('hide');
               $('#modalRevision').modal('show');
            });
        })
    </script>
@stop
