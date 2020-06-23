$(document).on('click', function () {
    const path = 'http://localhost/Sama_Chambre';
    const formLogin = $('#formLogin')
    formLogin.submit(function (e) {
       // e.preventDefault();
        $.ajax({
            url: 'http://localhost/Sama_Chambre/controllers/Security/connexion',
            type:'post',
            timeout:3000,
            data:$(this).serialize(),
            success:function () {

            }
        })

    });
})