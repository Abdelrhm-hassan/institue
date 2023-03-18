@extends('admin_stisla.layout.layout')
@section('title',trans('admin.settings'))
@section('page')
    <form method="post" action="/admin/setting/store">
        <div class="row">
        <div class="col-10">
            <div class="card has-shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ trans('admin.site_title') }}</label>
                        <input type="text" class="form-control" name="site_title" value="{!! getOption('site_title','') !!}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.site_description') }}</label>
                        <input type="text" class="form-control" name="site_description" value="{!! getOption('site_description','') !!}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.site_keywords') }}</label>
                        <input type="text" class="form-control" name="site_keyword" value="{!! getOption('site_keyword','') !!}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.site_email') }}</label>
                        <input type="email" class="form-control" dir="ltr" name="site_email" value="{!! getOption('site_email','') !!}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.company_address') }}</label>
                        <input type="text" class="form-control" name="office_address" value="{!! getOption('office_address','') !!}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.contact_numbers') }}</label>
                        <input type="text" class="form-control" name="office_phone" value="{!! getOption('office_phone','') !!}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.Text_about_us') }}</label>
                        <textarea class="form-control" style="height: 200px;" name="footer_about_us">{!! getOption('footer_about_us','') !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.first_copyright') }}</label>
                        <input type="text" class="form-control" name="site_copyright_1" value="{!! getOption('site_copyright_1','') !!}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.second_copyright') }}</label>
                        <input type="text" class="form-control" name="site_copyright_2" value="{!! getOption('site_copyright_2','') !!}">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label>{{ trans('admin.language') }}</label>
                                <select name="site_language" class="form-control custom-select">
                                    <option value="en" @if(getOption('site_language') == 'en') selected @endif>En</option>
                                    <option value="fr" @if(getOption('site_language') == 'fr') selected @endif>Fr</option>
                                    <option value="ar" @if(getOption('site_language') == 'ar') selected @endif>Ar</option>
                                    <option value="es" @if(getOption('site_language') == 'es') selected @endif>Es</option>
                                    <option value="af" @if(getOption('site_language') == 'af') selected @endif>Af</option>
                                    <option value="hi" @if(getOption('site_language') == 'hi') selected @endif>Hi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label>{{ trans('admin.direction') }}</label>
                                <select name="site_direction" class="form-control custom-select">
                                    <option value="rtl" @if(getOption('site_direction') == 'rtl') selected @endif>RTL</option>
                                    <option value="ltr" @if(getOption('site_direction') == 'ltr') selected @endif>LTR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary" value="{{ trans('admin.update') }}">
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card has-shadow">
                <div class="card-header"><h5>{{ trans('admin.logo') }}</h5></div>
                <div class="card-body">
                    {!! imageUploader('/admin/function/upload/image','site_logo',getOption('site_logo', null), 200, 200 ) !!}
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-header"><h5>{{ trans('admin.favicon') }}</h5></div>
                <div class="card-body">
                    {!! imageUploader('/admin/function/upload/image','site_fav',getOption('site_fav', null), 64, 64 ) !!}
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
