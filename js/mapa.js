function sacamsg(){
    $("#dlgmensaje").jqm();
    $("#dlgmensaje").jqmShow();
}
function enviarmail(){
    f=document.frmcontacto;
    if(f.nombre.value==""){
        alert("Debe ingresar un nombre válido");
    }
    else{
        if(f.email.value.valueOf("@")<0 || f.email.value.valueOf(".")<0){
            alert("Debe ingresar un email válido");
        }
        else{
            if(f.message.value==""){
                alert("Debe ingresar un mensaje");
            }
            else{
                $.ajax({
                    type:"POST",
                    url:"formulario.php",
                    data:"nombre="+f.nombre.value+"&email="+f.email.value+"&message="+f.message.value,
                    success:function(data){
                        f.nombre.value="";
                        f.email.value="";
                        f.message.value="";
                        sacamsg();
                    }
                });
            }
        }
    }
    return false;
}
function cargagmap(r1,r2){

    $("#ifr").attr("src",r1);
    $("#agm").attr("href",r2);
    $("#gmap").animate({
        "opacity":0
    },1500,"linear",function(){
        //alert(r1);
        $("#gmap ").css("top",-370).animate({
            "opacity":1
        }, 1500);
    });
}
function descargagmap(){
    $("#gmap ").animate({
        "opacity":0
    }, 500, "linear",function(){
        $("#gmap ").css("top",10);
    });
}