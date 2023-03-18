@extends('user_stisla.layout.layout')
@section('title',trans('admin.register_a_new_project'))
@section('page')
    <link rel="stylesheet" href="/assets/user/vendors/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css">
    <style>
        .jqte_editor, .jqte_source{
            min-height: 250px;
        }
        .step-wizard li{
            width: 24% !important;
        }
        @if(!isRtl())
        .step-wizard li .title{
            left: 25px;
            right: auto;
            top: 5px;
        }
        @else
        .step-wizard li .title{
            left: 0px;
            right: 28px;
            top: 5px;
        }
        @endif
        .capture-click{
            cursor: pointer;
        }
        #thumbnail_view img{
            width: 100% !important;
            height: auto !important;
        }
        .facility-item{
            background-color: #fafafa;
            border-radius: 6px;
            padding: 10px;
            margin: 10px;
            padding-bottom: 0px;
        }
        .facility-item label{
            position: relative;
            top: -7px;
        }
        .bootstrap-select>.dropdown-toggle.bs-placeholder, .bootstrap-select>.dropdown-toggle.bs-placeholder:hover, .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, .bootstrap-select>.dropdown-toggle.bs-placeholder{
            border-radius: 4px !important;
        }
        @if(isRtl())
        .bootstrap-select .dropdown-toggle .filter-option{
            text-align: right;
            border-radius: 4px;
        }
        @endif
        .upload-block{
            margin-bottom: 15px;
            direction: ltr;
            text-align: left;
            border-bottom: 1px solid rgba(0,0,0,0.2);
        }
        .upload-block:last-child{
            border-bottom: none;
        }
        .upload-block span{
            padding-bottom: 5px;
        }
        .error{
            color: red;
            font-size: .8em;
            padding-top: 4px;
        }
        .col-color{
            color: #CE414B;
        }
        .table-details td{
            padding-bottom: 25px;
        }

        #user_container{
            height: 300px;
            overflow-y: scroll;
        }
        #user_container::-webkit-scrollbar{
            width: 0;
        }
        .nav-pills li a{
            color: #0b0b0b;
            font-weight: bold;
        }
    </style>
    <div id="rootwizard" style="margin-top: 60px;">
        <div class="card mb-0">
            <div class="card-body">
                <div class="step-container">
                    <div class="step-wizard">
                    <div class="progress">
                        <div class="progressbar progress-bar-striped bg-info" style="width: 25%"></div>
                    </div>
                    <ul class="nav nav-pills mt-2">
                        <li>
                            <a href="#tab1" data-toggle="tab" class="active show">
                                <span class="step">1</span>
                                <span class="title">{{ trans('admin.project_registration_method') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">
                                <span class="step">2</span>
                                <span class="title">{{ trans('admin.project_details') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">
                                <span class="step">3</span>
                                <span class="title">{{ trans('admin.file_selection') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab">
                                <span class="step">4</span>
                                <span class="title">{{ trans('admin.invoice_and_confirmation') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    <form method="post" action="/user/project/new/store">
        <div class="tab-content">
            <div class="tab-pane active show " id="tab1">
                {!! getOption('project_new_text_1') !!}
                {!! getOption('project_new_text_2') !!}
                <div class="card has-shadow">
                    <div class="card-header bordered no-actions"><h4>{{ trans('admin.project_details') }}</h4></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card has-shadow capture-click" style="background-color: #88B745">
                                    <div class="card-header bordered no-actions" style="color: white;">{{ trans('admin.general') }}</div>
                                    <div class="card-body text-center">
                                        <input type="radio" name="type" style="position: relative;top: 2px;" value="public" @if(!isset($edit)) checked @endif>&nbsp;<span style="color: white">{{ trans('admin.visible_to_all_presenters') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card has-shadow capture-click" style="background-color: #0c5460">
                                    <div class="card-header bordered no-actions" style="color: white;">{{ trans('admin.private') }}</div>
                                    <div class="card-body text-center">
                                        <input type="radio" name="type" style="position: relative;top: 2px;" value="private" @if(isset($edit) && $edit->type == 'private') checked @endif>&nbsp;<span style="color: white">{{ trans('admin.select_the_moderator_from_the_list_of_site_users') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card has-shadow capture-click" style="background-color: #9c3328">
                                    <div class="card-header bordered no-actions" style="color: white;">{{ trans('admin.online/Instant') }}</div>
                                    <div class="card-body text-center">
                                        <input type="radio" name="type" style="position: relative;top: 2px;" value="online" @if(isset($edit) && $edit->type == 'online') checked @endif>&nbsp;<span style="color: white">{{ trans('admin.do_it_online_and_instantly') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="button" onclick="" class="btn btn-primary button-next float-right" value="{{ trans('admin.next_level') }}">
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="tab2">
                <div class="card has-shadow">
                    <div class="card-header bordered no-actions"><h4>{!! trans('admin.project') !!}</h4></div>
                    <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <label>{!! trans('admin.title') !!}</label>
                                        <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label>{!! trans('admin.category') !!}</label>
                                        <select name="category_id" class="form-control custom-select">
                                            @foreach(getCategory() as $category)
                                                <option value="{!! $category->id ?? '' !!}">{!! $category->title ?? '' !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label>{{ trans('admin.language') }}</label>
                                        <select class="form-control custom-select" name="language_id">
                                            @foreach(getLanguageList() as $language)
                                                <option @if(isset($edit) && $edit->language_id == $language['id']) selected @endif  value="{!! $language['id'] ?? '' !!}">{!! $language['title'] ?? '' !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label>{{ trans('admin.text_type') }}</label>
                                        <select class="form-control custom-select" name="text_id">
                                            @foreach(getTextList() as $text)
                                                <option @if(isset($edit) && $edit->text_id == $text['id']) selected @elseif(getOption('online_category_id') == $text['id'])  @endif  value="{!! $text['id'] ?? '' !!}">{!! $text['title'] ?? '' !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label>{{ trans('admin.specialty_guarantee_(USD)') }}</label>
                                        <input type="number" class="form-control text-center" name="guarantee_amount" value="{!! $edit->guarantee_amount ?? getOption('default_guarantee','') !!}">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label>{{ trans('admin.number_of_pages') }}</label>
                                        <input type="number" class="form-control text-center" min="1" name="page_count" value="{!! $edit->page_count ?? '1' !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="users" style="display: none">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label>{{ trans('admin.select_contractor') }}</label>
                                        <input type="hidden" name="contractor_id">
                                        <input type="text" class="form-control" onclick="$('#user_search').modal('show');" id="contractor_username">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{!! trans('admin.text') !!}</label>
                                <textarea class="jqte" name="description">{!! $edit->description ?? '' !!}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label>{{ trans('admin.offered_price') }}</label>
                                        <select name="budget_id" class="form-control custom-select">
                                            @foreach(employerAmount() as $amount)
                                                <option value="{!! $amount['id'] !!}">{!! $amount['title'] !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>{{ trans('admin.delivery_time') }}</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <input type="number" placeholder="{{ trans('admin.day') }}" min="0" max="200" class="form-control text-center" name="day" value="{!! $edit->day ?? '1' !!}">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text">{{ trans('admin.day') }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <input type="number" placeholder="{{ trans('admin.the_watch') }}" min="0" class="form-control text-center" name="hour" value="{!! $edit->hour ?? '1' !!}">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text">{{ trans('admin.the_watch') }}</span>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{!! trans('admin.tag') !!}</label>
                                <select name="tags[]" data-live-search="true" multiple="multiple" class="form-control selectric">
                                    @foreach(getTags() as $tag)
                                        <option value="{!! $tag !!}" @if(isset($edit) && strpos($edit->tags,$tag) !== false) selected @endif>{!! $tag !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="card-footer">
                        <input type="button" onclick="" class="btn btn-primary button-previous float-left" value="{{ trans('admin.stage_before') }}">
                        <input type="button" onclick="" class="btn btn-primary button-next float-right btn-step-2" value="{{ trans('admin.next_level') }}">
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="tab3">
                <div class="alert alert-info" role="alert">
                    <strong>{{ trans('admin.upload_original_files_and_project_samples.For_efficiency,_it_is_better_to_send_all_files_in_a_zip_file') }}</strong>
                </div>
                <div class="card has-shadow">
                    <div class="card-header bordered no-actions d-flex justify-content-between">
                        <h4>{{ trans('admin.click_on_file_selection_to_upload') }}</h4>
                        <input type="file" name="upload" id="upload" accept=".zip,.rar,.pdf,.doc,.docx,.mkv,.mp4,.avi,.mp3,.jpeg,.jpg" multiple style="display: none;">
                    </div>
                    <div class="card-body" id="uploads">
                    </div>
                    <div class="card-body text-center my-3">
                        <span class="text-muted" id="upload-file-btn" style="font-size: 3em;cursor: pointer;">{{ trans('admin.file_selection') }}</span>
                    </div>
                    <div class="card-footer">
                        <input type="button" onclick="" class="btn btn-primary button-previous float-left" value="{{ trans('admin.stage_before') }}">
                        <input type="button" onclick="" class="btn btn-primary button-next float-right" value="{{ trans('admin.next_level') }}">
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="tab4">
                <div class="card has-shadow">
                    <div class="card-header bordered no-actions"><h4>{{ trans('admin.invoice_and_confirmation') }}</h4></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-7">
                                <table class="table mb-0 table-details">
                                    <tbody>
                                    <tr>
                                        <td width="200">{{ trans('admin.type') }}</td>
                                        <td class="col-color" id="type_holder"></td>
                                    </tr>
                                    <tr>
                                        <td width="200">{{ trans('admin.title') }}</td>
                                        <td class="col-color" id="title_holder"></td>
                                    </tr>
                                    <tr>
                                        <td width="200">{{ trans('admin.category') }}</td>
                                        <td class="col-color" id="category_holder"></td>
                                    </tr>
                                    <tr>
                                        <td width="200">{{ trans('admin.language') }}</td>
                                        <td class="col-color" id="language_holder"></td>
                                    </tr>
                                    <tr>
                                        <td width="200">{{ trans('admin.text_type') }}</td>
                                        <td class="col-color" id="text_holder"></td>
                                    </tr>
                                    <tr>
                                        <td width="200">{{ trans('admin.expertise_guarantee') }}</td>
                                        <td  class="col-color"id="guarantee_holder"></td>
                                    </tr>
                                    <tr>
                                        <td width="200">{{ trans('admin.number_of_pages') }}</td>
                                        <td class="col-color" id="page_count_holder"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-5" id="price-list-holder"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="button" onclick="" class="btn btn-primary button-previous float-left" value="{{ trans('admin.stage_before') }}">
                        <input type="submit" class="btn btn-primary float-right" value="{{ trans('admin.final_registration') }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

    <div class="modal fade" id="user_search" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('admin.search_username...') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="user" autocomplete="off" placeholder="{{ trans('admin.user_name') }}">
                    </div>
                    <div class="row mt-2" id="user_container">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="/assets/user/vendors/js/bootstrap-wizard/bootstrap.wizard.min.js"></script>
    <script src="/assets/user/vendors/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>
    <script src="/assets/user/vendors/js/simple_upload/simpleUpload.min.js"></script>
    <script>
        $(function (){
            $('.jqte').jqte({
                source:false,
                link:false,
                unlink:false,
                remove:false,
                format:false,
                strike:false,
                sub:false,
                sup:false,
                outdent:false,
                indent:false,
                rule:false
            });
        })
    </script>
    <script>
        $(function (){
            $('.capture-click').on('click', function (){
                $('.capture-click').find('input').removeAttr('checked');
               $(this).find('input').attr('checked','checked').trigger('change');
            });
        })
    </script>
    <script>
        $('input[name="type"]').on('change', function (){
            if($(this).val() == 'private'){
                $('#users').show();
            }else{
                $('#users').hide();
            }
        })
    </script>
    <script>
        $(function(){
            $("#rootwizard").bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabShow:function(f,a,d){var c=a.find("li").length;var e=d+1;var b=(e/c)*100;$("#rootwizard .progressbar").css({width:b+"%"})},
                onTabClick:function (){return false},
                onNext:function (tab, navigation, index){
                    if(index == 1){
                        let type = $('input[name="type"]:checked').val();
                        if(type == 'online'){
                            let credit = {!! $User->credit ?? 0 !!};
                            if(credit < {!! getOption('default_min_online_credit',0) !!}){
                                showMsg('{{ trans('admin.to_register_your_account_online_order') }} {!! getOption('default_min_online_credit',0) !!} {{ trans('admin.charge_usd') }}');
                                return false;
                            }else{
                                window.location.href = '/user/online/new';
                                return false;
                            }
                        }
                    }
                    if(index == 2){
                        let title       = $('input[name="title"]');
                        let guarantee   = $('input[name="guarantee_amount"]');
                        let day         = $('input[name="day"]');
                        let hour        = $('input[name="hour"]');
                        let description = $('textarea[name="description"]');
                        let type        = $('input[name="type"]:checked').val();
                        if(title.val() == ''){
                            $(title).focus();
                            window.scroll({
                                top: $(title).position().top,
                                left: 0,
                                behavior: 'smooth'
                            });
                            return false;
                        }
                        if(guarantee.val() == ''){
                            $(guarantee).focus();
                            window.scroll({
                                top: $(guarantee).position().top,
                                left: 0,
                                behavior: 'smooth'
                            });
                            return false;
                        }
                        if(description.val() == ''){
                            $('.jqte_editor').focus();
                            window.scroll({
                                top: $('.jqte_editor').position().top - 120,
                                left: 0,
                                behavior: 'smooth'
                            });
                            return false;
                        }
                        if(day.val() == ''){
                            $(day).focus();
                            return false;
                        }
                        if(hour.val() == ''){
                            $(hour).focus();
                            return false;
                        }
                        if(type == 'private'){
                            if($('input[name="contractor_user"]').val() == ''){
                                $('input[name="contractor_user"]').focus();
                                window.scroll({
                                    top: $('input[name="contractor_user"]').position().top,
                                    left: 0,
                                    behavior: 'smooth'
                                });
                                return false;
                            }
                        }
                    }
                    if(index == 3){
                        let type = $('input[name="type"]:checked').val();
                        switch (type){
                            case "public":
                                type = '{{ trans('admin.general') }}';
                                break;
                            case "private":
                                type = '{{ trans('admin.private') }}';
                                break;
                            case "online":
                                type = '{{ trans('admin.online') }}';
                                break;
                        }
                        $('#type_holder').text(type);
                        $('#title_holder').text($('input[name="title"]').val());
                        $('#category_holder').text($('select[name="category_id"] option:selected').text());
                        $('#language_holder').text($('select[name="language_id"] option:selected').text());
                        $('#text_holder').text($('select[name="text_id"] option:selected').text());
                        $('#guarantee_holder').text($('input[name="guarantee_amount"]').val());
                        $('#page_count_holder').text($('input[name="page_count"]').val());


                        $.get('/user/project/price/'+$('select[name="category_id"] option:selected').val(), function (data){
                            $('#price-list-holder').html(data);
                        });


                    }
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    });
                },
                onPrevious:function (){
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    <script>
        $(function (){
            $('#upload-file-btn').on('click', function (){
               $('#upload').click();
            });
        })
    </script>
    <script>
        $(document).ready(function(){

            $('#upload').change(function(){

                $(this).simpleUpload("/user/project/upload", {
                    start: function(file){
                        this.block          = $('<div class="upload-block"><span>'+file.name+'</span></div>');
                        this.progressBlock  = $('<div class="progress"></div>');
                        this.progressBar    = $('<div class="progress-bar progress-bar-striped bg-primary"></div>');
                        this.progressBlock.append(this.progressBar);
                        this.block.append(this.progressBlock);
                        $('#uploads').append(this.block);
                    },

                    progress: function(progress){
                        this.progressBar.width(progress + "%");
                    },

                    success: function(data){
                        this.progressBlock.remove();
                        if (data.success) {
                            let deleteIcon = '<i class="fas fa-times-circle delete-upload-file" data-file="'+data.file+'" style="color: red;padding-left: 10px;cursor: pointer;"></i>';
                            let formatDiv = $('<input type="hidden" name="file[]">').val(data.file);
                            this.block.append(formatDiv);
                            this.block.append(deleteIcon);
                        } else {
                            var error = data.message;
                            var errorDiv = $('<div class="error"></div>').text(error);
                            this.block.append(errorDiv);
                        }

                    },

                    error: function(error){
                        //upload failed
                        this.progressBar.remove();
                        var error = error.message;
                        var errorDiv = $('<div class="error mb-2"></div>').text(error);
                        this.block.append(errorDiv);
                    }

                });

            });

        });
    </script>
    <script>
        $(function (){
           $('body').on('click','.delete-upload-file', function (){
              let file = $(this).attr('data-file');
              $('input[value="'+file+'"]').parent().remove();
           });
        });
    </script>
    <script>
        $(function (){
            $('#user').on('keyup', function (){
                let q = $(this).val();
                if(q.length > 2){
                    $.get('/user/project/ajax/user?q='+q, function (data){
                        $('#user_container').html(data);
                    });
                }
            });


            $('body').on('click touch','.select-user',function (){
                $('#contractor_username').val($(this).attr('user-name'));
                $('input[name="contractor_id"]').val($(this).attr('user-id'));
                $('#user_search').modal('hide');
            });
        })
    </script>
@stop
