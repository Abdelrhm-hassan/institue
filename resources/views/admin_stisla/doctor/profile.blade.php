@extends('admin_stisla.layout.layout')
@section('title',trans('admin.profile'))
@section('page')
    <div class="card has-shadow">
        <div class="card-body" style="height:200px;padding-top:70px;background: rgb(48,58,203);background: linear-gradient(90deg, rgba(48,58,203,1) 0%, rgba(182,50,102,1) 100%);">
            <img src="{{ asset('assets/doctor/img') }}/{{$profile->photo}}"" class="circle" style="border-radius: 40px" width="80" height="80">&nbsp;
            &nbsp;
            <span style="color: #ffffff;font-size: 1.3em;">{!! $profile->name ?? '' !!}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                @if($profile->vip == 1)
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
                    {{ trans('admin.my_profile') }}
                </div>
                <div class="card-body">
                    <ul style="font-size: .8em;">
                        <li><label>{{ trans('admin.name') }} :</label><span @if(isRtl()) class="float-right" @else class="-left" @endif style="color: gray">{{{ $profile->name ?? '' }}}</span></li>
                        <hr>
                        <li><label>code  :</label><span @if(isRtl()) class="float-right" @else class="-left" @endif style="color: gray">{{{ $profile->code ?? '' }}}</span></li>
                        <hr>
                        <li><label>{{ trans('admin.email') }} :</label><span @if(isRtl()) class="float-right" @else class="-left" @endif style="color: gray">{{{ $profile->name ?? '' }}}</span></li>
                        <hr>
                        <li><label>linkedin :</label><a href="{{ $profile->linkedin}}" @if(isRtl()) class="float-right" @else class="-left" @endif style="color: gray">{{{ $profile->linkedin ?? '' }}}</a></li>
                        <hr>
                        <li><label>{{ trans('admin.gender') }} :</label><span @if(isRtl()) class="float-right" @else class="flat-left" @endif style="color: gray">{{{ $profile->gender ?? '' }}}</span></li>
                        <hr>
                        <li><label>{{ trans('admin.registration_date') }} :</label><span @if(isRtl()) class="float-right" @else class="float-left" @endif style="color: gray">{!! getJDate($profile->created_at) ?? '' !!}</span></li>
                    </ul>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    {{ trans('admin.skills_acquired') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- @foreach(getUserAcceptedkSills($profile->id) as $uSkill)
                            <div class="col-6 pb-2"><i class="la la-check-circle position-relative" style="color: green;top: 2px;"></i> {{ $uSkill ?? '' }}</div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    {{ trans('admin.my_specialties') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- @foreach(getUserSkill($profile->id) as $Skill)
                            <div class="col-6 pb-2"><i class="la la-check-circle position-relative" style="color: green;top: 2px;"></i> {{ $Skill['title'] ?? '' }}</div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    {!! trans('admin.about_me') !!}
                </div>
                <div class="card-body" style="line-height: 180%">{{{ $profile->bio ?? '' }}}</div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    {{ trans('admin.CV') }}
                </div>
                <div class="card-body"></div>
            </div>
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">
                    {{ trans('admin.employers_comments') }}
                </div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
@stop
