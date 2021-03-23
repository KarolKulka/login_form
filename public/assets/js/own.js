$(document).ready(function () {
    var errors = 0;
    $('#login_form').on('submit', function (e) {
        let form = $(this);
        errors = 0;

        let usernameInput = form.find('#username');
        usernameInput.removeClass('is-valid is-invalid').siblings('small').remove();
        let passwordInput = form.find('#password');
        passwordInput.removeClass('is-valid is-invalid').siblings('small').remove();

        if (!usernameInput.val()) {
            errors++;
            usernameInput.addClass('is-invalid').after('<small class="text-danger">Field is required</small>');
        }else if (usernameInput.val().length <= 3){
            errors++;
            usernameInput.addClass('is-invalid').after('<small class="text-danger">At least 4 characters required</small>');;
        }else{
            usernameInput.addClass('is-valid');
        }

        if (!passwordInput.val()) {
            errors++;
            passwordInput.addClass('is-invalid').after('<small class="text-danger">Field is required</small>');
        }else if (passwordInput.val().length <= 3){
            errors++;
            passwordInput.addClass('is-invalid').after('<small class="text-danger">At least 4 characters required</small>');;
        }else{
            passwordInput.addClass('is-valid');
        }

        if (errors > 0){
            e.preventDefault();
        }
    });
});