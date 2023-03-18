@foreach($projects as $project)
    <div class="widget has-shadow">
        <div class="widget-header bordered no-actions d-flex justify-content-between align-items-center">
            <h4>{!! $project['title'] ?? '' !!}</h4>
            <span class="float-right">{{ trans('admin.grouping') }} {!! $project['category'] ?? '' !!}</span>
        </div>
        <div class="widget-body">
            <span>{{ trans('admin.to_view_the_user_attachment') }}</span>
            <a target="_blank" href="{!! $project['file'] ?? '' !!}">{{ trans('admin.here') }}</a>
            <span>{{ trans('admin.click') }}</span>
        </div>
        <div class="widget-footer d-flex justify-content-between align-items-center">
            <span class="send-report" data-id="{{ $project['id'] }}"><i class="la la-bell" style="color: red;font-size: 24px;cursor: pointer" title="Send Report"></i></span>
            <button type="button" data-project="{!! $project['id'] !!}" class="btn btn-success btn-modal-confirm">{{ trans('admin.acceptance_of_this_project') }}</button>
        </div>
    </div>
@endforeach
