@extends('admin_stisla.layout.layout')
@section('title',trans('admin.newsletter'))
@section('page')
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.title') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.receiver') }}</th>
                        <th class="text-center">{{ trans('admin.creation_date') }}</th>
                        <th class="text-center">{{ trans('admin.postage_date') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! getMode('newsletter', $item->mode) !!}</td>
                            <td class="text-center">{!! listType('newsletter', $item->recipient) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">{!! getJDate($item->sended_at) !!}</td>
                            <td class="text-center">
                                <a href="/admin/newsletter/edit/{!! $item->id !!}" title="{{ trans('admin.edit') }}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/newsletter/delete/{!! $item->id !!}" title="{{ trans('admin.delete') }}"><i class="fas fa-trash"></i></a>
                                @if($item->mode == 'draft')
                                    <a class="confirm-item" href="/admin/newsletter/send/{!! $item->id !!}" title="{{ trans('admin.send') }}"><i class="fas fa-send"></i></a>
                                @endif
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
@endsection
