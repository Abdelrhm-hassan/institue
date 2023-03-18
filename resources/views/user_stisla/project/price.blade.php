<span style="font-size: 1.2em;padding-bottom: 10px;">{{ trans('admin.system_rate') }}</span>

<table class="table table-bordered">
    <thead>
    <tr>
        <th style="padding-bottom: 15px;">{{ trans('admin.type') }}</th>
        <th style="padding-bottom: 15px;" class="text-center">{{ trans('admin.price(USD)') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td style="padding-bottom: 15px;">{!! $item->language->title ?? '' !!}</td>
        <td style="padding-bottom: 15px;" class="text-center">{!! number_format($item->price) !!}</td>
    </tr>
    @endforeach
</table>
