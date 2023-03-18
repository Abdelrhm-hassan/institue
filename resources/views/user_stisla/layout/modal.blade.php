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
<!-- Modal -->
<style>
    .modal-lg{
        max-width: 1000px;
    }
</style>
<div class="modal fade" id="modal_chat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header p-3 d-flex align-items-center" style="border-bottom: 1px solid rgba(0,0,0,.2);">
                <h4 class="modal-title" id="modelTitleId">{{ trans('admin.chat') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <iframe src="/user/chat/iframe" scrolling="no" frameborder="0" marginwidth="0" marginheight="0" style="display:block;width: 100%;height: 550px;margin: 0;padding: 0;border-width: 0!important;"></iframe>
            </div>
        </div>
    </div>
</div>
@if(isset($_GET['chat']))
    <script>
        $(function (){
            $('#modal_chat').modal('show');
        })
    </script>
@endif
