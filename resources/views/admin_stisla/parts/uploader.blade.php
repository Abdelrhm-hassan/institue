<div style="position: relative" id="{!! $name !!}-container">
    <i class="la la-close" id="{!! $name !!}-close"></i>
    <img @if($value != null && file_exists(getcwd().$value)) src="{!! $value !!}" @else src="https://via.placeholder.com/{!! $width ?? '150' !!}x{!! $height ?? '150' !!}?text={!! $text ?? '' !!}" @endif width="100%" height="auto" id="{!! $name !!}-id" style="cursor: pointer;margin: 0 auto 0; display: block;" class="img-thumbnail">
    <input type="file" accept="image/x-png,image/gif,image/jpeg" id="{!! $name !!}-uploader" style="display: none;">
    <input type="hidden" name="{!! $name !!}" id="upload-{!! $name !!}" value="{!! $value ?? '' !!}">
    <script>
        $(function () {
            $('#{!! $name !!}-id').click(function () {
                $('#{!! $name !!}-uploader').click();
            });
            $('#{!! $name !!}-uploader').change(function () {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("{!! $name !!}-uploader").files[0]);
                oFReader.onload = function (oFREvent) {
                    var form = new FormData();
                    form.append('image',$('#{!! $name !!}-uploader').prop('files')[0]);
                    document.getElementById("{!! $name !!}-id").src = oFREvent.target.result;
                    jQuery.ajax({
                        type: 'POST',
                        url:"{!! $url !!}",
                        data: form,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#upload-{!! $name !!}').val(response);
                            $('#{!! $name !!}-close').show();
                        }
                    });
                };
            });
            $('#{!! $name !!}-close').click(function () {
                $('#{!! $name !!}-id').attr("src","https://via.placeholder.com/{!! $width ?? '150' !!}x{!! $height ?? '150' !!}?text={!! $text ?? '' !!}");
                $('#upload-{!! $name !!}').val('');
                $('#{!! $name !!}-close').hide();
            })
        })
    </script>
    <style>
        #{!! $name !!}-close{
            position: absolute;
            top: 10px;
            left: 10px;
            cursor: pointer;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px;
            font-size: 0.8em;
            z-index: 1021;
            opacity: 0.9;
            @if($value == null || !file_exists(getcwd().$value))
                display: none;
            @endif
        }
    </style>
</div>
