$(function (){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('form[name="login"]').submit(function (e){
        e.preventDefault();

        const form = $(this)
        const email = $('[name="email"]').val()
        const password = $('[name="password_check"]').val()
        const action = form.attr('action')

        $.post(action, {
            email :email,
            password : password
        }, function (ret){
            if (!ret.success){
                alertify.warning(ret.msg)
            }else{
                window.location.href = ret.redirect;
            }
        }, 'json');

    })
})
