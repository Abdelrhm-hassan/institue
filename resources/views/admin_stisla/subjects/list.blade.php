@extends('admin_stisla.layout.layout')
@section('title',trans('admin.subject'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{!! trans('admin.subject') !!}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/subject/edit/store/{!! $edit->id !!}" @else action="/admin/subject/new/store" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.subject') }}</label>
                            <input type="text" required class="form-control" name="name" value="{!! $edit->name ?? '' !!}">
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
                            <label>{!! trans('admin.semester') !!}</label>
                            <select name="class_id" class="form-control">
                                @foreach ( $class as $classes )
                                <option value="{{$classes->id}}" @if(isset($edit) && $edit->id) selected @endif>{{$classes->level}}</option>

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
                                <th>{!! trans('admin.subject') !!}</th>
                                <th>{!! trans('admin.class_room') !!}</th>
                                <th>semester</th>
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
                                        <td>{!! $item->ClassName->name ?? 's' !!}</td>
                                        <td>{!! $item->ClassName->level ?? 's' !!}</td>
                                        <td>{!! $item->hours ?? '' !!}</td>
                                        <td>{!! $item->price ?? '' !!}</td>
                                        <td class="text-center"> <label class="badge badge-success" > active</label></td>
                                        <td class="text-center">
                                            <a href="/admin/subject/edit/{!! $item->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                            <a class="delete-item" href="/admin/subject/delete/{!! $item->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
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
