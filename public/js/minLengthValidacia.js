function checkLength(element, min_lenght, err_msg) {
    var lenItem = $(element).val().length;

    if (lenItem < min_lenght) {
        $(element).addClass("is-invalid");

        element.setCustomValidity(err_msg);
        element.reportValidity();

        setTimeout(function() {
            element.focus();
        }, 10);
        element.focus();
    } else {
        $(element).removeClass("is-invalid");
        element.setCustomValidity('');
    }

}
