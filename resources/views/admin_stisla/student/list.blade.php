@extends('admin_stisla.layout.layout')
@section('title',trans('admin.students'))
@section('page')
<style>
    .dt-buttons{
        position: absolute;
        left: 10px;
        color: blue !important
    }
</style>
{{-- <div class="card has-shadow">
    <div class="card-header bordered no-actions d-flex align-items-center">
        <h4>{{ trans('admin.display_filter') }}</h4>
    </div>
    <form>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>{{ trans('admin.user_name') }}</label>
                    <input type="text" class="form-control" name="username" value="{!! $_GET['username'] ?? '' !!}">
                </div>
                <div class="col-md-3">
                    <label>{{ trans('admin.email') }}</label>
                    <input type="email" class="form-control" name="username" value="{!! $_GET['email'] ?? '' !!}">
                </div>
                <div class="col-md-3">
                    <label>{{ trans('admin.phone_number') }}</label>
                    <input type="text" class="form-control" name="phone" value="{!! $_GET['phone'] ?? '' !!}">
                </div>
                <div class="col-md-3">
                    <label>{{ trans('admin.status') }}</label>
                    <select name="mode" class="form-control custom-select">
                        <option value="">{{ trans('admin.all') }}</option>
                        <option value="active">{{ trans('admin.active') }}</option>
                        <option value="deactive">{{ trans('admin.inactive') }}</option>
                        <option value="banned">{{ trans('admin.blocked') }}</option>
                    </select>
                </div>
            </div>
        </div>
       
    </div>
    <div class="card-footer text-right">
        <input type="submit" class="btn btn-primary" value="{{ trans('admin.search') }}">
    </div>
    </form>
</div> --}}
    <div class="card has-shadow">

        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.students') }}</h4>
            {{-- <button id="exportButton" class="btn  btn-danger clearfix"><span class="fa fa-file-pdf-o"></span> Export to PDF</button> --}}

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table id="table_id" class="table mb-0">

                    <thead>
                    <tr>
                        <th>num</th>
                        <th>photo</th>
                        <th>{{ trans('admin.name') }}</th>
                        <th class="text-center">{{ trans('admin.email') }}</th>
                        <th class="text-center">{{ trans('admin.phone_number') }}</th>
                        <th class="text-center">{{ trans('admin.level') }}</th>
                        <th class="text-center">{{ trans('admin.gpa') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $item)
                        <td>{{$loop->iteration}}</td>
                        <td class="text-center">  
                              <img src="{{ asset('assets/student/img') }}/{{$item->photo}}" class="circle" style="border-radius: 40px" width="80" height="80">&nbsp;
                                </td>
                                <td class="text-center">{!! $item->name ?? '' !!}</td>
                                <td class="text-center">{!! $item->email ?? '' !!}</td>
                                <td class="text-center">{!! $item->phone ?? '' !!}</td>
                                <td class="text-center">{!! $item->className->name !!}</td>
                                <td class="text-center">{!! $item->grade !!}</td>
                                <td class="text-center">{!! getMode('user', $item->status) !!}</td>
                                <td class="text-center">
                                    <a title="{{ trans('admin.login_to_the_user_panel') }}" target="_blank" href="/admin/user/login/{!! $item->id !!}"><i class="fas fa-user-secret"></i></a>

                                    <a title="{{ trans('admin.view_user_profiles') }}" href="/admin/student/show/{!! $item->id !!}"><i class="fas fa-eye"></i></a>
                                    <a class="" href="/admin/student/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                    <a class="delete-item" href="/admin/student/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
     <!-- Datatable Dependency start -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
 
     <!-- Datatable Dependency end -->
<script type="text/javascript">
   $(document).ready(function() {
            $('#table_id').DataTable({
                "searching": true,
                "autoWidth": false,



                dom: 'Bfrtip',
                responsive: true,
                pageLength: 25,
                // lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

                buttons: [ 
                  {
                        extend:    'excelHtml5',
                        text:      '<i class=" fa fa-file-excel">  </i> Excel',
                        title:'All student in New cairo acadamy',
                        titleAttr: 'Excel',
                        className: 'btn btn-success export excel',
                       
                    },
                    {
                        extend:    'pdfHtml5',
                        text:      ' <i class="fa fa-file-pdf"> </i> PDF',
                        title:'All student in New cairo acadamy',
                        titleAttr: 'PDF',
                        className: 'btn btn-danger export pdf',
                        // exportOptions: {
                        //     columns: [ 0, 2,3,4,5 ]
                        // },
                    },
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"></i> print',
                        title:'All student in New cairo acadamy',
                        titleAttr: 'print ',
                        className: 'btn btn-app export print',
                        // exportOptions: {
                        //     columns: [ 0, 2,3,4,5 ]
                        // },
                    },
                  
                ]


            });
        });
    </script>
@endsection
