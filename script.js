function validate(_form){

    let fail = false;
    let X = _form.x.value;
    let Y = _form.y.value;
    let R = _form.r.value;

    if (Y <= -5 || Y >= 3 || isNaN(Y) || Y == "" || Y.length > 10){
        fail = "Некорректно задано значение Y \n";
    }
    if (R <= 1 || R >= 4 || isNaN(R) || R == "" || R.length > 10){
        if (!fail) fail = "";
        fail += "Некорректно задано значение R";
    }

    if (fail){
        alert(fail);
        return false;
    }
    else{
        // makeFrame('result_frame');
        // createCanvas('canvas', X, Y, R);
        return true;
    }

}