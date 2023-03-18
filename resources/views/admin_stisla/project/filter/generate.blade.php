<div class="widget has-shadow" sort="{!! $category->id !!}">
    <div class="widget-header bordered no-actions" style="cursor: all-scroll">
        <i class="la la-times-circle float-right btn-remove-filter-box" style="color: #9c3328;font-size: 1.8em;cursor: pointer;"></i>
        {!! $category->title ?? '' !!}
    </div>
    <div class="widget-body">
        @foreach($filters as $filter)
            @php $rnd = \Illuminate\Support\Str::random(); @endphp
            <div class="form-group">
                <label>{!! $filter->label ?? '' !!}</label>
                <input type="hidden" name="filter[{!! $rnd !!}][type]" value="{!! $filter->type ?? '' !!}">
                <input type="hidden" name="filter[{!! $rnd !!}][title]" value="{!! $filter->title ?? '' !!}">
                <input type="hidden" name="filter[{!! $rnd !!}][filter_id]" value="{!! $filter->id ?? '' !!}">
                <input type="hidden" name="filter[{!! $rnd !!}][category_id]" value="{!! $filter->category_id ?? '' !!}">
                @if($filter->type == 'select')
                    <select name="filter[{!! $rnd !!}][value]" class="form-control">
                        @if(json_decode($filter->value, true))
                            @foreach(json_decode($filter->value, true) as $val)
                                <option value="{!! $val ?? '' !!}">{!! $val ?? '' !!}</option>
                            @endforeach
                        @endif
                    </select>
                @endif
                @if($filter->type == 'text')
                    <input type="text"  required name="filter[{!! $rnd !!}][value]" class="form-control">
                @endif
            </div>
        @endforeach
    </div>
</div>
