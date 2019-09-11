(function() {


    const ACCEPTED_XS = [-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2];

    let errMsgPanel = document.getElementById('errors-area');
    let submitButton = document.getElementById('submit-button');
    let xCheckBoxes = document.querySelectorAll('input[name="x"]');
    let yText = document.getElementById("y");
    let rText = document.getElementById("r");

    submitButton.addEventListener("click", onSubmit);

    function setErrorMsg(msg) {
        errMsgPanel.innerText = msg;
        if (msg != null)
            errMsgPanel.classList.remove("invisible");
        else
            errMsgPanel.classList.add("invisible");
    }

    function onSubmit(event) {
        if (!(checkX() && checkY() && checkR()))
            event.preventDefault();
    }

    function checkX() {
        let selected = null;
        for (let i = 0; i < xCheckBoxes.length; i++) {
            if (xCheckBoxes[i].checked) {
                if (selected) {
                    setErrorMsg("Следует выбрать один X");
                    return false;
                }

                if (ACCEPTED_XS.indexOf(+xCheckBoxes[i].value) === -1)   {
                    setErrorMsg("HACKING ATTEMPT");
                    return false;
                }

                selected = xCheckBoxes[i].value;
            }
        }
        if (!selected) {
            setErrorMsg("Следует выбрать X");
            return false;
        }
        return true;
    }

    function checkY() {
        yText.value = yText.value.trim();

        if (yText.value.length === 0) {
            setErrorMsg("Поле Y обязательно");
            return false;
        }

        if (isNaN(yText.value.replace(',', '.'))) {
            setErrorMsg("В поле Y следует ввести число");
            return false;
        }
        let val = +yText.value;
        if (val <= -5 || val >= 3) {
            setErrorMsg(`Y должен лежать в (-5 ; 3)`);
            return false;
        }
        return true;
    }

    function checkR() {
        rText.value = rText.value.trim();

        if (rText.value.length === 0) {
            setErrorMsg("Поле R обязательно");
            return false;
        }

        if (isNaN(rText.value.replace(',', '.'))) {
            setErrorMsg("В поле R следует ввести число");
            return false;
        }
        let val = +rText.value;
        if (val <= 1 || val >= 4) {
            setErrorMsg(`R должен лежать в (1 ; 4)`);
            return false;
        }
        return true;
    }
})();