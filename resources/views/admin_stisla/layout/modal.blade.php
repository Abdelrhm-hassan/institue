<div id="modal-delete" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger p-3">
                <h4 class="modal-title" style="color: #fafafa">{{ trans('admin.system_message') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">{{ trans('admin.exit') }}</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    {{ trans('admin.are_you_sure_you_want_to_delete_this_item?') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">{{ trans('admin.exit') }}</button>
                <a href="javascript:void(0);" class="btn btn-danger">{{ trans('admin.yes,_Im_sure') }}</a>
            </div>
        </div>
    </div>
</div>
<div id="modal-confirm" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success p-3">
                <h4 class="modal-title" style="color: #fafafa">{{ trans('admin.system_message') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">{{ trans('admin.exit') }}</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    {{ trans('admin.are_you_sure_you_want_to_perform_this_operation?') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">{{ trans('admin.exit') }}</button>
                <a href="javascript:void(0);" class="btn btn-success">{{ trans('admin.yes,_Im_sure') }}</a>
            </div>
        </div>
    </div>
</div>
