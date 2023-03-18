@extends('user_stisla.layout.layout')
@section('title',trans('admin.dashboard'))
@section('page')
    <style>
        .badge-custom{
            display: block;
            font-size: 1.1em;
            padding: 6px;
            margin-bottom: 4px;
        }
        .h-10{
            height: 10px;
        }
        .table-custom{
            font-size: .8em;
        }
        .table-custom th{
            padding: 10px 5px !important;
        }
    </style>
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card has-shadow">
                <div class="card-body" style="padding-bottom: 8px;">
                   
                        <div class=" ">
                            <h3> Welcome : {!! $User->name ?? '' !!}</h3>
                            <h5> code : {!! $User->code ?? '' !!}</h5>
                            <h5> Academic  year : {!! $User->ClassName->name ?? '' !!}</h5>
                            <div class="py-3 d-flex flex-column d-md-block" style="padding-bottom: 0 !important;">
                                <a class="btn btn-primary mb-2 mb-md-0" href="/user/subject">Open Materials </a>
                                <a class="btn btn-warning mb-2 mb-md-0" href="/user/result">your result</a>
                                <a class="btn btn-success mb-2 mb-md-0" href="/user/project/offer">{{ trans('admin.my_suggestions') }}</a>
                            </div>
                        </div>
              
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.ongoing_projects') }}</h4></div>
                <div class="card-body p-0">
                    <table class="table table-custom p-0 m-0">
                        <thead>
                        <tr>
                            <th><span class="px-3">{{ trans('admin.title') }}</span></th>
                            <th width="100" class="text-center">{{ trans('admin.type') }}</th>
                            <th width="100" class="text-center">{{ trans('admin.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @foreach($projects as $item) --}}
                            <tr>
                                <td><a href="/user/project/details/{{ $item->id ?? '' }}">{!! $item->title ?? '' !!}</a></td>
                                <td class="text-center">{{ trans('admin.employer') }}</td>
                                {{-- <td class="text-center">{!! getMode('project', $item->mode) !!}</td> --}}
                            </tr>
                        {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions d-flex justify-content-between">
                    <h4>{{ trans('admin.weblog') }}</h4>
                    <a href="/user/blog/list" style="color: tomato;">{{ trans('admin.view_all_content') }}</a>
                </div>
                <div class="card-body">
                    @foreach($blog as $index=>$post)
                        <div class="">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <img src="{!! $post->thumbnail ?? '' !!}" class="img-thumbnail">
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="h-10"></div>
                                    <h3 style="font-size: 1em"><a href="/blog/{!! $post->id !!}">{!! $post->title ?? '' !!}</a></h3>
                                    <span style="font-size: .8em;">{!! $post->pre_text ?? '' !!}</span>
                                    <div class="h-10"></div>
                                    <span style="font-size: .8em;">{!! getJDate($post->created_at) !!}</span>
                                    <div class="d-flex justify-content-end mt-1">
                                        <a href="/blog/{!! $post->id !!}" target="_blank" class="btn btn-default">{{ trans('admin.view_content') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($index != 2)<hr>@endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        {{-- <div><span> {{ trans('admin.account_type:') }} </span>&nbsp;@if($User->vip > time())<span style="color: {{ $User->category->icon ?? '' }}">{!! $User->category->title ?? '' !!}@else{{ getDefaultUserCategory() }}@endif</span></div> --}}
                        <a href="/user/account" class="btn btn-primary" style="font-size: 0.8em;">{{ trans('admin.account_upgrade') }}</a>
                    </div>
                    <hr>
                    @if($User->vip < time())
                        <div>{{ trans('admin.upgrade_your_account_to_get_more_features_and_privileges!') }}</div>
                        <div class="d-flex justify-content-between mt-4">
                            {{-- <span>{{ trans('admin.offer_per_month') }}: <strong style="color: green">{{ getUserOfferMonthRemain($User->id) ?? '0' }}</strong></span> --}}
                            {{-- <span>{{ trans('admin.project_per_month') }}: <strong style="color: green">{{ getUserProjectMonthRemain($User->id) ?? '0' }}</strong></span> --}}
                        </div>
                    @else
                        <div class="d-flex justify-content-between border-bottom pb-2">
                            <span>{{ trans('admin.executive_fee') }}: <strong style="color: green">%{{ $User->category->commission ?? '-' }}</strong></span>
                            <span style="color: red;">{{ trans('admin.expired') }}: <strong style="color: green">{{ getJDateTimestamp($User->vip) ?? '-' }}</strong></span>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            {{-- <span>{{ trans('admin.offer_per_month') }}: <strong style="color: green">{{ getUserOfferMonthRemain($User->id) ?? '0' }}</strong></span> --}}
                            {{-- <span>{{ trans('admin.project_per_month') }}: <strong style="color: green">{{ getUserProjectMonthRemain($User->id) ?? '0' }}</strong></span> --}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.specialties') }}</h4></div>
                <div class="card-body">
                    <form method="post" action="/user/profile/ajax" id="skill-form">
                        <div class="row">
                        {{-- @foreach(getSkill() as $skill) --}}
                            {{-- <div class="col-12 col-md-6" style="padding-bottom: 8px;"><input type="checkbox" class="skill" @if(checkInJson($skill['id'], $User->skill)) checked @endif name="skill[]" value="{!! $skill['id'] !!}">&nbsp;<span style="font-size: 0.85em;color: #040505;position: relative;top: -4px;">{!! $skill['title'] ?? '' !!}</span></div> --}}
                        {{-- @endforeach --}}
                        </div>
                    </form>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.skills_acquired') }}</h4></div>
                <div class="card-body">
                    <div class="row">
                        {{-- @foreach(getUserAcceptedSkills($User->id) as $uSkill)
                            <div class="col-6 pb-2"><i class="la la-check-circle position-relative" style="color: green;top: 2px;"></i> {{ $uSkill ?? '' }}</div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.announcements') }}</h4></div>
                <div class="card-body">
                    <ul>
                        @foreach($notifications as $index=>$notification)
                            <li>
                                <a href="/user/notification/{!! $notification->id ?? 0 !!}">{!! $notification->title ?? '' !!}</a>
                                <div style="height: 3px"></div>
                                <span class="float-right" style="font-size: .7em;color: #424242">{!! getJDate($notification->created_at) !!}</span>
                            </li>
                            <div style="height: 6px"></div>
                            @if($index<$notifications->count() -1)<hr>@endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $('.skill').on('change', function () {
                let data = $('#skill-form').serialize();
                $.post('/user/profile/ajax',data);
            });
        })
    </script>
@stop
