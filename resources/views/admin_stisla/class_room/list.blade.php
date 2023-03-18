@extends('admin_stisla.layout.layout')
@section('title',trans('admin.class_room'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{!! trans('admin.class_room') !!}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/class/edit/store/{!! $edit->id !!}" @else action="/admin/class/new/store" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.class_room') }}</label>
                            <input type="text" required class="form-control" name="name" value="{!! $edit->name ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.class_room') }}</label>
                            <input type="text" required class="form-control" name="class_id" value="{!! $edit->class_id ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.smester') !!}</label>
                            <input type="number" required class="form-control" name="level" value="{!! $edit->level ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.hour') !!}</label>
                            <input type="number" required class="form-control" name="hour" value="{!! $edit->hours ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.price') !!}</label>
                            <input type="number" required class="form-control" name="price" value="{!! $edit->price ?? '' !!}">
                        </div>
                        
                        <div class="form-group">
                            <label>{!! trans('admin.acadmic-year') !!}</label>
                            <select name="year_id" class="form-control">
                                @foreach ( $years as $year )
                                <option value="{{$year->id}}" @if(isset($edit) && $edit->id) selected @endif>{{$year->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{!! trans('admin.save') !!}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card has-shadow">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>{!! trans('admin.class_room') !!}</th>
                                <th>semseter</th>
                                <th>{!! trans('admin.acadmic-year') !!}</th>
                                <th>{!! trans('admin.hour') !!}</th>
                                <th>{!! trans('admin.price') !!}</th>
                                <th class="text-center" width="100">{!! trans('admin.status') !!}</th>
                                <th class="text-center" width="100">{!! trans('admin.management') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                        <td>{!! $item->name ?? '' !!}</td>
                                        <td>{!! $item->level ?? '' !!}</td>
                                        <td>{!! $item->year->name ?? 's' !!}</td>
                                        <td>{!! $item->hours ?? '' !!}</td>
                                        <td>{!! $item->price ?? '' !!}</td>
                                        <td class="text-center"> <label class="badge badge-success" > active</label></td>
                                        <td class="text-center">
                                            <a href="/admin/class/edit/{!! $item->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                            <a class="delete-item" href="/admin/class/delete/{!! $item->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
