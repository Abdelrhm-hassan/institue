<style>
    .field-container-{!! $name !!}{
        background: rgba(0,100,100,0.3);
        height: 50px;
        border-radius: 6px;
        margin-bottom: 15px;
        padding: 15px 18px;
        color: #fafafa;
        font-weight: bold;
    }
    .field-container-{!! $name !!} .close-item{
        font-weight: bold;
        font-size: 22px;
        position: relative;
        top: -3px;
        cursor: pointer;
    }
    .field-holder-{!! $name !!}{
        display: none;
    }
</style>
<input type="file" style="display: none;" id="upload-field-{!! $name !!}">
<div id="upload-holder-{!! $name !!}">
    @if(isset($value) && $value != null)
        @if($type == 'single' || $type == '' || $type == null)
            <div class="px-4 field-container-{!! $name !!}">
                <div class="row">
                    <input type="hidden" value="{!! $value !!}" @if($type == 'single' || $type == null || $type == '') name="{!! $name !!}" @else name="{!! $name !!}[]" @endif>
                    <i class="fas fa-times close-item"></i>
                    &nbsp;
                    <div class="title-holder" dir="ltr" style="text-align: left;"><a target="_blank" href="{!! $value !!}">{!! str_replace('/bin/file/','',$value) !!}</a></div>
                </div>
                <div class="mt-1"></div>
            </div>
        @endif
        @if($type == 'multi')
            @if(is_array(json_decode($value, true)))
                @foreach(json_decode($value, true) as $val)
                        <div class="field-container-{!! $name !!}">
                            <div class="row">
                                <input type="hidden" value="{!! $val !!}" @if($type == 'single' || $type == null || $type == '') name="{!! $name !!}" @else name="{!! $name !!}[]" @endif>
                                <div class="col-2 text-left">
                                    <i class="fas fa-times close-item"></i>
                                </div>
                                <div class="col-10 title-holder" dir="ltr" style="text-align: left;"><a target="_blank" href="{!! $val !!}">{!! str_replace('/bin/file/','',$val) !!}</a></div>
                            </div>
                            <div class="h-5"></div>
                        </div>
                @endforeach
            @endif
        @endif
    @endif
</div>
<div class="field-holder-{!! $name !!}">
    <div class="px-4 field-container-{!! $name !!}">
        <div class="row">
            <input type="hidden">
            <i class="fas fa-times close-item"></i>&nbsp;&nbsp;&nbsp;
            <div class="title-holder" dir="ltr" style="text-align: left;"></div>
        </div>
        <div class="h-5"></div>
    </div>
</div>
<button class="btn btn-danger" type="button" id="btn-upload-{!! $name !!}">{!! $title ?? trans('admin.click_to_upload_the_file') !!}</button>
<script>
    $(function () {
        $('#btn-upload-{!! $name !!}').click(function (e) {
            e.preventDefault();
            $('#upload-field-{!! $name !!}').click();
        });
        $('#upload-field-{!! $name !!}').change(function () {
            let form = new FormData();
            form.append('file',$('#upload-field-{!! $name !!}').prop('files')[0]);
            $('input[type="submit"]').attr('disabled','disabled');
            jQuery.ajax({
                type: 'POST',
                url:"{!! $url !!}",
                data: form,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $('input[type="submit"]').removeAttr('disabled');
                    let holder = $('.field-holder-{!! $name !!}');
                    let container = $('#upload-holder-{!! $name !!}');
                    holder.find('input').val(response.url);
                    holder.find('.title-holder').html('<a target="_blank" href="'+response.url+'">'+response.name+'</a>');
                    container.html(holder.html());
                    container.find('input').attr('name','@if($type == 'single' || $type == null || $type == ''){!! $name !!}@else{!! $name.'[]' !!}@endif');
                }
            });
        });
        $('input[type="submit"]').removeAttr('disabled');
        $('body').on('click','.close-item', function () {
            $(this).parent().parent().remove();
        })
    });
</script>
