@extends('admin_stisla.layout.layout')
@section('title',trans('admin.list_of_suggestions'))
@section('page')
    <div class="card has-shadow">
        {{-- project Details  --}}
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.project_Details') }}</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label style="font-size: 20px" >{{ trans('admin.title') }}: </label>
                            <strong style="font-size: 20px">{!! $porject->title !!}</strong>
                        </div>
                        <div class="col-12 col-md-4">
                                <label style="font-size: 20px" >{{ trans('admin.status') }}: </label>
                              <strong style="font-size: 20px">{!! $porject->status !!}</strong>
                        </div>
                        <div class="col-12 col-md-4">
                            <label style="font-size: 20px" >{{ trans('admin.description') }}: </label>
                            <strong style="font-size: 14px">{!! $porject->description !!}</strong>
                        </div>
                        <div class="col-12 col-md-4">
                                <label style="font-size: 20px" >{{ trans('admin.grouping') }}: </label>
                              <strong style="font-size: 20px">{!! $porject->category->title !!}</strong>
                        </div>
                        <div class="col-12 col-md-4">
                            <label style="font-size: 20px" >{{ trans('admin.language') }}: </label>
                            <strong style="font-size: 20px">{!! $porject->language->title !!}</strong>
                        </div>
                        <div class="col-12 col-md-4">
                                <label style="font-size: 20px" >{{ trans('admin.text_type') }}: </label>
                              <strong style="font-size: 20px">{!! $porject->text->title !!}</strong>
                        </div>
                        <br>
                        <div class="col-12 col-md-4">
                            <label style="font-size: 20px" >{{ trans('admin.garage') }}: </label>
                            <strong style="font-size: 20px">{!! $porject->user->name !!}</strong>
                        </div>
                        <div class="col-12 col-md-4">
                                <label style="font-size: 20px" >{{ trans('admin.Vehicle_Number') }}</label>
                              <strong style="font-size: 20px">{!! $porject->vehicle_num !!}</strong>
                        </div>
                        <div class="col-12 col-md-4">
                            <label style="font-size: 20px" >{{ trans('admin.project_status') }}</label>
                          <strong style="font-size: 20px">{!! $porject->status !!}</strong>
                    </div>
                    </div>
                    
                </div>
              
               


                  @if ($porject->text->title!=="Multiple")
 
                {{--basic filter  --}}
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Price Filters
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="/admin/offer/{!! $porject->id !!}/highest"> High To Low</a>
                        <a class="dropdown-item" href="/admin/offer/{!! $porject->id !!}/lowest"> Low To High</a>
                        <a class="dropdown-item" href="/admin/offer/{!! $porject->id !!}/newest"> The Newest</a>
                    </div>
                  </div>
            </div>
            @endif
            
           
    </div>
    @if ($porject->text->title=="Multiple")
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>Price Filter</h4>
        </div>
        <form action="" >
        <div class="card-body  ">
            <div class="form-group ">
                <div class="row ">
                    <div class="col-md-4">
                        <label>New</label>
                        <select name="new" class="form-control custom-select">
                            <option value="">Select </option>
                            <option value="n-newest">newest</option>
                            <option value="n-highest">highest</option>
                            <option value="n-lowest">lowest</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Used</label>
                        <select name="used" class="form-control custom-select">
                            <option value="">Select </option>
                            <option value="u-newest">newest</option>
                            <option value="u-highest">highest</option>
                            <option value="u-lowest">lowest</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>commerical</label>
                        <select name="commerical" class="form-control custom-select">
                            <option value="">Select </option>
                            <option value="c-newest">newest</option>
                            <option value="c-highest">highest</option>
                            <option value="c-lowest">lowest</option>
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
    @endif
    
   
    <div class="card has-shadow">
        <div class="card-header bordered no-actions" style="background: orange;color: white"><h4 style="color: white;">{{ trans('admin.all_offers') }}</h4></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                        <th class="text-center">{{ trans('admin.pices_name') }}</th>
                        <th class="text-center">{{ trans('admin.pices_count') }}</th>
                        <th class="text-center">{{ trans('admin.text_type') }}</th>
                        @if ($porject->text->title=="Multiple")
                        <th class="text-center">New Price</th>
                        <th class="text-center">Used Price</th>
                        <th class="text-center">Commerical Price</th>
                        @endif
                        <th class="text-center">{{ trans('admin.total_price') }}</th>
                        <th class="text-center">{{ trans('admin.client') }}</th>
                        <th class="text-center">{{ trans('admin.offer_status') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-center">{!! $item->piece_name!!}</td>
                            <td class="text-center">{!! $item->piece_count!!}</td>
                            <td class="text-center">{!! $item->piece_type!!}</td>
                            @if ($porject->text->title=="Multiple")
                            <th class="text-center">{!! $item->new_price!!}</th>
                            <th class="text-center">{!! $item->used_price!!}</th>
                            <th class="text-center">{!! $item->commerical_price!!}</th>
                            @endif
                            <td class="text-center">{!! $item->piece_price!!}</td>
                            <td class="text-center">{!! $item->user->name !!}</td>
                            <td class="text-center">{!! getMode('offer', $item->mode) ?? '-' !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                           
                            <td class="text-center">
                                <form method="POST" action="{{route('accept.offer')}}">
                                    <input type="text" name="id" value="{!! $item->id !!}" hidden >
                                    <input type="text" name="piece_name" value="{!! $item->piece_name !!}" hidden >
                                    <input type="text" name="project_id" value="{!! $item->project_id !!}" hidden >
                                  <button style="font-size: 10px" type="submit"><i class="fas fa-check" style="border:0px 0px; padding:10px; color: rgb(124, 202, 124);font-size:15px"></i></button>
                                    {{-- <a href="/admin/offer/accept"><i class="fas fa-check" style=" padding:10px; color: rgb(124, 202, 124);font-size:15px"></i></a> --}}
                                    <a class="delete-item" href="/admin/offer/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                                </form>
                              
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
    <script>
        let dropdowns = document.querySelectorAll('.dropdown-toggle')
dropdowns.forEach((dd)=>{
    dd.addEventListener('click', function (e) {
        var el = this.nextElementSibling
        el.style.display = el.style.display==='block'?'none':'block'
    })
})
    </script>
@stop
