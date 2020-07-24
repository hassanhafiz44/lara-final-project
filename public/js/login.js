$(document).ready(function () {
    $("#login-form").submit(function (event) {
        event.preventDefault();
        const form = document.querySelector("#login-form");

        if (form.checkValidity() === false) {
            $(form).addClass("was-validated");
            return;
        }
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

        const data = {
            _token: CSRF_TOKEN,
            email: $(form).find('[name="email"]').val(),
            password: $(form).find('[name="password"]').val(),
        };

        $.ajax({
            url: "loginsubmit",
            method: "POST",
            data: data,
            success: function (response) {},
            error: function (error) {
                console.log(error);
            },
        });
    });
});

