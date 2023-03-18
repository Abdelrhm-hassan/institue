@extends('admin_stisla.layout.layout')
@section('title',trans('admin.price'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.price_list') }}</h4></div>
                <form method="post"  @if(isset($edit)) action="/admin/project/price/edit/store/{!! $edit->id !!}" @else action="/admin/project/price/new/store" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{!! trans('admin.category') !!}</label>
                            <select name="category_id" class="form-control">
                                @foreach(getCategory('project') as $category)
                                    <option value="{!! $category['id'] !!}" @if(isset($eidt) && $edit->category_id == $category['id']) selected @endif>{!! $category['title'] ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.language') !!}</label>
                            <select name="language_id" class="form-control">
                                @foreach(getLanguageList() as $language)
                                    <option value="{!! $language['id'] !!}" @if(isset($edit) && $edit->language_id == $language['id']) selected @endif>{!! $language['title'] ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.price') !!}</label>
                            <input type="text" class="form-control text-center" name="price" value="{!! $edit->price ?? '' !!}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">{!! trans('admin.search') !!}</div>
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <label>{!! trans('admin.category') !!}</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">{!! trans('admin.all') !!}</option>
                                        @foreach(getCategory('project') as $category)
                                            <option value="{!! $category['id'] ?? '' !!}" @if(isset($_GET['category_id']) && $_GET['category_id'] == $category['id']) selected @endif>{!! $category['title'] ?? '' !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-5">
                                    <label>{!! trans('admin.language') !!}</label>
                                    <select name="language_id" class="form-control">
                                        <option value="">{!! trans('admin.all') !!}</option>
                                        @foreach(getLanguageList() as $language)
                                            <option value="{!! $language['id'] ?? '' !!}" @if(isset($_GET['language_id']) && $_GET['language_id'] == $language['id']) selected @endif>{!! $language['title'] ?? '' !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 text-right">
                                    <div class="h-20" style="height: 28px;"></div>
                                    <input type="submit" class="btn btn-primary" value="{!! trans('admin.search') !!}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card has-shadow">
              <div class="card-body p-0">
                  <div class="table-responsive">
                      <table class="table mb-0">
                          <thead>
                          <tr>
                              <th class="text-center">{!! trans('admin.category') !!}</th>
                              <th class="text-center">{!! trans('admin.language') !!}</th>
                              <th class="text-center">{!! trans('admin.price') !!}</th>
                              <th class="text-center">{!! trans('admin.management') !!}</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($list as $item)
                              <tr>
                                  <td class="text-center">{!! $item->category->title ?? '' !!}</td>
                                  <td class="text-center">{!! $item->language->title ?? '' !!}</td>
                                  <td class="text-center">{!! number_format($item->price) ?? '' !!}</td>
                                  <td class="text-center">
                                      <a href="/admin/project/price/edit/{!! $item->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                      <a class="delete-item" href="/admin/project/price/delete/{!! $item->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
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
        </div>
    </div>
@stop
