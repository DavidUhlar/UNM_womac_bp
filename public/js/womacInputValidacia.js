document.addEventListener('DOMContentLoaded', function () {
    function validateInput(inputElement) {
        const inputValue = inputElement.value;

        if (!inputElement.classList.contains('no-restriction')) {
            if (inputValue.length > 1) {
                inputElement.value = inputValue.slice(0, 1);
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
