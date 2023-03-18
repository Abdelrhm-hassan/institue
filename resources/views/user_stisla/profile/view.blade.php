@extends('user_stisla.layout.layout')
@section('title',trans('admin.profile'))
@section('page')
    <div class="card has-shadow">
        <div class="card-body" style="height:200px;padding-top:70px;background: rgb(48,58,203);background: linear-gradient(90deg, rgba(48,58,203,1) 0%, rgba(182,50,102,1) 100%);">
            <img src="{!! avatar($profile->avatar) ?? '' !!}" class="circle" style="border-radius: 40px" width="80" height="80">&nbsp;
            &nbsp;
            <span style="color: #ffffff;font-size: 1.3em;">{!! $profile->name ?? '' !!}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                @if($profile->vip > time())
                    <div class="card-body text-center" style="height: 150px;background: rgb(28,86,241);background: linear-gradient(90deg, rgba(28,86,241,1) 0%, rgba(7,222,222,1) 100%);padding-top: 35px;color: white">
                        <span class="la la-check-circle" style="color: white;font-size: 4em;"></span>
                        <div class="h-5" style="height: 5px;"></div>
                        <h5 style="color: white">{{ trans('admin.special_account') }}</h5>
                    </div>
                @else
                    <div class="card-body text-center" style="height: 150px;background: rgb(105,105,106);background: linear-gradient(90deg, rgba(105,105,106,1) 0%, rgba(85,89,89,1) 100%);padding-top: 35px;color: white">
                        <span class="la la-info-circle" style="color: white;font-size: 4em;"></span>
                        <div class="h-5" style="height: 5px;"></div>
                        <h5 style="color: white">{{ trans('admin.normal_account') }}</h5>
                    </div>
                @endif
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.my_profile') }}</h4>
                </div>
                <div class="card-body">
                    <ul style="font-size: .8em;">
                        <li><label>{{ trans('admin.name') }}</label>&nbsp;:&nbsp;<span  style="color: gray">{{{ $profile->name ?? '' }}}</span></li>
                        <hr>
                        <li><label>{{ trans('admin.City') }}</label>&nbsp;:&nbsp;<span style="color: gray">{{{ $profile->city ?? '' }}}</span></li>
                        <hr>
                        <li><label>{{ trans('admin.gender') }}</label>&nbsp;:&nbsp;<span  style="color: gray">@if($profile->gender == 'm'){{ trans('admin.Man') }} @else {{ trans('admin.Female') }} @endif</span></li>
                        <hr>
                        <li><label>{{ trans('admin.registration_date') }}</label>&nbsp;:&nbsp;<span style="color: gray">{!! getJDate($profile->created_at) ?? '' !!}</span></li>
                    </ul>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.skills_acquired') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach(getUserAcceptedSkills($profile->id) as $uSkill)
                            <div class="col-6 pb-2"><i class="fas fa-check-circle position-relative" style="color: green;top: 2px;"></i> {{ $uSkill ?? '' }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.my_specialties') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach(getUserSkill($profile->id) as $Skill)
                            <div class="col-6 pb-2"><i class="fas fa-check-circle position-relative" style="color: green;"></i> {{ $Skill['title'] ?? '' }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{!! trans('admin.about_me') !!}</h4>
                </div>
                <div class="card-body" style="line-height: 180%">{{{ $profile->about_me ?? '' }}}</div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.CV') }}</h4>
                </div>
                <div class="card-body">
                    {{{ $profile->cv ?? '' }}}
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    <h4>{{ trans('admin.comments') }}</h4>
                </div>
                <div class="card-body p-0">
                    @foreach($comments as $comment)
                        <div class="border-bottom d-flex flex-row justify-content-start p-3">
                            <a href="/user/profile/view/{{ $comment->user_id }}" class="has-shadow d-flex flex-column align-items-center justify-content-center p-2" style="width: 150px;">
                                @if(isset($comment->user))<img src="{{ avatar($comment->user->avatar) }}" class="img-thumbnail rounded-circle" style="width: 60px;height: 60px;">@endif
                                <span class="pt-2">{{ $comment->user->name ?? '' }}</span>
                            </a>
                            <div class="d-flex flex-column align-items-start justify-content-between py-1">
                                <span class="px-4">{{ $comment->text ?? '' }}</span>
                                <div class="d-flex flex-row justify-content-start px-4">
                                    <span class="raty" style="font-size: .5em;color: gold;" score="{{ $comment->rate ?? 1 }}"></span>
                                    &nbsp;
                                    <span style="color: green" class="small">{{ trans('admin.project') }}: {{ $comment->project->title ?? '' }}</span>
                                    <span style="color: blue;" class="small px-2">{{ trans('admin.as') }}:
                                    @if($comment->user_id == $comment->project->user_id)
                                                {{ trans('admin.employer') }}
                                            @else
                                                {{ trans('admin.contractor') }}
                                            @endif
                                    </span>
                                    <span style="color: red;" class="small">{{ trans('admin.created_at') }}: {{ getJDate($comment->created_at) }}</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(function (){
           $('.raty').raty({
               score: function (){
                   return $(this).attr('score');
               },
               starType:'i'
           });
        });
    </script>
@stop
