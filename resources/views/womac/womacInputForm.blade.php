

<form class="vpisovanieDat" method="post" style="display: none;">
    @csrf
    <input type="hidden" id="hiddenOperationIdInput" name="id_operation" value="">

    <input type="hidden" id="id_womac" name="id_womac" value="0">


    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="id_visit">ID vyšetrenia</label>
        <select name="id_visit" class="womacInputDate" id="id_visit">
            <option value=""></option>
            <option value="1">Pooperačné</option>
            <option value="2">3 - mesačné</option>
            <option value="3">6 - mesačné</option>
            <option value="4">9 - mesačné</option>
            <option value="5">12 - mesačné</option>
        </select>
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="date_visit">Dátum vyšetrenia</label>
        <input type="date" class="womacInputDate" id="date_visit" name="date_visit" value="">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="date_womac">Dátum womac</label>
        <input type="date" class="womacInputDate" id="date_womac" name="date_womac" value="">
    </div>


    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_01">1</label>
        <input type="number" class="womacInput" name="answer_01" id="answer_01" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_02">2</label>
        <input type="number" class="womacInput" name="answer_02" id="answer_02" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_03">3</label>
        <input type="number" class="womacInput" name="answer_03" id="answer_03" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_04">4</label>
        <input type="number" class="womacInput" name="answer_04" id="answer_04" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_05">5</label>
        <input type="number" class="womacInput" name="answer_05" id="answer_05" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_06">6</label>
        <input type="number" class="womacInput" name="answer_06" id="answer_06" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_07">7</label>
        <input type="number" class="womacInput" name="answer_07" id="answer_07" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_08">8</label>
        <input type="number" class="womacInput" name="answer_08" id="answer_08" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_09">9</label>
        <input type="number" class="womacInput" name="answer_09" id="answer_09" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_10">10</label>
        <input type="number" class="womacInput" name="answer_10" id="answer_10" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_11">11</label>
        <input type="number" class="womacInput" name="answer_11" id="answer_11" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_12">12</label>
        <input type="number" class="womacInput" name="answer_12" id="answer_12" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_13">13</label>
        <input type="number" class="womacInput" name="answer_13" id="answer_13" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_14">14</label>
        <input type="number" class="womacInput" name="answer_14" id="answer_14" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_15">15</label>
        <input type="number" class="womacInput" name="answer_15" id="answer_15" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_16">16</label>
        <input type="number" class="womacInput" name="answer_16" id="answer_16" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_17">17</label>
        <input type="number" class="womacInput" name="answer_17" id="answer_17" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_18">18</label>
        <input type="number" class="womacInput" name="answer_18" id="answer_18" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_19">19</label>
        <input type="number" class="womacInput" name="answer_19" id="answer_19" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_20">20</label>
        <input type="number" class="womacInput" name="answer_20" id="answer_20" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_21">21</label>
        <input type="number" class="womacInput" name="answer_21" id="answer_21" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_22">22</label>
        <input type="number" class="womacInput" name="answer_22" id="answer_22" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_23">23</label>
        <input type="number" class="womacInput" name="answer_23" id="answer_23" maxlength="1" max="5" min="1">
    </div>
    <div class="inputAndLabel">
        <label class="nazovWomacInput" for="answer_24">24</label>
        <input type="number" class="womacInput" name="answer_24" id="answer_24" maxlength="1" max="5" min="1">
    </div>


    <div id="hhs-div" class="inputAndLabel">
        <label class="nazovWomacInput" for="hhs">HHS</label>
        <input type="number" class="womacInput result-restriction " name="hhs" id="hhs" maxlength="2" max="100" min="0">
    </div>
    <div id="kss1-div" class="inputAndLabel">
        <label class="nazovWomacInput" for="kss1">KSS1</label>
        <input type="number" class="womacInput result-restriction" name="kss1" id="kss1" maxlength="2" max="100" min="0">
    </div>
    <div id="kss2-div" class="inputAndLabel">
        <label class="nazovWomacInput" for="kss2">KSS2</label>
        <input type="number" class="womacInput result-restriction" name="kss2" id="kss2" maxlength="2" max="100" min="0">
    </div>

    <button class="buttonSubmit">Potvrdiť</button>
</form>


