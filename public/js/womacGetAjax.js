var updateMode = false;
var lastClickedSubMenuId = null;
$(document).ready(function () {



    $('.sub-item').click(function (e) {
        e.preventDefault();

        var idWomac = $(this).data('id');
        var typ = $(this).data('typ');
        operationID = $(this).data('id-operation');
        sarID = $(this).data('operation');
        console.log(idWomac);
        console.log(getWomacRoute + idWomac);
        console.log(operationID + '    z womacu');
        console.log(sarID + '    z womacu');

        updateFormAction(operationID);

        if (lastClickedSubMenuId === idWomac) {
            updateMode = !updateMode;
            // $('.vpisovanieDat').toggle();
            lastClickedSubMenuId = -1;
        } else {
            updateMode = true;
            lastClickedSubMenuId = idWomac;
        }



        womacIdFromJavaScript = idWomac;

        updateContentWomac(updateMode);



        if (updateMode) {
            $.ajax({
                url: getWomacRoute + idWomac,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log('data:', data);

                    $('input[name="id_womac"]').val(data.id_womac);
                    $('input[name="date_womac"]').val(data.date_womac);
                    $('input[name="date_visit"]').val(data.date_visit);
                    $('input[name="answer_01"]').val(data.answer_01);
                    $('input[name="answer_02"]').val(data.answer_02);
                    $('input[name="answer_03"]').val(data.answer_03);
                    $('input[name="answer_04"]').val(data.answer_04);
                    $('input[name="answer_05"]').val(data.answer_05);
                    $('input[name="answer_06"]').val(data.answer_06);
                    $('input[name="answer_07"]').val(data.answer_07);
                    $('input[name="answer_08"]').val(data.answer_08);
                    $('input[name="answer_09"]').val(data.answer_09);
                    $('input[name="answer_10"]').val(data.answer_10);
                    $('input[name="answer_11"]').val(data.answer_11);
                    $('input[name="answer_12"]').val(data.answer_12);
                    $('input[name="answer_13"]').val(data.answer_13);
                    $('input[name="answer_14"]').val(data.answer_14);
                    $('input[name="answer_15"]').val(data.answer_15);
                    $('input[name="answer_16"]').val(data.answer_16);
                    $('input[name="answer_17"]').val(data.answer_17);
                    $('input[name="answer_18"]').val(data.answer_18);
                    $('input[name="answer_19"]').val(data.answer_19);
                    $('input[name="answer_20"]').val(data.answer_20);
                    $('input[name="answer_21"]').val(data.answer_21);
                    $('input[name="answer_22"]').val(data.answer_22);
                    $('input[name="answer_23"]').val(data.answer_23);
                    $('input[name="answer_24"]').val(data.answer_24);
                    $('input[name="kss1"]').val(data.kss1);
                    $('input[name="kss2"]').val(data.kss2);
                    $('input[name="hhs"]').val(data.hhs);

                    if (typ === 'bedro') {

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
                    updateContentWomac(false);

                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        } else {

            $('input[type="text"]').val('');
            $('input[type="date"]').val('');
            document.getElementById('id_womac').value = 0;
            $('input[name="hhs"]').val(null);
            $('input[name="kss1"]').val(null);
            $('input[name="kss2"]').val(null);
            updateContentWomac(true);
        }
        // updateMode = !updateMode;
    });

    function updateFormAction(operationID) {
        var formAction = createRoute + operationID;
        $('.vpisovanieDat').attr('action', formAction);
    }

    function updateContentWomac(parameterTrue) {

        if (parameterTrue) {
            document.getElementById('womacIdSpan').innerText = '';
        } else {
            document.getElementById('womacIdSpan').innerText = womacIdFromJavaScript;
        }
        document.getElementById('sarIdSpan').innerText = sarID;
        $('input[id="filter_input"]').val(filterValue);
    }
});
