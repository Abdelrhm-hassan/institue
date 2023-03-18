"use strict"

function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function loginModalMessage(mode,msg){
    if(mode == 'show'){
        $('#modal_message_text').text(msg);
        $('#modal_message').show();
    }else{
        $('#modal_message').hide();
    }
}
$('.btn-mobile-check').on('click', function () {
    loginModalMessage('hide');
   let mobile = $('#mobile').val();
   $('.btn-mobile-check').text('صبر کنید').attr('disabled','disabled');
   $.ajax({
      url:'/ajax/mobile/check/'+mobile,
       success:function (data) {
            if(data == -1){
                loginModalMessage('show','یک شماره موبایل صحیح وارد کنید');
                return $('.btn-mobile-check').text('ورود').removeAttr('disabled');
            }
            if(data == '1'){
                $("#modal_login_form").show();
                $('.btn-mobile-check').hide();
                $('.btn-mobile-login').show();
                $('.btn-mobile-remember').show();
            }else{
                $("#modal_register_confirm").show();
                $('.btn-mobile-check').hide();
                $('.btn-mobile-register').show();
            }
       }

   });
});
$('.btn-mobile-login').on('click', function () {
    $('.btn-mobile-login').text('صبر کنید').attr('disabled','disabled');
    loginModalMessage('hide');
    let mobile  = $('#mobile').val();
    let password= $('#login_password').val();
    if(mobile == '' || password == ''){
        loginModalMessage('show','لطفا همه موارد را تکمیل کنید');
        return $('.btn-mobile-login').text('ورود').removeAttr('disabled');
    }
    $.ajax({
        method:'POST',
        url: '/ajax/mobile/login',
        data:{mobile:mobile,password:password},
        success:function (data) {
            if(data == 0){
                loginModalMessage('show','رمز عبور صحیح نیست...');
                $('#login_password').val('');
                return $('.btn-mobile-login').text('ورود').removeAttr('disabled');
            }else{
                window.location.href = '/user';
            }
        }
    })
})
$('.btn-mobile-register').on('click', function (){
    let mobile  = $('#mobile').val();
    let code    = $('input[name="code"]').val();

    if(mobile == undefined || mobile == ''){
        return $('#mobile').addClass('is-invalid');
    }
    if(code == undefined || code == ''){
        return $('input[name="code"]').addClass('is-invalid');
    }

    $('#mobile').removeClass('is-invalid');
    $('input[name="code"]').removeClass('is-invalid');

    $('.btn-mobile-register').text('صبر کنید').attr('disabled','disabled');
    $.ajax({
        method:'POST',
        url: '/ajax/mobile/register',
        data:{mobile:mobile,code:code},
        success:function (data) {
            if(data == 0){
                loginModalMessage('show','کد صحیح نیست...');
                $('input[name="code"]').val('').addClass('is-invalid');
                return $('.btn-mobile-register').text('ثبت نام').removeAttr('disabled');
            }else{
                location.href = '/user';
            }
        }
    })

})
