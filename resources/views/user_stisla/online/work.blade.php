@extends('user_stisla.layout.layout')
@section('title',$project->title)
@section('page')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">{{ trans('admin.text') }}</div>
                <div class="card-body">
                    <textarea class="form-control" id="online_text" style="line-height: 200%;height: 300px;" rows="20"></textarea>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-body d-flex flex-row justify-content-between align-items-center">
                    <div class="d-flex flex-row justify-content-start align-items-center">
                        <span style="color: green" class="font-weight-bold" id="word_count">0</span>
                        <span class="px-2">{{ trans('admin.word') }}</span>
                    </div>
                    <div class="d-flex flex-row justify-content-start align-items-center">
                        <span class="px-1">{{ trans('admin.word') }}</span>
                        <span style="color: green">{!! number_format(getOption('online_price_per_page',2500)/ 250) !!}</span>
                        <span class="px-1">{{ trans('admin.usd') }}</span>
                    </div>
                    <div class="d-flex flex-row justify-content-start align-items-center">
                        <span class="px-1">{{ trans('admin.total_amount') }}</span>
                        <span style="color: green" id="total_price">0</span>
                        <span class="px-1">{{ trans('admin.usd') }}</span>
                    </div>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#modalConfirmDone" id="finish">{{ trans('admin.done') }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">{{ trans('admin.file') }}</div>
                <div class="card-body">
                    <img src="{{ $project->file ?? '' }}" style="width: 100%;height: auto;"/>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalConfirmDone" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('admin.notices') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ trans('admin.are_you_sure_you_want_to_finish_this_project?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.exit') }}</button>
                    <a href="/user/online/finish/{{ $project->id }}" type="button" class="btn btn-danger">{{ trans('admin.yes,_Im_sure') }}</a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        function countWords(str) {
            return str.trim().split(/\s+/).length;
        }
    </script>
    <script>
        $(function (){
            let wordPrice = {{ getOption('online_price_per_page',2500)/ 250 }};
            $('#online_text').on('change keyup', function (){
                let count = countWords($(this).val());
                $('#total_price').text(count * wordPrice);
                $('#word_count').text(count);
            });
        });
    </script>
    <script>
        $(function (){
            setInterval(function (){
                let text = $('#online_text').val();
                let project = '{{ $project->id }}';
                $.post('/user/online/ajax/save',{'text':text,'project':project});
            },2000);
        })
    </script>
@stop
