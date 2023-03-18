@extends('user_stisla.layout.layout')
@section('title',trans('admin.project_details').$project->title)
@section('page')
    <style>
        .h-10{
            height: 10px;
        }
    </style>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions align-items-center d-flex justify-content-between">
            <div class="d-flex flex-row justify-content-start align-items-center">
                <a href="/user/profile/view/{{ $project->user_id ?? '' }}" target="_blank">
                @if($project->user->avatar != null && file_exists(getcwd().$project->user->avatar))
                    <img src="{!! $project->user->avatar ?? '' !!}" class="avatar rounded-circle" style="border: 2px solid rgba(0,0,0,0.3)" width="50" height="50">
                @else
                    <img src="/assets/user/img/avatar.png" class="avatar rounded-circle" style="border: 2px solid rgba(0,0,0,0.3)" width="50" height="50">
                @endif
                <span class="ml-2">{!! $project->user->name ?? trans('admin.admin') !!}</span>
                </a>
            </div>
            <span>{{ $project->title ?? '' }}</span>
            <span>
                <label style="color: #040505" class="mb-0">{{ trans('admin.created_on') }} </label>&nbsp;:&nbsp;<label style="color: #040505" class="mb-0">&nbsp;{!! getJDate($project->created_at) !!}&nbsp;</label>
            </span>
            @if($User->id == $project->user_id && $project->contractor_id == null)
            <span>
                <a href="javascript:void(0);" data-target="#modal_delete" data-toggle="modal" class="btn btn-danger">{{ trans('admin.delete') }}</a>
            </span>
            @endif
        </div>
        <div class="card-body p-0" @if($project->mode == 'publish') style="background-color: rgba(116, 172, 41, 0.9);color: white" @endif @if($project->mode == 'process') style="background-color: #AAE4FF;color: #000" @endif>
            <div class="p-5">
                <div class="row">
                    <div class="col-4 @if(isRtl()) text-right @else text-left @endif">{{ trans('admin.open') }}</div>
                    <div class="col-4 text-center">{{ trans('admin.in_process') }}</div>
                    <div class="col-4 @if(isRtl()) text-left @else text-right @endif">{{ trans('admin.end') }}</div>
                </div>
                <div class="h-10"></div>
                <div class="progress" style="background-color: white">
                    <div class="progress-bar progress-lg progress-bar-striped progress-bar-animated" role="progressbar"
                         @if($project->mode == 'draft') aria-valuenow="0" style="width: 0%" @endif
                         @if($project->mode == 'publish') aria-valuenow="23" style="width: 23.33%" @endif
                         @if($project->mode == 'process') aria-valuenow="67" style="width: 67%" @endif
                         @if($project->mode == 'done' || $project->mode == 'finish') aria-valuenow="100" style="width: 100%" @endif
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="h-10"></div>
                <div class="row">
                    <div class="col-4 @if(isRtl()) text-right @else text-left @endif">{{ trans('admin.submit_a_Contractor_Offer') }}</div>
                    <div class="col-4 text-center">{{ trans('admin.execution_of_the_project_by_the_selected_contractor') }}</div>
                    <div class="col-4 @if(isRtl()) text-left @else text-right @endif">{{ trans('admin.completion_by_the_contractor_and_payment') }}</div>
                </div>
            </div>
            <hr style="background-color: white;color: white">
            <div class="px-5 py-2">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <span>{{ trans('admin.grouping') }}</span>&nbsp;<b>{!! $project->category->title ?? '' !!}</b>
                            </div>
                            <div class="col-12 col-md-4">
                                <span> {{ trans('admin.project_language') }}</span>&nbsp;<b>{!! $project->language->title ?? '' !!}</b>
                            </div>
                            <div class="col-12 col-md-4">
                                <span>{{ trans('admin.text_type') }}</span>&nbsp;<b>{!! $project->text->title ?? '' !!}</b>
                            </div>
                        </div>
                        <div class="h-10"></div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <span>{{ trans('admin.number_of_pages') }}</span>&nbsp;<b>{!! $project->page_count ?? '1' !!}</b>
                            </div>
                            <div class="col-12 col-md-4">
                                <span> {{ trans('admin.pricing') }}</span>&nbsp;<b>{!! $project->budget->title ?? '-' !!}</b>
                            </div>
                            <div class="col-12 col-md-4">
                                <span> {{ trans('admin.warranty_amount:') }}</span>&nbsp;<b>{!! number_format($project->guarantee_amount) ?? '1000' !!} {{ trans('admin.usd') }}</b>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        @if($project->mode == 'publish')
                            <div class="h-10" style="height: 13px;"></div>
                            <span>{{ trans('admin.to_do_this_project') }}</span>
                            <span>{!! processTime($project->day,$project->hour) !!}</span>
                            <span>{{ trans('admin.you_have_time') }}</span>
                        @endif
                        @if($project->mode == 'process')
                            <div class="timer-container p-4 bg-danger">
                                <span id="count_down"></span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="h-10"></div>
            <div class="h-10"></div>
        </div>
    </div>
    @if($User->id == $project->user_id && $project->mode == 'publish')
        <div class="alert alert-warning" role="alert">
            <strong>{{ trans('admin.this_is_your_project_and_you_can_not_submit_a_proposal.Check_the_Suggestions_tab_to_check_user_suggestions.') }}</strong>
        </div>
    @endif
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#details"><label>{{ trans('admin.the_details') }}</label></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#attach"><label>{{ trans('admin.attachments') }}</label></a>
        </li>
        @if($project->mode == 'publish')
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#offer">
               {{ trans('admin.Offers') }} <label class="badge badge-danger">{!! $project->offers_count ?? 0 !!}</label>
            </a>
        </li>
        @endif
        @if(($project->contractor_id == $User->id || $project->user_id == $User->id) && $project->mode != 'publish')
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#contractor"><label>{{ trans('admin.contractor') }}</label></a>
            </li>
        @endif
        @if($project->mode == 'done' &&  ($project->user_id == $User->id || $project->contractor_id == $User->id) && !checkProjectComment($User->id,$project->id))
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#contractor_point"><label>{{ trans('admin.survey') }}</label></a>
            </li>
        @endif
    </ul>
    <div class="tab-content has-shadow" style="background-color: white">
        <div class="tab-pane container-fluid p-3 active" id="details">
            <div class="py-3">
                <p style="line-height: 200%;">{!! $project->description ?? '-' !!}</p>
                @if(isset($project->tags) && $project->tags != '' && is_array(json_decode($project->tags,true)))
                    <div class="h-10"></div>
                    @foreach(json_decode($project->tags,true) as $tag)
                        <a href="/user/project/list?tag={!! $tag !!}" class="badge badge-success p-2">{!! $tag !!}</a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane container-fluid fade p-3" id="attach">
            <div class="py-3">
                <div class="alert alert-info" role="alert">
                    <strong>{{ trans('admin.in_this_section_you_can_see_the_files_shared_by_the_employer') }}</strong>
                </div>
                <div class="alert alert-warning" role="alert">
                    <strong>{{ trans('admin.do_not_forget_that_before_submitting_any_offer,_you_should_carefully_review_the_project_file_and_send_the_price_offer_according_to_the_workload') }}</strong>
                </div>
                <div class="py-1">
                    @if(is_array(json_decode($project->file,true)))
                        @foreach(json_decode($project->file,true) as $file)
                            <div class="py-1">
                                <a href="{!! url('/') !!}/bin/project/{!! $file !!}" target="_blank"><i class="la la-file-archive-o"></i>&nbsp;{{ trans('admin.attached_file') }}</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane container-fluid fade p-3" id="offer" @if($project->user_id == $User->id) style="margin: 0!important;padding: 0!important;max-width: 100%!important;" @endif>
            @if($project->user_id != $User->id && $project->mode == 'publish')
                <div class="py-4">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <form method="post" action="/user/project/details/{!! $project->id !!}/offer">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label>{{ trans('admin.total_price') }}</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control text-center" value="{{{ $offer->amount ?? '' }}}" name="amount">
                                            <span class="input-group-append"><label class="input-group-text">{{ trans('admin.usd') }}</label></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>{{ trans('admin.total_deposit') }}</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control text-center" name="warranty" value="{{{ $offer->warranty ?? '' }}}">
                                            <span class="input-group-append"><label class="input-group-text">{{ trans('admin.usd') }}</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('admin.description') }}</label>
                                <textarea class="form-control" style="height: 200px;" name="description" rows="7">{{{ $offer->description ?? '' }}}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" @if(isset($offer->id)) value="{{ trans('admin.edit_suggestion') }}" @else value="{{ trans('admin.submit_a_proposal') }}" @endif>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-4">
                        @if(isset($offer) && isset($offer->id))
                            <div class="alert alert-warning" role="alert">
                                <strong>{{ trans('admin.you_have_sent_a_price_offer_in_this_project.You_can_check_or_change_your_offer_from_the_right_form.Also_through_this') }}</strong>
                                <a href="/user/project/offer">{{ trans('admin.link') }}</a>
                                <strong>{{ trans('admin.you_can_delete_your_offer_in_this_project') }}</strong>
                            </div>
                        @endif
                        <div class="card has-shadow" style="background-color: #0c5460;border-radius: 6px;">
                            <div class="card-body" style="color: white;line-height: 180%;text-align: justify">
                                <span>{!! getOption('project_send_request') !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <a class="card-header collapsed" data-toggle="collapse" href="#systemPrice">
                                <div class="card-title mb-0">{{ trans('admin.system_rate') }}</div>
                            </a>
                            <div class="card-body collapse p-0" id="systemPrice">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('admin.title') }}</th>
                                        <th class="text-center" width="300px;">{{ trans('admin.price_per_page') }}&nbsp;{{ trans('admin.(usd)') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($prices as $price)
                                        <tr>
                                            <td>{!! $price->language->title ?? '-' !!}</td>
                                            <td class="text-center">{!! number_format($price->price) ?? 0 !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4"></div>
                </div>
                </div>
            @else
                @if($project->mode == 'publish')
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.user') }}</th>
                                <th>{{ trans('admin.description') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.user_rating') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.proposed_price') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.request_a_deposit') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.management') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->offers as $of)
                            <tr>
                                <td>{!! $of->user->name ?? '-' !!}</td>
                                <td>{!! $of->description ?? '-' !!}</td>
                                <td class="text-center">{!! $of->user->point ?? '0' !!}</td>
                                <td class="text-center">{!! number_format($of->amount) ?? '0' !!}</td>
                                <td class="text-center">{!! number_format($of->warranty) ?? '0' !!}</td>
                                <td class="text-center" width="100">
                                    @if($project->mode == 'publish')
                                        <a href="javascript:void(0);" data-mode="chat" data-user="{{ $of->user_id ?? '' }}" title="{{ trans('admin.chat_with_the_user') }}"><span class="iconify" data-icon="bi:chat-square-dots-fill" style="color: orangered" data-width="18" data-inline="false"></span></a>
                                        <a href="/user/project/accept/{!! $of->id ?? '' !!}" title="{{ trans('admin.approved_as_an_executor') }}"><span class="iconify" style="color: green" data-icon="bx:bxs-message-check" data-width="19" data-inline="false"></span></a>
                                    @endif
                                    @if($project->contractor_id == $of->user_id && ($project->mode == 'process' || $project->mode == 'done'))
                                            <b class="d-block" style="color: green;"><i class="la la-check" style="color: green;"></i>&nbsp;{{ trans('admin.accepted') }}</b>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
        </div>
        <div class="tab-pane container-fluid p-3 fade" id="contractor">
            @if(isset($project->contractor) && ($project->mode == 'process' || $project->mode == 'done'))
                <div class="row mb-3">
                    <div class="col-12 col-md-3">
                        <div class="has-shadow p-3 d-flex justify-content-between align-items-center">
                            <a href="/user/profile/view/{{ $project->contractor_id }}"><img src="{{ avatar($project->contractor->avatar) }}" class="rounded-circle img-thumbnail" width="60" height="60"><span class="pl-2">{{ $project->contractor->name ?? '' }}</span></a>
                            <i class="la la-commenting" style="font-size: 2em;cursor: pointer" title="{{ trans('admin.chat') }}" data-mode="chat" data-user="{{ $project->contractor_id ?? '' }}"></i>
                        </div>
                    </div>
                    @if(isset($project->offer))
                    <div class="col-12 col-md-5">
                        <div class="has-shadow d-flex flex-row align-items-center justify-content-between p-3" style="height: 88px;">
                            <span>{{ trans('admin.the_total_amount_of_the_project') }} :{{ number_format($project->offer->amount) ?? 0 }} {{ trans('admin.usd') }}</span>
                            <span>{{ trans('admin.deposit_pledged') }} : {{ number_format($project->offer->warranty) ?? '0' }} {{ trans('admin.usd') }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="has-shadow d-flex flex-row align-items-center justify-content-between p-3" style="height: 88px;">
                            <span>{{ trans('admin.wallet_credit') }} :{{ number_format($User->credit) ?? 0 }} {{ trans('admin.usd') }}</span>
                            @if($User->credit < ($project->offer->amount - $project->offer->warranty))
                                <a class="btn btn-warning" href="/user/financial/wallet">{{ trans('admin.add_credit') }}</a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

            @endif
            <div class="row">
                @if($project->contractor_id == $User->id)
                    <div class="col-12 col-md-4">
                    <form method="post" action="/user/project/contractor/upload/{{{ $project->id }}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.select_project_file') }}</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{{ trans('admin.send') }}">
                        </div>
                    </form>

                </div>
                @endif
                <div class="col-12 @if($project->contractor_id == $User->id) col-md-8 @else col-md-12 @endif">
                    <div class="table-responsive">
                        <table class="table @if($project->contractor_id == $User->id) table-bordered @endif mb-0">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.title') }}</th>
                                <th class="text-center">{{ trans('admin.file') }}</th>
                                <th class="text-center">{{ trans('admin.postage_date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->title ?? '' }}</td>
                                    <td class="text-center" width="150">@if($project->mode == 'done' || $project->contractor_id == $User->id)<a href="{{ $file->file ?? '' }}" target="_blank">{{ trans('admin.download') }}</a>@else {{ trans('admin.invisible') }} @endif</td>
                                    <td class="text-center" width="200">{{ getJDate($file->created_at) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($project->user_id == $User->id)
                <hr>
                <div class="text-right mt-4 pb-4">
                    @if($project->mode == 'done')
                        @if($project->done_at + (getOption('project_revision_time',1) * 3600) > time())
                        <a data-toggle="modal" data-target="#modalRevision" href="javascript:void(0);" class="btn btn-danger">{{ trans('admin.request_a_project_review') }}</a>
                        @endif
                    @endif
                    @if($project->mode == 'process')<a href="javascript:void(0);" data-toggle="modal" data-target="#modalConfirm" class="btn btn-primary float-left">{{ trans('admin.final_approval_of_the_executor_and_completion_of_the_project') }}</a> @endif
                </div>
            @endif
        </div>
        @if($project->mode == 'done' &&  ($project->user_id == $User->id || $project->contractor_id == $User->id))
            <div class="tab-pane container-fluid p-3 fade" id="contractor_point">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form method="post" action="/user/project/comment/store/{{ $project->id }}">
                            <input type="hidden" name="rate" id="rate">
                            <div class="d-flex flex-row align-items-center justify-content-between" dir="ltr">
                                <span class="raty" style="font-size: 0.8em;color: gold;"></span>
                                <span>{{ trans('admin.your_score_to') }}
                                    @if($User->id == $project->user_id)
                                    {{ trans('admin.contractor') }}
                                    @else
                                    {{ trans('admin.employer') }}
                                    @endif
                                </span>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="text" placeholder="{{ trans('admin.comments') }}...." style="height: 200px;" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="{{ trans('admin.send') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
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
                <form method="post" action="/user/project/revision/new/store/{{ $project->id }}">
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
    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">{{ trans('admin.confirmation_of_project_completion') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ trans('admin.first_of_all,_make_sure_the_file_is_complete.After_confirming_this_option,_the_project_amount_will_be_credited_to_the_executors_account_and_will_not_be_refundable') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.cancel_and_exit') }}</button>
                    <a href="/user/project/done/{{ $project->id }}" class="btn btn-primary">{{ trans('admin.i_am_sure') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">{{ trans('admin.delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ trans('admin.are_you_sure_you_want_to_delete_this_item?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.cancel_and_exit') }}</button>
                    <a href="/user/project/delete/{{ $project->id }}" class="btn btn-danger">{{ trans('admin.i_am_sure') }}</a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(function (){
            $('.raty').raty({
                starType:'i',
                click: function (score, evt){
                    $('#rate').val(score);
                }
            });
        })
    </script>
    @if($project->mode =='process')
        <script>
            var countDownDate = {!! getProjectProcessTimestamp($project->id) !!};
            var now = {{ time() }};
            var distance = countDownDate - now;
            var x = setInterval(function () {
                --distance;
                var days = Math.floor(distance / (60 * 60 * 24));
                var hours = Math.floor((distance % (60 * 60 * 24)) / (60 * 60));
                var minutes = Math.floor((distance % (60 * 60)) / 60);
                var seconds = Math.floor((distance % 60));

                document.getElementById("count_down").innerHTML = days + " {{ trans('admin.day') }} " + hours + " {{ trans('admin.the_watch') }} "
                    + minutes + " {{ trans('admin.minutes') }} " + seconds + " {{ trans('admin.seconds') }} ";

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("count_down").innerText = "{{ trans('admin.checkout_time') }}";
                }
            }, 1000);
        </script>
    @endif
@stop
