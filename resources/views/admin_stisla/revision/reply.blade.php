@extends('admin_stisla.layout.layout')
@section('title',trans('admin.review_requests'))
@section('page')
    <div class="card has-shadow" style="background-color: #0F6FD5;">
        <div class="card-body text-center">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="py-3">
                        <table class="table text-left text-white">
                            <tbody>
                                <tr>
                                    <td>{{ trans('admin.title') }} {{ $project->title ?? '' }}</td>
                                    <td>{{ trans('admin.project_status') }} {!! getMode('project',$project->mode) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.the_budget') }} {{ $project->budget->title ?? '' }}</td>
                                    <td>{{ trans('admin.warranty_amount:') }} {{ number_format($project->guarantee_amount) ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.employer') }} {{ $project->user->name ?? '' }}</td>
                                    <td>{{ trans('admin.contractor') }} {{ $project->contractor->name ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-white">
                    <span class="iconify" data-width="100" data-icon="emojione:balance-scale" data-inline="false"></span>
                    <div class="py-3">
                        <h4 class="text-white">{{ trans('admin.request_a_review_of_a_project_by_a_backup') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($revision->messages as $message)
        <div class="card has-shadow mt-2">
            <div class="card-header bordered no-actions @if($message->user_id == $project->user_id) bg-danger @elseif($message->user_id == $project->contractor_id) bg-warning @else bg-blue @endif">
                {{ $message->user->name ?? '' }}&nbsp;@if($message->user_id != $project->user_id && $message->user_id != $project->contractor_id)({{ trans('admin.supporter') }})@endif
                <span class="float-right">{{ getJDate($message->created_at) }}</span>
            </div>
            <div class="card-body">{{ $message->message ?? '' }}</div>
            @if($message->files != null && $message->files != '' && file_exists(getcwd().$message->files))
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ $message->files ?? '' }}" target="_blank"><i class="la la-paperclip" style="font-size: 1.4em;"></i></a>
                </div>
            @endif
        </div>
    @endforeach
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">{{ trans('admin.post_reply') }}</div>
        <form method="post" action="/admin/revision/reply/store/{{ $revision->id }}">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('admin.text') }}</label>
                    <textarea class="summernote" name="message" rows="10"></textarea>
                </div>
                <div class="my-2">
                    {!! fileUploader('/user/support/upload','file',null,'single', trans('admin.appendix')) !!}
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.send') }}">
            </div>
        </form>
    </div>
@stop
