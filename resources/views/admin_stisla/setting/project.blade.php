@extends('admin_stisla.layout.layout')
@section('title',trans('admin.project_settings'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.project') }}</h4></div>
        <form method="post" action="/admin/setting/store">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.default_amount_of_expertise_guarantee') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control text-center" name="default_guarantee" value="{!! getOption('default_guarantee') !!}">
                                <span class="input-group-append"><span class="input-group-text">{{ trans('admin.usd') }}</span></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.minimum_amount_of_online_project_wallet') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control text-center" name="default_min_online_credit" value="{!! getOption('default_min_online_credit') !!}">
                                <span class="input-group-append"><span class="input-group-text">{{ trans('admin.usd') }}</span></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.price_per_project_page_online') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control text-center" name="online_price_per_page" value="{!! getOption('online_price_per_page') !!}">
                                <span class="input-group-append"><span class="input-group-text">{{ trans('admin.usd') }}</span></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.number_of_words_that_can_be_displayed_online_project') }}</label>
                            <input type="number" class="form-control text-center" name="online_word_count" value="{!! getOption('online_word_count') !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.default_category_of_online_projects') }}</label>
                            <select name="online_category_id" class="form-control custom-select">
                                @foreach(getCategory('online') as $category)
                                    <option value="{!! $category['id']  !!}" @if(getOption('online_category_id') == $category['id']) selected @endif>{!! $category['title'] ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.online_project_implementing_commission') }}</label>
                            <div class="input-group">
                                <input type="number" min="1" max="100" class="form-control text-center" name="online_commission" value="{{ getOption('online_commission') }}">
                                <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>

                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.default_category_of_other_projects') }}</label>
                            <select name="default_category_id" class="form-control custom-select">
                                @foreach(getCategory('project') as $category)
                                    <option value="{!! $category['id']  !!}" @if(getOption('default_category_id') == $category['id']) selected @endif>{!! $category['title'] ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.project_registration_points') }}</label>
                            <input type="number" class="form-control text-center" name="project_done_point" value="{{ getOption('project_done_point') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.how_long_the_review_request_is_active') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control text-center" name="project_revision_time" value="{{ getOption('project_revision_time') }}">
                                <span class="input-group-append"><span class="input-group-text">{{ trans('admin.hour') }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
            </div>
        </form>
    </div>
@stop
