@extends('admin_stisla.layout.layout')
@section('title',trans('admin.filter'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <a href="/admin/product/filter/new/{!! $id !!}">{!! trans('admin.add_new_filter') !!}</a>
        </div>
        <form method="post" @if(isset($edit)) action="/admin/product/filter/edit/store/{!! $edit->id !!}" @else action="/admin/product/filter/new/store/{!! $id !!}" @endif>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.name') }}</label>
                        <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.title') }}</label>
                        <input type="text" class="form-control" name="label" value="{!! $edit->label ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.type') }}</label>
                        <select name="type" id="type" class="form-control">
                            <option value="text" @if(isset($edit) && $edit->type == 'text') selected @endif>{!! trans('admin.text') !!}</option>
                            <option value="checkbox" @if(isset($edit) && $edit->type == 'checkbox') selected @endif>{!! trans('admin.checkbox') !!}</option>
                            <option value="textarea" @if(isset($edit) && $edit->type == 'textarea') selected @endif>{!! trans('admin.textarea') !!}</option>
                            <option value="select" @if(isset($edit) && $edit->type == 'select') selected @endif>{!! trans('admin.select') !!}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group select-items" @if(!isset($edit) || $edit->type != 'select') style="display: none;" @endif>
                    <div class="h-20"></div>
                    <h6 class="add-item" style="color: grey;cursor: pointer;">
                        <i class="la la-plus-circle" style="font-size: 1.7em;position: relative;top: 4px;"></i>
                        {{ trans('admin.add_selector_items') }}
                    </h6>
                    <div class="h-20"></div>
                    <div class="row item-input-container">
                        @if(isset($edit->value) && json_decode($edit->value,true))
                            @foreach(json_decode($edit->value,true) as $value)
                                <div class="col-12 col-md-4" style="margin-bottom: 10px">
                                    <div class="form-group">
                                        <label>{{ trans('admin.the_amount_of') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{!! $value ?? '' !!}" name="value[]">
                                            <span class="input-group-append remove-item" style="cursor: pointer">
                                                <span class="input-group-text"><i class="fas fa-trash"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="{!! trans('admin.save') !!}">
        </div>
        </form>
    </div>
    <div class="item-input-holder" style="display: none">
        <div class="col-12 col-md-4" style="margin-bottom: 10px">
            <div class="form-group">
                <label>{{ trans('admin.the_amount_of') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="value[]">
                    <span class="input-group-append remove-item" style="cursor: pointer">
                        <span class="input-group-text"><i class="fas fa-trash"></i></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{!! trans('admin.title') !!}</th>
                        <th class="text-center">{!! trans('admin.type') !!}</th>
                        <th class="text-center">{!! trans('admin.description') !!}</th>
                        <th class="text-center">{!! trans('admin.management') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! listType('filter',$item->type) ?? '' !!}</td>
                            <td class="text-center">{!! $item->label ?? '' !!}</td>
                            <td class="text-center">
                                <a href="/admin/product/filter/edit/{!! $id !!}/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/product/filter/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $('#type').on('change', function () {
            if($(this).val() == 'select'){
                $('.select-items').show();
            }else{
                $('.select-items').hide();
            }
        });
        $('.add-item').on('click',function () {
            let input = $('.item-input-holder').html();
            $('.item-input-container').append(input);
        });
        $(document).on('click','.remove-item', function () {
            $(this).parent().parent().parent().remove();
        });
    </script>
@stop
