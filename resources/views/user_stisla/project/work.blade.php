@extends('user_stisla.layout.layout')
@section('title',$project->title)
@section('page')
    <div class="card has-shadow done-find-project">
        <div class="card-header bordered no-actions">
            <span id="project_user_name">{{ trans('admin.employer') }} {!! $project->user->name ?? '' !!}</span>
            <span id="project_user_id" data-id="{!! $project->user->id !!}" class="float-right" style="color: blueviolet;cursor: pointer;">{{ trans('admin.chat_with_the_employer') }}</span>
        </div>
        <div class="card-body">
            <div class="py-1">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <a style="color: green;font-weight:bold;" href="/bin/project/{!! $project->file ?? '' !!}" target="_blank">{{ trans('admin.view_attachment') }}</a>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <span>{{ trans('admin.number_of_letters_typed') }}</span>
                        <b id="char_count">0</b>
                    </div>
                    <div class="col-12 col-md-4 text-right">
                        <span>{{ trans('admin.number_of_typed_words') }}</span>
                        <b id="word_count">0</b>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
            <textarea type="text" class="form-control" style="line-height: 200%" rows="20" project-id="{!! $project->id !!}" id="work_text">{!! $project->work_text ?? '' !!}</textarea>
        </div>
        <div class="card-footer text-right">
            <span id="save_status" class="float-left" style="color: black;"></span>
            <a href="/user/online/ajax?action=done&id={!! $project->id !!}" onclick="return confirm('{{ trans('admin.are_you_sure_you_want_to_finish_this_project?') }}');" class="btn btn-primary">{{ trans('admin.end_of_the_project') }}</a>
        </div>
    </div>
@stop
@section('script')
    <script>
        $('#work_text').keyup(function (){
            let char = $(this).val().length;
            let word = $(this).val().match(/\S+/g).length;
            $('#char_count').text(char);
            $('#word_count').text(word);
            $('#save_status').text('{{ trans('admin.saving...') }}').css('color','black');
        });
    </script>
    <script>
        /* Auto Save */
        setInterval(function (){
            let projectId   = $('#work_text').attr('project-id');
            let text        = $('#work_text').val();
            let data        = new FormData();
            data.append('action','save');
            data.append('project',projectId);
            data.append('text',text);
            $.ajax({
                url         :'/user/online/ajax',
                type        :'POST',
                data        :data,
                cache       :false,
                contentType :false,
                processData :false,
                success     :function (data){
                    $('#save_status').text('{{ trans('admin.saved') }}').css('color','green');
                }
            });
        },5000);
    </script>
@stop
