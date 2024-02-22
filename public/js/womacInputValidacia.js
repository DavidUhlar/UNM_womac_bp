document.addEventListener('DOMContentLoaded', function () {
    function validateInput(inputElement) {
        const inputValue = inputElement.value;

        if (!inputElement.classList.contains('no-restriction')) {
            if (inputValue.length > 1) {
                inputElement.value = inputValue.slice(0, 1);
            }
        } else {
            if (inputValue.length > 3) {
                inputElement.value = inputValue.slice(0, 3);
            }
        }
    }

    const inputElements = document.querySelectorAll('.womacInput');
    inputElements.forEach(function (inputElement) {
        inputElement.addEventListener('input', function () {
            validateInput(inputElement);
        });
    });
});
