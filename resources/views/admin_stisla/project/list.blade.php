@extends('admin_stisla.layout.layout')
@section('title',trans('admin.project_list'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.display_filter') }}</h4>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <label>{{ trans('admin.project_number') }}</label>
                            <input type="text" class="form-control" name="id" value="{!! $_GET['id'] ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!! $_GET['title'] ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.garagename') }}</label>
                            <input type="text" class="form-control" name="name" value="{!! $_GET['name'] ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-2">
                            <label>{{ trans('admin.order') }}</label>
                            <select name="order" class="form-control custom-select">
                                <option value="new">{{ trans('admin.new_to_old') }}</option>
                                <option value="old">{{ trans('admin.old_to_new') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control custom-select">
                                <option value="">{{ trans('admin.all') }}</option>
                                <option value="draft">{{ trans('admin.draft') }}</option>
                                <option value="publish">{{ trans('admin.publish') }}</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.search') }}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.title') }}</th>
                        <th class="text-center">{{ trans('admin.garagename') }}</th>
                        <th class="text-center">{{ trans('admin.Vehicle_Number') }}</th>
                        <th class="text-center">{!! trans('admin.grouping') !!}</th>
                        <th class="text-center">{!! trans('admin.status') !!}</th>
                        <th class="text-center">{{ trans('admin.text_type') }}</th>
                        <th class="text-center">{{ trans('admin.created_at') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td style="color: tomato">
                                {!! $item->title ?? '' !!}
                            </td>
                            <td class="text-center"><a href="/admin/user/profile/{{ $item->user_id ?? '' }}">{!! $item->user->name ?? '-' !!}</a></td>
                            <td class="text-center">{{ $item->vehicle_num ?? '' }}</td>
                            <td class="text-center">{!! $item->category->title ?? '' !!}</td>
                            <td class="text-center">{!! getMode('project', $item->mode) !!}</td>
                            <td class="text-center">
                                {!! $item->text->title ?? '' !!}           </td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a href="/admin/offer/{!! $item->id !!}"><i class="fas fa-eye"></i></a>
                                <a href="/admin/project/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/project/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                      
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($list->hasPages())
            <div class="card-footer text-center">
                {!! $list->links() !!}
            </div>
        @endif
    </div>
@stop
@section('script')
    <script>
        $(document).on('click','.vip-checkbox', function () {
           let id = $(this).attr('data-id');
           if($(this).prop('checked')){
               $.get('/admin/project/action?action=vip&id='+id);
           }else{
               $.get('/admin/project/action?action=unvip&id='+id);
           }
        });
    </script>
@stop
