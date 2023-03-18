@extends('user_stisla.layout.layout')
@section('title',trans('admin.online_presenter'))
@section('page')
    <div class="d-flex flex-row justify-content-between alert alert-info" role="alert" style="line-height: 180%;">
        <strong>{!! getOption('online_user') !!}</strong>
        <strong>%{{ getOption('online_commission',0) }} {{ trans('admin.executors_share_in_each_project') }} </strong>
    </div>
    <div class="h-10"></div>
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card has-shadow waiting-find-project">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.waiting_to_receive_the_project_online...') }}</h4></div>
                <div class="card-body project-container">
                    <div class="text-center p-5 m-5">
                        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-body text-center" style="position: relative">
                    <span id="online_users" style="font-size: 2em;color: green">0</span>
                    <br>
                    <span>{{ trans('admin.online_presenters') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_confirm_project" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>{{ trans('admin.are_you_sure_you_want_to_select_this_project_as_a_contractor?') }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.i_gave_up') }}</button>
                    <button type="button" class="btn btn-primary btn-accept-project">{{ trans('admin.Yes,_Im_sure') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ trans('admin.are_you_sure_you_want_to_report_a_violation_of_this_project') }}
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
                    <button type="button" class="btn btn-danger btn-send-report" data-id="">{{ trans('admin.Yes,_Im_sure') }}</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(function (){
            $.get('/user/online/ajax?action=count', function (count){
                $('#online_users').text(count);
            });
           setInterval(function (){
               $.get('/user/online/ajax?action=online');
               $.get('/user/online/ajax?action=count', function (count){
                   $('#online_users').text(count);
               });
           },10000);
           setInterval(function (){
               $.get('/user/online/ajax?action=project', function (data){
                   $('.project-container').html(data);
               })
           },5000);
        });
    </script>
    <script>
        $('body').on('click','.btn-modal-confirm', function (){
            let projectId = $(this).attr('data-project');
            $('.btn-accept-project').attr('data-project',projectId);
            $('#modal_confirm_project').modal('show');
        });
        $('body').on('click','.btn-accept-project', function (){
            let projectId = $(this).attr('data-project');
            $.getJSON('/user/online/ajax?action=accept&id='+projectId, function (data){
                $('#modal_confirm_project').modal('hide');
                if(data.status == true){
                    showMsg('{{ trans('admin.you_are_currently_the_executor_of_this_project._please_wait_a_moment...') }}');
                    setInterval(function (){
                        location.reload();
                    },3000);
                }else{
                    showMsg('{{ trans('admin.another_facilitator_took_over_the_project_before_you') }}');
                }
            });
        });
    </script>
    <script>
        $(function (){

           $(document).on('click touch','.send-report', function (){
               let id = $(this).attr('data-id');
              $('#modalReport').modal('show');
              $('#modalReport').find('.btn-send-report').attr('data-id', id);
           });
        });
    </script>
    <script>
        $('.btn-send-report').on('click', function (){
           window.location.href = '/user/project/report/'+ $(this).attr('data-id');
        });
    </script>
@stop
