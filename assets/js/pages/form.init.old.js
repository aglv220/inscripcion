$(document).ready(function(){
    $('.mostrar').hide();
    $(".parsley-form").parsley()
    $(".select2").select2()
    $('.select2').on('select2:open', function (e) {
        $('.select2-dropdown').hide();
        $('.select2-dropdown').slideDown(200);
    });
    $("#txt-upload").hide();

    $('[data-toggle="input-mask"]').each(function(t, e) {
        var n = $(e).data("maskFormat")
          , a = $(e).data("reverse");
        null != a ? $(e).mask(n, {
            reverse: a
        }) : $(e).mask(n)
    })

    init_selects();
    var $dni = $('#dni');
    var $editor = $('#frmGuardar');
    var $cmb = $('#curso');

    $("#curso").change(function(data) {
        if (data.currentTarget.selectedIndex > 0){
            $('#crdpersonal').collapse("show");

            $("#spinload0").attr("hidden", false);
            $.ajax({
                url: "include/util/getFunctions.php",
                data: {function: 'getCursoSet', id: data.currentTarget.value},
                dataType: "json",
                type: "POST",
                success: function (data) {
                    var values = new Object;
                    values.descrip = data[0].r_descrip;
                    values.descripcion = data[0].d_descrip;
                    values.archivos = data[0].r_archivo;
                    values.privado = data[0].r_privado;
                    
                    $cmb.data('values', values);
                    $("#spinload0").attr("hidden", true);

                    if (values.descrip = "1"){
                        $('#htmldesc').html(values.descripcion);
                        $('#crddescripcion').collapse("show");
                    }else{
                        $('#htmldesc').html("");
                        $('#crddescripcion').collapse("hide");
                    }
                },
                error: function(data){
                    console.log(data.responseText);
                    $("#spinload0").attr("hidden", true);
                }
            });
        }else{
            $('div[id^="crd"]').collapse("hide");
        }
    })

    $("#editsw").on('change', function() {
        if (!$('#editsw').is(":disabled")){
            if ($('#editsw').is(":checked")){
                disabled_selects(["departamento","provincia","distrito","establecimiento","profesion","entidad"], false);
            }else{
                var values = $dni.data('row');
                reset_selects();
                $('#entidad').val(values.id_entidad).trigger('change');
                $('#departamento').val(values.cod_dep).trigger('change');
                $('#profesion').val(values.id_pro).trigger('change');
                $('#provincia').append(new Option(values.provincia, values.cod_prov, false, false)).val(values.cod_prov).trigger('change');
                $('#distrito').append(new Option(values.distrito, values.cod_dis,  false, false)).val(values.cod_dis).trigger('change');
                $('#establecimiento').append(new Option(values.establecimiento, values.c_renaes, false, false)).val(values.c_renaes).trigger('change');
                disabled_selects(["departamento","provincia","distrito","establecimiento","profesion", "entidad"], true);
            }
        }
    });

    $("#departamento").change(function(data) {
        if (data.currentTarget.selectedIndex > 0 && $('#editsw').is(":checked")){
            clear_selects(["provincia","distrito","establecimiento"], true);
            append_data_select('provincia', data.currentTarget.value, 'cod_prov', 3);
        }
    });

    $("#provincia").change(function(data) {
        if (data.currentTarget.selectedIndex > 0  && $('#editsw').is(":checked")){
            var mcod = $('#departamento').val() + ',' + data.currentTarget.value
            clear_selects(["distrito","establecimiento"], true);
            append_data_select('distrito', mcod, 'cod_dis', 4)
        }
    });

    $("#distrito").change(function(data) {
        if (data.currentTarget.selectedIndex > 0  && $('#editsw').is(":checked")){
            var ubigeo = $('#departamento').val() + $('#provincia').val() + data.currentTarget.value
            clear_selects(["establecimiento"], true);
            append_data_select('establecimiento', ubigeo, 'cod_renaes', 5)
        }
    });

    $('#validar').click(function(e){
        e.preventDefault();
        $('.mostrar').hide();
        $('#crdlaboral').collapse("hide");
        $("#editsw").prop("disabled", true);
        $("#editsw").prop("checked", false);
        reset_selects();
        $('#opcion').attr("disabled", true);

        var dni = $("#dni").val();
        var fecha = $("#fecha").val();
        //console.log(dni);
        
        if (dni != "" && fecha != ""){
            $("#loading").attr("hidden", false);
            $("#validar").attr("disabled", true);

            $.ajax({
                url: "index.php",
                data: {documento: dni, fecnac: fecha, controller: 'validar'},            
                dataType: "json",
                type: "POST",
                success: function (data) {
                    //console.log(data);
                    var status = parseInt(data.status);
                    switch (status) {
                        case 0:
                            $("#nombres").val("");$("#apepat").val("");$("#apemat").val("");
                            $("#mensaje").html("Error desconocido, por favor reintente mas tarde.");
                            $("#miModal").modal();
                            $('#btnaceptar').click(function(){
                                $("#miModal").modal("hide");
                            });
                            break;
                           
                        case 6:
                            $dni.data('row', data);
                            var cmb = $cmb.data('values');
                            $('.mostrar').show();
                            $("#editsw").prop("disabled", false);
                            $("#nombres").val(data.nombres);
                            $("#apepat").val(data.apepat);
                            $("#apemat").val(data.apemat);
                            $("#apecas").val(data.apecas);

                            if (data.ext == true || data.entidad == "MINSA"){
                                $('#ruc').attr("required", false);$('#cruc').hide();
                                $('#rsocial').attr("required", false);$('#crsocial').hide();
                                $('#tipo').attr("required", false);$('#ctipo').hide();
                                $('#establecimiento').attr("required", true);$('#cestablecimiento').show();
                                disabled_selects(["departamento","provincia","distrito","establecimiento","profesion"], true);
                                // $("#correo").val(data.correo);
                                // $("#telefono").val(data.telefono);

                                $('#profesion').val(data.id_pro).trigger('change');
                                $('#departamento').val(data.cod_dep).trigger('change');

                                $('#provincia').append(new Option(data.provincia, data.cod_prov, false, false)).val(data.cod_prov).trigger('change');
                                $('#distrito').append(new Option(data.distrito, data.cod_dis,  false, false)).val(data.cod_dis).trigger('change');
                                $('#establecimiento').append(new Option(data.establecimiento, data.c_renaes, false, false)).val(data.c_renaes).trigger('change');

                                if (data.entidad == "EXTERNO"){
                                    $('#entidad').select2();
                                    $('#entidad').val(data.id_entidad).trigger('change');
                                    $('#uejecutora').attr("required", false);$('#cuejecutora').hide();
                                    $('#pliego').attr("required", false);$('#cpliego').hide();
                                }else{
                                    $('#opcion').attr("disabled", false);
                                    $('#entidad').select2();
                                    $('#entidad').val(data.id_entidad).trigger('change');
                                    $("#pliego").val(data.pliego);
                                    $('#pliego').attr("required", true);$('#cpliego').show();
                                    $("#uejecutora").val(data.uejecutora);
                                    $('#uejecutora').attr("required", true);$('#cuejecutora').show();
                                }
                                $('#chkactualizar').show();
                            }else{
                                reset_selects();
                                $('#chkactualizar').hide();
                                $('#uejecutora').attr("required", false);$('#cuejecutora').hide();
                                $('#pliego').attr("required", false);$('#cpliego').hide();

                                $('#entidad').select2();
                                $('#entidad').val(data.id_entidad).trigger('change');
                                if(cmb.privado){
                                    $("#editsw").prop("checked", false);
                                    $('#establecimiento').attr("required", false);$('#cestablecimiento').hide();
                                    disabled_selects(["profesion","entidad","tipo"], false);
                                    disabled_selects(["departamento","provincia","distrito","establecimiento"], true);
                                    $('#ruc').attr("required", true);$('#cruc').show();
                                    $('#rsocial').attr("required", true);$('#crsocial').show();
                                    $('#tipo').attr("required", true);$('#ctipo').show();
                                }else{
                                    $("#editsw").prop("checked", true);
                                    $('#establecimiento').attr("required", true);$('#cestablecimiento').show();
                                    disabled_selects(["departamento","provincia","distrito","establecimiento","profesion","entidad"], false);
                                    $('#ruc').attr("required", false);$('#cruc').hide();
                                    $('#rsocial').attr("required", false);$('#crsocial').hide();
                                    $('#tipo').attr("required", false);$('#ctipo').hide();
                                }
                            }
                            if(cmb.archivos = "1"){
                                $('#crdarchivo').collapse("show");
                                $('#tipo').attr("required", true);
                            }else{
                                $('#crdarchivo').collapse("hide");
                                $('#tipo').attr("required", false);
                            }

                            $('#crdlaboral').collapse("show");
                            $("#loading").attr("hidden", true);
                            $("#validar").attr("disabled", false);
                            break;
                        
                        default:
                            $("#guardar").attr("disabled", false);
                            $("#loading").attr("hidden", true);
                            $("#validar").attr("disabled", false);
                            $("#nombres").val("");$("#apepat").val("");$("#apemat").val("");
                            Swal.fire({
                                title: "Ups!",
                                text: data.descripcion,
                                type: "warning",
                                confirmButtonClass: "btn btn-confirm mt-2"
                            });
                    }
                }
            });
        }
        else{
            Swal.fire({
                title: "Hey!",
                text: "Escribe tu nro de documento y tu fecha de nacimiento para validarlo!",
                type: "warning",
                confirmButtonClass: "btn btn-confirm mt-2"
            });
        }
    })


    $('#rucvalida').click(function(e){
        e.preventDefault();

        var ruc = $("#ruc").val();
        //console.log(dni);
        
        if (ruc.trim() != "" || ruc.trim().length == 11){
            $("#loadingruc").attr("hidden", false);
            $("#rucvalida").attr("disabled", true);

            $.ajax({
                url: "index.php",
                data: {ruc: ruc.trim(), controller: 'rucvalida'},            
                dataType: "json",
                type: "POST",
                success: function (data) {
                    //console.log(data);
                    var status = parseInt(data.status);
                    switch (status) {
                        case 0:
                            $("#loadingruc").attr("hidden", true);
                            $("#rucvalida").attr("disabled", false);
                            $("#rsocial").val("");
                            Swal.fire({
                                title: "Ups!",
                                text: "Error desconocido, por favor reintente mas tarde.",
                                type: "warning",
                                confirmButtonClass: "btn btn-confirm mt-2"
                            });
                            break;
                           
                        case 6:
                            //$dni.data('row', data);
                            //var cmb = $cmb.data('values');

                            $("#rsocial").val(data.rsocial);//abcdef

                            $('#departamento').val(data.ubigeo.substring(0,2)).trigger('change');
                            clear_selects(["provincia","distrito"], true);
                            $('#provincia').append(new Option(data.provincia, data.ubigeo.substring(2,4), false, false)).val(data.ubigeo.substring(2,4)).trigger('change');
                            $('#distrito').append(new Option(data.distrito,  data.ubigeo.substring(4,6),  false, false)).val(data.ubigeo.substring(4,6)).trigger('change');
                            
                            $("#loadingruc").attr("hidden", true);
                            $("#rucvalida").attr("disabled", false);
                            break;
                        
                        default:
                            $("#loadingruc").attr("hidden", true);
                            $("#rucvalida").attr("disabled", false);
                            $("#rsocial").val("");
                            Swal.fire({
                                title: "Ups!",
                                text: data.descripcion,
                                type: "warning",
                                confirmButtonClass: "btn btn-confirm mt-2"
                            });
                    }
                }
            });
        }
        else{
            Swal.fire({
                title: "Hey!",
                text: "Escribe un número de RUC válido!",
                type: "warning",
                confirmButtonClass: "btn btn-confirm mt-2"
            });
        }
    })

    $editor.submit(function(e) {
        e.preventDefault();

        if (this.checkValidity && !this.checkValidity()) return;
        
        $("#guardar").attr("disabled", true);

        var sdata = $dni.data('row');
        var cmb = $cmb.data('values');

        var formElement = document.getElementById("frmGuardar");
        var post = new FormData(formElement);
        
        post.append("controller", 'guardar');
        post.append("privado", cmb.privado);
        post.append("archivo", cmb.archivos);
        post.append("dni", $("#dni").val().trim());
        post.append("curso", $("#curso").val());
        post.append("fecnac", $("#fecha").val());
        post.append("entidad", $("#entidad").val());
        post.append("ipliego", sdata.c_pliego);
        post.append("iuejecutora", sdata.c_uejecutora);
        post.append("establecimiento", $('#establecimiento').select2('data')[0].text);
        post.append("iestablecimiento", $("#establecimiento").val());
        post.append("id_pro", $("#profesion").val());
        post.append("ubigeo",$("#departamento").val() + $("#provincia").val() + $("#distrito").val());

        /*
        var post = {
            -controller: 'guardar',
            -curso: $("#curso").val(),
            dni: $("#dni").val(),
            -fecnac: $("#fecha").val(),
            -entidad: $("#entidad").val(),
            region: $("#region").val(),
            pliego: $("#pliego").val(),
            -ipliego: sdata.c_pliego,
            uejecutora: $("#uejecutora").val(),
            -iuejecutora: sdata.c_uejecutora,
            -establecimiento: $('#establecimiento').select2('data')[0].text,
            -iestablecimiento: $("#establecimiento").val(),
            apepat: $("#apepat").val(),
            apemat: $("#apemat").val(),
            apecas: $("#apecas").val(),
            nombres: $("#nombres").val(),   
            correo: $("#correo").val(),
            celular: $("#celular").val(),
            -ubigeo: $("#departamento").val() + $("#provincia").val() + $("#distrito").val(),
            -id_pro: $("#profesion").val()
        }
        */
        
        Swal.fire({
            title: "Guardando...",
            type: "info",
            showCloseButton: 0,
            showCancelButton: 0,
            showConfirmButton: 0,
            onBeforeOpen: function() {
                Swal.showLoading()
            },
            allowOutsideClick: false
        });

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            //data: $(this).serialize(),
            data: post,
            contentType: false,
            cache: false,
            processData: false,
            
            //Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $("#saving").attr("hidden", true);

                var status = parseInt(data.status);

                switch (status) {
                    case 0:
                        var t = "Error!";
                        var y = "error"
                        break;
                        
                    case 6:
                        var t = "Listo!";
                        var y = "success" 
                        break;

                    default:
                        var t = "Ups!";
                        var y = "warning" 
                        break;
                }
                Swal.close();
                Swal.fire({
                    title: t,
                    text: data.mensaje,
                    type: y,
                    confirmButtonClass: "btn btn-confirm mt-2"
                });
                $("#guardar").attr("disabled", false);
            }
        });
    })
    
});

$('input[name="upload"]').change(function() {    
    if($(this).val() != ""){
        var file = this.files[0];
        var tipo_archivo = file.type;
        console.log(tipo_archivo);
        if( tipo_archivo == "application/pdf" ){

            var files = $(this)[0].files;
            var nombre = files[0].name;
            $("#txt-upload").attr("class","text-success");
            $("#txt-upload").html("Archivo a subir: "+nombre);
            $("#txt-upload").show();
        } else {
            $(this).val("");
            $("#txt-upload").attr("class","text-danger");
            $("#txt-upload").html("Solo se pueden subir achivos PDF");
            $("#txt-upload").show();
            return false;            
        }
    }
});

function init_selects() {
    append_data_select('curso', '', 'id', 0, "---Seleccione un Curso---");
    append_data_select('departamento','', 'cod_dep', 2);
    append_data_select('profesion','', 'id_pro', 1);
    clear_selects(["provincia","distrito","establecimiento"], true);
}

function reset_selects() {
    $('#departamento').val(null).trigger('change');
    $('#profesion').val(null).trigger('change');
    clear_selects(["provincia","distrito","establecimiento"], true);
}

function append_data_select(select, id, cod, spin, tx = ''){
    $("#spinload" + spin).attr("hidden", false);
    $.ajax({
        url: "include/util/getFunctions.php",
        data: {function: 'get' + select, id: id},
        dataType: "json",
        type: "POST",
        success: function (data) {
            $('#' + select).select2({
                data: to_array_objects(data, cod, select, tx),
            });
            $("#spinload" + spin).attr("hidden", true);
        },
        error: function(data){
            console.log(data.responseText);
            $("#spinload" + spin).attr("hidden", true);
        }
    });
}

function to_array_objects(params, cod, des, tx) {
    var data = new Array();
    data.push({ id: '', text: tx == '' ? 'Seleccione...': tx });
    $.each(params, function(i, item) {
        var f = {id: item[cod], text: item[des]}
        data.push(f);
    });
    return data;
}

function clear_selects(params, zeroRow) {
    if (params.length > 0){
        $.each(params, function(i, item) {
            $('#'+ item).val(null).empty();
            if(zeroRow){
                $('#'+ item).append(new Option("Seleccione...", "", false, false)).trigger('change');
            }
        });
    }
}

function disabled_selects(params, val) {
    if (params.length > 0){
        $.each(params, function(i, item) {
            $('#'+ item).attr("disabled", val);
        });
    }
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}