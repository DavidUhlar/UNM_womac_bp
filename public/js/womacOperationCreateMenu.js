

$(document).ready(function () {
    $('.sub-btn.operacie').click(function () {
        console.log('Click event triggered');
        sarID = $(this).data('operation');
        operationID = $(this).data('id-operation');
        var typOperacie = $(this).data('typ');

        console.log('Clicked operation:', sarID);
        console.log('Clicked operation id:', operationID);

        lastClickedSubMenuId = null;
        operationIdFromJavaScript = sarID;

        if (typOperacie === 'bedro') {
            $('#kss1-div').hide();
            $('#kss2-div').hide();
            $('#hhs-div').show();

            $('.inputAndLabel #hhs').show();
            $('.inputAndLabel #kss1').hide();
            $('.inputAndLabel #kss2').hide();
            $('.inputAndLabel label[for="kss1"]').hide();
            $('.inputAndLabel label[for="kss2"]').hide();
            $('.inputAndLabel label[for="hhs"]').show();
            $('input[name="kss1"]').val(null);
            $('input[name="kss2"]').val(null);
        } else {
            $('#kss1-div').show();
            $('#kss2-div').show();
            $('#hhs-div').hide();

            $('.inputAndLabel #kss1').show();
            $('.inputAndLabel #kss2').show();
            $('.inputAndLabel #hhs').hide();
            $('.inputAndLabel label[for="kss1"]').show();
            $('.inputAndLabel label[for="kss2"]').show();
            $('.inputAndLabel label[for="hhs"]').hide();
            $('input[name="hhs"]').val(null);
        }
        $('.vpisovanieDat').show();


        $('#hiddenOperationIdInput').val(operationID);

        console.log(createRoute + operationID);

        updateFormAction(operationID);

        function getCurrentDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }


        $('input[type="text"]').val('');
        $('input[type="number"]').val('');
        $('input[type="date"]').val('');
        document.getElementById('date_womac').value = getCurrentDate();
        $('select[name="id_visit"]').val('');
        document.getElementById('id_womac').value = 0;
        $('input[name="hhs"]').val(null);
        $('input[name="kss1"]').val(null);
        $('input[name="kss2"]').val(null);


        // updateMode = !updateMode;
        updateContent();
    });

    function updateFormAction(operationID) {
        var formAction = createRoute + operationID;
        $('.vpisovanieDat').attr('action', formAction);
    }
    function updateContent() {
        document.getElementById('sarIdSpan').innerText = operationIdFromJavaScript;
        document.getElementById('womacIdSpan').innerText = "";
        $('input[id="filter_input"]').val(filterValue);
        console.log(filterValue);
    }
});
