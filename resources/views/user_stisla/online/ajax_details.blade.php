@if($project->mode == 'publish' && $project->contractor_id == null)
    <div class="text-center p-5 m-5">
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <div class="mt-4">{{ trans('admin.investigating_the_project_and_finding_an_executor') }}</div>
    </div>
@endif
@if($project->mode == 'process' && $project->contractor_id != null)
    @if($project->contractor)
    <div class="border-bottom d-flex flex-row justify-content-start align-items-center p-3">
        <img src="{{ avatar($project->contractor->avatar) ?? '' }}" class="rounded-circle" style="width: 50px;height: 50px;">
        <span class="px-3">{{ $project->contractor->name ?? '' }}</span>
    </div>
    @endif
    <style>
        .details-text-container{
            height: 600px;
            overflow-y: scroll;
            line-height: 200%;
            text-align: justify;
        }
        .details-text-container::-webkit-scrollbar{
            width: 8px;
        }
    </style>
    <div class="details-text-container p-4">{{ getExcerpt($project->work_text,$project->page_count * getOption('online_word_count',250)) ?? '' }}</div>
    <div class="d-flex flex-row justify-content-between align-items-center px-4 py-2">
        <div class="badge badge-warning">{{ mb_count_words($project->work_text) ?? 0 }}</div>
        @if($project->work_file == 1)
            <div class="badge badge-success">{{ trans('admin.done_successfully') }}</div>
        @endif
    </div>
@endif
@if($project->mode == 'done' && $project->contractor_id != null)
    @if($project->contractor)
        <div class="border-bottom d-flex flex-row justify-content-start align-items-center p-3">
            <a href="/user/profile/view/{{ $project->contractor->id ?? '' }}" target="_blank">
                <img src="{{ avatar($project->contractor->avatar) ?? '' }}" class="rounded-circle" style="width: 50px;height: 50px;">
                <span class="px-3">{{ $project->contractor->name ?? '' }}</span>
            </a>
        </div>
    @endif
    <style>
        .details-text-container{
            height: 600px;
            overflow-y: scroll;
            line-height: 200%;
            text-align: justify;
        }
        .details-text-container::-webkit-scrollbar{
            width: 8px;
        }
    </style>
    @if($project->remain_pay > 0)
    <div class="details-text-container p-4">{{ getExcerpt($project->work_text,$project->page_count * getOption('online_word_count',250)) ?? '' }}...</div>
    <div class="d-flex flex-row justify-content-between align-items-center px-4 py-2">
        <div class="badge badge-warning">{{ mb_count_words($project->work_text) ?? 0 }}</div>
        <a href="/user/online/remain/pay/{{ $project->id }}" class="btn btn-primary">{{ trans('admin.payment_of_project_cost_balance') }}</a>
    </div>
    @else
        <div class="details-text-container p-4">{{ $project->work_text ?? '' }}</div>
        <div class="d-flex flex-row justify-content-between align-items-center px-4 py-4">
            <div class="badge badge-warning">{{ mb_count_words($project->work_text) ?? 0 }}</div>
            @if($project->done_at + ((getOption('project_revision_time',1) * 3600)) > time())
                <a href="/user/project/revision/new/store/{{ $project->id }}" data-id="{{ $project->id }}" class="btn btn-danger btn-revision">{{ trans('admin.request_a_project_review') }}</a>
            @endif
        </div>
    @endif
@endif
