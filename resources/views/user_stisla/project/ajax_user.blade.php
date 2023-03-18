@foreach($users as $user)
    <div class="col-12 col-md-6 select-user" user-id="{{ $user->id }}" user-name="{{ $user->name ?? $user->username ?? '' }}" style="cursor: pointer;">
        <div class="d-flex flex-row justify-content-between align-items-center has-shadow p-2">
            <div class="d-flex justify-content-start align-items-center">
                <img src="{{ avatar($user->avatar) ?? '' }}" class="rounded-circle img-thumbnail" style="width: 50px;height: 50px;object-fit: cover">
                <div class="d-flex flex-column ml-2 align-items-center text-left justify-content-start">
                    <span class="ml-1">{{ $user->username ?? '' }}</span>
                    <span class="small text-muted">{{ trans('admin.point') }}:{{ $user->point ?? '0' }}</span>
                </div>
            </div>
            <span class="mr-2 pt-1" style="font-size: 1.6em;color: green;"><i class="la la-check-circle"></i></span>
        </div>
    </div>
@endforeach
