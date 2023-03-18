@extends('admin_stisla.layout.layout')
@section('title',trans('admin.index'))
@section('page')
    <div class="alert alert-warning" role="alert">
        <strong>{{ trans('admin.all_inputs_can_use_Html_and_Css_code') }}</strong>
    </div>
    <form method="post" action="/admin/setting/store">
        <div class="card has-shadow">
            <div class="card-header bordered no-actions"><h4>{{ trans('admin.top_box') }}</h4></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ trans('admin.long_text_header') }}</label>
                        <textarea class="form-control" rows="10" style="height: 300px;" name="index_header_text">{!! getOption('index_header_text') !!}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label>{{ trans('admin.the_title_of_the_first_key') }}</label>
                                <input type="text" class="form-control text-center" name="index_header_btn_1_text" value="{{{ getOption('index_header_btn_1_text') }}}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label>{{ trans('admin.the_title_of_the_second_key') }}</label>
                                <input type="text" class="form-control text-center" name="index_header_btn_2_text" value="{{{ getOption('index_header_btn_2_text') }}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label>{{ trans('admin.the_first_key_link') }}</label>
                                <input type="text" class="form-control text-right" dir="ltr" name="index_header_btn_1_url" value="{!! getOption('index_header_btn_1_url') !!}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label>{{ trans('admin.the_second_key_link') }}</label>
                                <input type="text" class="form-control text-right" dir="ltr" name="index_header_btn_2_url" value="{!! getOption('index_header_btn_2_url') !!}">
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <div class="card has-shadow">
            <div class="card-header bordered no-actions"><h4>{{ trans('admin.discount_box') }}</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('admin.discount_text_box') }}</label>
                    <input type="text" class="form-control" name="index_discount_box_text" value="{{{ getOption('index_discount_box_text') }}}">
                </div>
            </div>
        </div>
        <div class="card has-shadow">
            <div class="card-header bordered no-actions"><h4>{{ trans('admin.middle_box') }}</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('admin.middle_box_title') }}</label>
                    <input type="text" class="form-control" name="index_middle_box_title" value="{!! getOption('index_middle_box_title') !!}">
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.text_middle_box') }}</label>
                    <textarea class="form-control" style="height: 300px;" rows="10" name="index_middle_box_text">{!! getOption('index_middle_box_text') !!}</textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_title_of_the_first_key') }}</label>
                            <input type="text" class="form-control text-center" name="index_middle_box_btn_1_text" value="{!! getOption('index_middle_box_btn_1_text') !!}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_title_of_the_second_key') }}</label>
                            <input type="text" class="form-control text-center" name="index_middle_box_btn_2_text" value="{!! getOption('index_middle_box_btn_2_text') !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_first_key_link') }}</label>
                            <input type="text" class="form-control text-right" dir="ltr" name="index_middle_box_btn_1_url" value="{!! getOption('index_middle_box_btn_1_url') !!}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_second_key_link') }}</label>
                            <input type="text" class="form-control text-right" dir="ltr" name="index_middle_box_btn_2_url" value="{!! getOption('index_middle_box_btn_2_url') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card has-shadow">
            <div class="card-header bordered no-actions"><h4>{{ trans('admin.down_box') }}</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('admin.Slogan') }}</label>
                    <input type="text" class="form-control" name="index_bottom_box_slogan" value="{{{ getOption('index_bottom_box_slogan') }}}">
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.down_box_title') }}</label>
                    <input type="text" class="form-control" name="index_bottom_box_title" value="{{{ getOption('index_bottom_box_title') }}}">
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.text_box_down') }}</label>
                    <textarea class="form-control" style="height: 300px;" rows="10" name="index_bottom_box_text">{{{ getOption('index_bottom_box_text') }}}</textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_title_of_the_first_key') }}</label>
                            <input type="text" class="form-control text-center" name="index_bottom_box_btn_1_text" value="{{{ getOption('index_bottom_box_btn_1_text') }}}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_title_of_the_second_key') }}</label>
                            <input type="text" class="form-control text-center" name="index_bottom_box_btn_2_text" value="{{{ getOption('index_bottom_box_btn_2_text') }}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_first_key_link') }}</label>
                            <input type="text" class="form-control text-right" dir="ltr" name="index_bottom_box_btn_1_url" value="{{{ getOption('index_bottom_box_btn_1_url') }}}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.the_second_key_link') }}</label>
                            <input type="text" class="form-control text-right" dir="ltr" name="index_bottom_box_btn_2_url" value="{{{ getOption('index_bottom_box_btn_2_url') }}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card has-shadow">
            <div class="card-header bordered no-actions"><h4>{{ trans('admin.photos_of_sections') }}</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.right_header_photo') }}</label>
                            <input type="text" class="form-control text-right filemanager" dir="ltr" name="header_background_image_right" id="header_background_image_right" data-input="header_background_image_right" value="{!! getOption('header_background_image_right') !!}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.left_header_photo') }}</label>
                            <input type="text" class="form-control text-right filemanager" dir="ltr" name="header_background_image_left" data-input="header_background_image_left" id="header_background_image_left" value="{!! getOption('header_background_image_left') !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.object_in_the_middle_of_the_page') }}</label>
                            <input type="text" class="form-control text-right filemanager" dir="ltr" data-input="index_middle_object_image" name="index_middle_object_image" id="index_middle_object_image" value="{!! getOption('index_middle_object_image') !!}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.top_of_the_footer') }}</label>
                            <input type="text" class="form-control text-right filemanager" dir="ltr" data-input="footer_middle_object_image" name="footer_middle_object_image" id="footer_middle_object_image" value="{!! getOption('footer_middle_object_image') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card has-shadow">
        <div class="card-body">
            <input type="submit" class="btn btn-primary" value="{!! trans('admin.save') !!}">
        </div>
    </div>
    </form>
@stop
