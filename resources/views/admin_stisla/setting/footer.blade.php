@extends('admin_stisla.layout.layout')
@section('title',trans('admin.footer'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.menu') }}</h4></div>
        <form method="post" @if(!isset($link)) action="/admin/setting/footer/link/new/store" @else action="/admin/setting/footer/link/edit/store/{!! $link->id !!}" @endif>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label>{{ trans('admin.title') }}</label>
                        <input type="text" class="form-control" name="title" value="{{{ $link->title ?? '' }}}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.link') }}</label>
                        <input type="text" class="form-control text-right" dir="ltr" name="url" value="{!! $link->url ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label>{{ trans('admin.location') }}</label>
                        <select name="type" class="form-control custom-select">
                            <option value="first" @if(isset($link) && $link->type == 'first') selected @endif>{{ trans('admin.the_first_column') }}</option>
                            <option value="second" @if(isset($link) && $link->type == 'second') selected @endif>{{ trans('admin.the_second_column') }}</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <label>{{ trans('admin.arrangement') }}</label>
                        <input type="number" class="form-control text-center" name="sort" value="{!! $link->sort ?? '' !!}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if(!isset($link))
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
            @else
                <input type="submit" class="btn btn-warning" value="{{ trans('admin.edit') }}">
            @endif
        </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.title') }}</th>
                        <th class="text-center">{{ trans('admin.link') }}</th>
                        <th class="text-center">{{ trans('admin.location') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $item)
                        <tr>
                            <td class="text-center">{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! $item->url ?? '' !!}</td>
                            <td class="text-center">
                                @if($item->type == 'first') <span class="badge badge-primary">{{ trans('admin.the_first_column') }}</span> @else <span class="badge badge-success">{{ trans('admin.the_second_column') }}</span> @endif
                            </td>
                            <td class="text-center">
                                <a href="/admin/setting/footer/link/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/setting/footer/link/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.social_networks') }}</h4></div>
        <form method="post" @if(isset($social)) action="/admin/setting/footer/social/edit/store/{!! $social->id ?? '' !!}" @else action="/admin/setting/footer/social/new/store" @endif>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <label>{{ trans('admin.icon') }}</label>
                        <input type="text" dir="ltr" class="form-control text-right filemanager" data-input="icon" id="icon" name="icon" value="{!! $social->icon ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-5">
                        <label>{{ trans('admin.link') }}</label>
                        <input type="text" class="form-control text-right" dir="ltr" name="url" value="{!! $social->url ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-2">
                        <label>{{ trans('admin.order') }}</label>
                        <input type="number" class="form-control text-center" name="sort" value="{!! $social->sort ?? '' !!}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if(!isset($social))
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
            @else
                <input type="submit" class="btn btn-warning" value="{{ trans('admin.edit') }}">
            @endif
        </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('admin.icon') }}</th>
                        <th class="text-center">{{ trans('admin.link') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($socials as $item)
                        <tr>
                            <td class="text-center"><img src="{!! $item->icon !!}" style="max-width: 36px;height: auto"></td>
                            <td class="text-center">{!! $item->url ?? '' !!}</td>
                            <td class="text-center">
                                <a href="/admin/setting/footer/social/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/setting/footer/social/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
