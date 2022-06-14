const { result } = require("lodash");

let token = (document.getElementsByTagName('meta'))[3].content;


window.trabajo = function trabajo(){
    let s=0;
    let url = '/test';
    let nro_l = 0;
    let producto = (document.getElementById('product_name')).textContent;
    let lineas = (document.getElementsByClassName('form-check-input'));
    let nombre =  (document.getElementById('nombreApellido')).textContent;
    for(i=0; i<lineas.length; i++){
        if (lineas[i].checked == true){
            s= s+1;
            nro_l = i;
        }
    };

    nro_l = nro_l + 1;
    sw=0
    if (producto && nombre && s){
        let label_trabajo = (document.getElementById('trabajo')).innerText;
        label_trabajo= (parseInt(label_trabajo, 10)+1);
        document.getElementById('trabajo').innerHTML= label_trabajo.toString();
        a();
        function a(){
            fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                        },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        name: nombre,
                        producto: producto,
                        linea: nro_l,
                        trabajo1: label_trabajo.toString()
                    })
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
}

window.retrabajo = function retrabajo(){
    s=0;
    let url = '/test';
    let nro_l = 0;
    let producto = (document.getElementById('product_name')).textContent;
    let lineas = (document.getElementsByClassName('form-check-input'));
    let nombre =  (document.getElementById('nombreApellido')).textContent;
    for(i=0; i<lineas.length; i++){
        if (lineas[i].checked == true){
            s= s+1;
            nro_l = i;
        }
    };

    nro_l = nro_l + 1;

    if (producto && nombre && s){
        let label_retrabajo = (document.getElementById('reTrabajo')).innerText;
        label_retrabajo= (parseInt(label_retrabajo, 10)+1);
        document.getElementById('reTrabajo').innerHTML= label_retrabajo.toString();
        a();
        function a(){
            fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                        },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        name: nombre,
                        producto: producto,
                        linea: nro_l,
                        retrabajo1: label_retrabajo.toString()
                    })
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
}



window.cod_fun = function cod_fun(){
    let select_cod = (document.getElementById('select_cod'));
    let option_id = (document.getElementById(select_cod.value));
    option_id.selected = true;
    document.getElementById('disabled').disabled = true
}

window.hora_act = function hora_act(){
    var date = new Date();
    var hours = date.getHours();
    var minutes = date.getMinutes();

    let url = '/insert';

    document.getElementById('hora').innerText = hours + ':' + minutes;
    setInterval (function(){
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();

        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        document.getElementById('hora').innerText = hours + ':' + minutes;
    }, 500);

    setInterval (function(){
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();

        var trabajo = document.getElementById('trabajo');
        var reTrabajo = document.getElementById('reTrabajo');
        if(parseInt(hours, 10) == 6 && parseInt(minutes, 10) == 20){
            trabajo.innerHTML = "0";
            reTrabajo.innerHTML = "0";
            b();
        }
        if(parseInt(hours, 10) == 7 && parseInt(minutes, 10) == 20){
            trabajo.innerHTML = "0";
            reTrabajo.innerHTML = "0";
            b();
        }else{
            if(parseInt(hours, 10) == 8 && parseInt(minutes, 10) == 35){
                trabajo.innerHTML = "0";
                reTrabajo.innerHTML = "0";
                b();
            }else{
                if(parseInt(hours, 10) == 9 && parseInt(minutes, 10) == 35){
                    trabajo.innerHTML = "0";
                    reTrabajo.innerHTML = "0";
                    b();
                }else{
                    if(parseInt(hours, 10) == 10 && parseInt(minutes, 10) == 35){
                        trabajo.innerHTML = "0";
                        reTrabajo.innerHTML = "0";
                        b();
                    }else{
                        if(parseInt(hours, 10) == 11 && parseInt(minutes, 10) == 35){
                            trabajo.innerHTML = "0";
                            reTrabajo.innerHTML = "0";
                            b();
                        }else{
                            if(parseInt(hours, 10) == 12 && parseInt(minutes, 10) == 5){
                                trabajo.innerHTML = "0";
                                reTrabajo.innerHTML = "0";
                                b();
                            }else{
                                if(parseInt(hours, 10) == 13 && parseInt(minutes, 10) == 55){
                                    trabajo.innerHTML = "0";
                                    reTrabajo.innerHTML = "0";
                                    b();
                                }else{
                                    if(parseInt(hours, 10) == 14 && parseInt(minutes, 10) == 55){
                                        trabajo.innerHTML = "0";
                                        reTrabajo.innerHTML = "0";
                                        b();
                                    }else{
                                        if(parseInt(hours, 10) == 15 && parseInt(minutes, 10) == 55){
                                            trabajo.innerHTML = "0";
                                            reTrabajo.innerHTML = "0";
                                            b();
                                        }else{
                                            if(parseInt(hours, 10) == 17 && parseInt(minutes, 10) == 0){
                                                trabajo.innerHTML = "0";
                                                reTrabajo.innerHTML = "0";
                                                b();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
    }, 60000);

    function b(){
        fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                    },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    trabajo1: trabajo.toString(),
                    retrabajo1: reTrabajo.toString()
                })
            })
            .catch(function(error) {
                console.log(error);
            });
    }
}

var input_cod = document.getElementById("autocomplete");
input_cod.addEventListener('keyup', function () {
    let label_funcionario = document.getElementById('nombreApellido');
    let input_cod = document.getElementById("autocomplete");
    var key = event.keyCode || event.charCode;

    if( key == 8 || key == 46 ){
        if (input_cod.value == false) {
            label_funcionario.textContent = "";
        }
    }
})

var input_prod = document.getElementById("autocompleteproduc");
input_prod.addEventListener('keyup', function () {
    let label_producto = document.getElementById('product_name');
    let input_prod = document.getElementById("autocompleteproduc");
    var key = event.keyCode || event.charCode;

    if( key == 8 || key == 46 ){
        if (input_prod.value == false) {
            label_producto.textContent = "";
        }
    }
})

