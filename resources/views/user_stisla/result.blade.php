@extends('user_stisla.layout.layout')
@section('title',trans('admin.subject'))
@section('page')
<style>
    .dt-buttons{
        position: absolute;
        left: 10px;
        color: blue !important
    }
</style>
    <div class="card has-shadow">

        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.subject') }}</h4>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table id="table_id" class="table mb-0">

                    <thead>
                    <tr>
                        <th>num</th>
                        <th>student {{ trans('admin.code') }}</th>
                        <th class="text-center">{{ trans('admin.subject') }}</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">{{ trans('admin.class_room') }}</th>
                        <th class="text-center">{{ trans('admin.acadmic-year') }}</th>
                        <th class="text-center">degree</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $item)
                        <td>{{$loop->iteration}}</td>
                       
                                <td class="text-center">{!! session('User')->code ?? '' !!}</td>
                                <td class="text-center">{!! $item->subjectName->name ?? '' !!}</td>
                                <td class="text-center">{!! $item->className->level ?? '' !!}</td>
                                <td class="text-center">{!! $item->className->name !!}</td>
                                <td class="text-center">{!! $item->className->year->name !!}</td>
                                <td class="text-center">{!!  $item->garde !!}</td>
                                <td class="text-center">{!!  $item->status !!}</td>
                               
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
                        title:'Your Approved materials in this term',
                        titleAttr: 'Excel',
                        className: 'btn btn-success export excel',
                       
                    },
                    {
                        extend:    'pdfHtml5',
                        text:      ' <i class="fa fa-file-pdf"> </i> PDF',
                        title:'Your Approved materials in this term',
                        titleAttr: 'PDF',
                        className: 'btn btn-danger export pdf',
                        // exportOptions: {
                        //     columns: [ 0, 2,3,4,5 ]
                        // },
                    },
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"></i> print',
                        title:'Your Approved materials in this term',
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
