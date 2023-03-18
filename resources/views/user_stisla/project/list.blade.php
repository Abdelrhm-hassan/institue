@extends('user_stisla.layout.layout')
@section('title',trans('admin.project_list'))
@section('page')
    <style>
        .card{
            position: relative;
        }
        .card-footer{
            background-color: #FCFCFC;
            border-top: 1px solid rgba(0,0,0,0.1);
        }
        .line-details{
            position: relative;
            font-size: .9em;
            color: #040505;
            margin-bottom: 14px;
        }
        .line-details svg{
            position: relative;
            top: 0px;
            font-size: 1.2em;
        }
    </style>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{!! trans('admin.search') !!}</h4></div>
                <div class="card-body">
                    <form id="filter-form">
                        <div class="form-group">
                            <label>{{ trans('admin.title') }}</label>
                            <div class="input-group">
                                <input type="text" value="{!! $_GET['title'] ?? '' !!}" name="title" class="form-control" placeholder="{{ trans('admin.search_title_and_text...') }}">
                                <input type="submit" class="btn btn-primary" style="border-radius: 0;border-right-width: 0" value="{{ trans('admin.search') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.category') }}</label>
                            <hr style="margin-top: 4px;margin-bottom: 15px;">
                            @foreach(getCategory() as $category)
                                <input type="checkbox" name="category[]" @if(isset($_GET['category']) && in_array($category->id,$_GET['category'])) checked @endif value="{!! $category->id !!}">&nbsp;{!! $category->title ?? '' !!}
                                <div style="height: 8px;"></div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.language') }}</label>
                            <hr style="margin-top: 4px;margin-bottom: 15px;">
                            @foreach(getLanguageList() as $language)
                                <input type="checkbox" name="language[]" @if(isset($_GET['language']) && in_array($language['id'],$_GET['language'])) checked @endif value="{!! $language['id'] !!}">&nbsp;{!! $language['title'] ?? '' !!}
                                <div style="height: 8px;"></div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.text_type') }}</label>
                            <hr style="margin-top: 4px;margin-bottom: 15px;">
                            @foreach(getTextList() as $text)
                                <input type="checkbox" name="text[]" @if(isset($_GET['text']) && in_array($text['id'],$_GET['text'])) checked @endif value="{!! $text['id'] !!}">&nbsp;{!! $text['title'] ?? '' !!}
                                <div style="height: 8px;"></div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            @foreach($list as $item)
                <div class="card has-shadow">
                    <div class="card-header card-01 bordered no-actions d-flex justify-content-between">
                        <span>[#{!! $item->id !!}]&nbsp;&bull;&nbsp;<a href="/user/project/details/{!! $item->id !!}"><b style="color: #E76C7D">{!! $item->title ?? '' !!}</b></a></span>
                        <label class="badge badge-success">{!! getJDate($item->created_at) !!}</label>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-2 text-center">
                                <a href="/user/profile/view/{{ $item->user_id }}">
                                    @if(isset($item->user) && $item->user->avatar != null && file_exists(getcwd().$item->user->avatar))
                                        <img src="{{ avatar($item->user->avatar,'site') }}" width="80" height="80" class="rounded-circle" style="border: 3px solid rgba(0,0,0,0.3)">
                                    @else
                                        <img src="/assets/user/img/avatar.png" width="80" height="80" class="rounded-circle" style="border: 3px solid rgba(0,0,0,0.3)">
                                    @endif
                                    <b class="d-block mt-2">{{ $item->user->name ?? '-'  }}</b>
                                </a>
                            </div>
                            <div class="col-12 col-md-8">
                                {!! getTextCount(strip_tags($item->description),200) ?? '' !!}
                                @if(is_array(json_decode($item->tags,true)))
                                <div class="py-2">
                                    @foreach(json_decode($item->tags,true) as $tag)
                                        <a href="/user/project/list?tag={!! $tag !!}" class="mt-2 mt-md-0 badge badge-success p-2">{!! $tag !!}</a>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="line-details"><span class="iconify" data-icon="emojione-monotone:eye-in-speech-bubble" data-inline="false"></span>&nbsp;<strong>{!! $item->view ?? 0 !!}&nbsp;{{ trans('admin.visit') }}</strong></div>
                                <div class="line-details"><span class="iconify" data-icon="foundation:comment-quotes" data-inline="false"></span>&nbsp;<strong>{!! $item->offers_count ?? 0 !!}&nbsp;{{ trans('admin.proposal') }}</strong></div>
                                <div class="line-details"><span class="iconify" data-icon="foundation:page-multiple" data-inline="false"></span>&nbsp;<strong>{!! $item->page ?? 0 !!}&nbsp;{{ trans('admin.page') }}</strong></div>
                                @if(checkOffer($User->id,$item->id))
                                    <div class="line-details" style="color: red;"><span class="iconify" data-icon="bx:bxs-offer" data-inline="false"></span>&nbsp;<strong>{{ trans('admin.common') }}</strong></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bordered no-actions d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
                        <span class="pb-2 pb-md-0"><span>{{ trans('admin.deadline_for_the_project') }}</span>&nbsp;:&nbsp;<span style="color: red;font-weight:bold;">{!! processTime($item->day,$item->hour) !!}</span></span>
                        <span class="pb-2 pb-md-0"><span class="badge badge-warning">{!! $item->category->title ?? '' !!}</span></span>
                        <span class="pb-2 pb-md-0">{!! getMode('project',$item->mode) !!}</span>
                        <a class="pb-2 pb-md-0" href="/user/project/details/{!! $item->id !!}">  {{ trans('admin.view_project') }}&nbsp;&raquo;</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
@section('script')
    <script>
        $(function (){
           $('input[type="checkbox"]').on('click', function (){
              $('#filter-form').submit();
           });
        });
    </script>
@stop

