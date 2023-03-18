@extends('user_stisla.layout.layout')
@section('title',trans('admin.blog'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{{ trans('admin.search') }}</h4></div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <input type="text" class="form-control" placeholder="{{ trans('admin.title') }}" name="q" value="{{ $_GET['q'] ?? '' }}">
                                </div>
                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                    <input type="submit" class="btn btn-primary" value="{{ trans('admin.search') }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($list as $item)
            <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                <div class="card" @if(!isMobile()) style="height: 350px;" @endif>
                    <img class="card-img-top" style="height: 200px;border-bottom: 1px solid rgba(0,0,0,0.1);" src="{{ $item->thumbnail ?? '' }}" alt="Card image cap">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h6 class="card-title">{{ $item->title ?? '' }}</h6>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <span class="float-left text-muted position-relative">{{ getJDate($item->created_at) ?? '' }}</span>
                            <a href="/blog/{{ $item->id ?? '' }}" target="_blank" class="mt-2 mb-2 mt-md-0 mb-md-0 btn btn-primary">{{ trans('admin.view_content') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($list->hasPages())
        <div class="text-center mt-4">
            {!! $list->links() !!}
        </div>
    @endif
@stop
