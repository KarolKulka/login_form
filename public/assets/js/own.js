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
            inputError(usernameInput, 'Field is required');
        }else if (usernameInput.val().length <= 3){
            inputError(usernameInput, 'At least 4 characters required');
        }else{
            usernameInput.addClass('is-valid');
        }

        if (!passwordInput.val()) {
            inputError(passwordInput, 'Field is required');
        }else if (passwordInput.val().length <= 3){
            inputError(passwordInput, 'At least 4 characters required');
        }else{
            usernameInput.addClass('is-valid');
        }

        if (errors > 0){
            e.preventDefault();
        }
    });

    function inputError(formInput, errorInfo){
        errors++;
        formInput.addClass('is-invalid').after('<small class="text-danger">' + errorInfo + '</small>');
    }

    var lastUrlSegment = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
    if (lastUrlSegment === 'logged') {
        timeRedirect('');
    }

});

function timeRedirect(destination = '', loadBar = null){
    let waitTime = 3000;
    setTimeout(function () {
        window.location.href = baseUrl + destination;
    }, waitTime);
}