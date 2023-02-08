$(document).ready(function () {
    $(".select2").select2()
    $('.select2').on('select2:open', function (e) {
        $('.select2-dropdown').hide();
        $('.select2-dropdown').slideDown(200);
    });

    //WIZARD PARA ARCHIVOS
    $('#progressbarwizard').bootstrapWizard({
        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            $('#progressbarwizard').find('.bar').css({ width: $percent + '%' });
        },
        onNext: function (tab, navigation, index) {
            var x = $('.upload')[index - 1];
            var ipt = $('#progressbarwizard').find(x);

            if (ipt.val() == "") {
                Swal.fire({
                    title: "Seleccione un Archivo!",
                    text: "Debe seleccionar un archivo antes de continuar!",
                    type: "warning",
                    confirmButtonClass: "btn btn-confirm mt-2"
                });
                return false;
            }
        },
        onTabClick: function (tab, navigation, index) {
            return false;
        }
    });

    $('.mostrar').hide();
    $(".parsley-form").parsley()

    $('#dni').on('input', function () {
        var vacio = $(this).prop('value') === '';
        if (vacio) {
            $('.mostrar').hide();
            $('#crdlaboral').collapse("hide");
            clear_inputs(["apepat", "apemat", "nombres", "apecas", "fecha"]);
        }
    });

    //CAMPO CODIGO MODULAR
    $(".div-cod-modular").hide();
    //BOTÓN DE REGISTRO - DUPLICADO
    $("#div-btn-registro").hide();

    $('[data-toggle="input-mask"]').each(function (t, e) {
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
    var id_curso = 0;
    var txtdatospers = "Ingrese su Número de documento junto a su Fecha de Nacimiento, luego haga click en 'Validar', sus nombres y apellidos se rellenarán automáticamente";
    var txtdatospers1 = "Si usted cuenta con DNI del Perú, ingrese su Número de documento junto a su Fecha de Nacimiento, luego haga click en 'Validar', sus nombres y apellidos se rellenarán automáticamente; caso contrario si usted es Extranjero(a) active la casilla 'Soy extranjero(a) y no cuento con DNI peruano'";
    var txtdatospers2 = "Para continuar con el proceso de registro haga clic en el botón 'Confirmar y Continuar', luego deberá ingresar sus datos personales, como: Apellido Paterno, Apellido Materno, Nombres, Email, Confirmación de Email y Número de celular";
    var txtbtnguardar1 = "Registrarse";
    var txtbtnguardar2 = "Registrarse como Extranjero(a)"

    //SWITCH EXTRANJERO
    $("#chkextranjero").on('change', function () {
        if (!$('#chkextranjero').is(":disabled")) {
            if ($('#chkextranjero').is(":checked")) {
                $("#div-dniperu").hide();
                $('input[name="dni"]').prop("required", false);
                $("#div-btnextranjero").show();
                $(".txt-datospers").html(txtdatospers2);
            } else {
                $("#div-dniperu").show();
                $('input[name="dni"]').prop("required", true);
                $("#div-btnextranjero").hide();
                $(".txt-datospers").html(txtdatospers1);
            }
            if ($(".mostrar").is(":visible")) {
                $('.mostrar').hide();
                $('#crdlaboral').collapse("hide");
                $('input[name="dni"]').val("");
                $('input[name="fecha"]').val("");
                $("#loading").attr("hidden", true);
                $("#validar").attr("disabled", false);
                $('#div-btn-registro').hide();
            }
        }
    });

    //CHK-EXTRANJERO
    $("#div-chkextranjero").hide();
    $("#div-btnextranjero").hide();
    $("#div-pais").hide();

    $('#chkextranjero').prop("disabled", true);
    $('#btncontinue').prop("disabled", true);

    $("#curso").change(function (data) {
        if (data.currentTarget.selectedIndex > 0) {
            $('#crdpersonal').collapse("show");
            $('.mostrar').hide();
            $('#crdlaboral').collapse("hide");
            clear_inputs(["dni", "apepat", "apemat", "nombres", "apecas", "fecha"]);

            //BOTON DE REGISTRO ADICIONAL
            $('#div-btn-registro').hide();

            //CAMPO CODIGO MODULAR
            id_curso = data.currentTarget.value;
            if (id_curso == 178 || id_curso == 179) {
                $(".div-cod-modular").show();
                $("#cod_modular").prop("required", true);
            } else {
                $(".div-cod-modular").hide();
                $("#cod_modular").prop("required", false);
            }

            //CAMPOS POR DEFECTO - CHKEXTRANJERO
            $('#chkextranjero').prop("checked", false);
            $("#div-chkextranjero").hide();
            $("#div-btnextranjero").hide();
            $("#div-pais").hide();
            $('#div-pais select[name="pais"]').prop("required", false);
            $('#div-pais select[name="pais"]').prop("disabled", true);
            $(".btn-guardar-2").val(txtbtnguardar1);
            $(".txt-datospers").html(txtdatospers);

            $("#div-dniperu").show();
            $('input[name="dni"]').prop("required", true);
            //CHECKBOX EXTRANJERO
            if (id_curso == 278) { //ID DEL CURSO EN MENCION
                $("#div-chkextranjero").show();
                $('#chkextranjero').prop("disabled", false);
                $('#btncontinue').prop("disabled", false);
                $(".btn-guardar-2").val(txtbtnguardar2);
                $(".txt-datospers").html(txtdatospers1);
            } else {
                $("#div-chkextranjero").hide();
                $('#chkextranjero').prop("disabled", true);
                $('#btncontinue').prop("disabled", true);
                $(".btn-guardar-2").val(txtbtnguardar1);
                $(".txt-datospers").html(txtdatospers);
            }

            $("#spinload0").attr("hidden", false);
            $.ajax({
                url: "include/util/getFunctions.php",
                data: { function: 'getCursoSet', id: data.currentTarget.value },
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

                    if (values.descrip == "1") {
                        $('#htmldesc').html(values.descripcion);
                        $('#crddescripcion').collapse("show");
                    } else {
                        $('#htmldesc').html("");
                        $('#crddescripcion').collapse("hide");
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                    $("#spinload0").attr("hidden", true);
                }
            });
        } else {
            $('div[id^="crd"]').collapse("hide");
            $("#div-btn-registro").hide();
        }
    })

    $("#editsw").on('change', function () {
        if (!$('#editsw').is(":disabled")) {
            if ($('#editsw').is(":checked")) {
                disabled_selects(["departamento", "provincia", "distrito", "establecimiento", "profesion", "entidad"], false);
            } else {
                var values = $dni.data('row');
                reset_selects();
                $('#entidad').val(values.id_entidad).trigger('change');
                $('#departamento').val(values.cod_dep).trigger('change');
                $('#profesion').val(values.id_pro).trigger('change');
                $('#provincia').append(new Option(values.provincia, values.cod_prov, false, false)).val(values.cod_prov).trigger('change');
                $('#distrito').append(new Option(values.distrito, values.cod_dis, false, false)).val(values.cod_dis).trigger('change');
                $('#establecimiento').append(new Option(values.establecimiento, values.c_renaes, false, false)).val(values.c_renaes).trigger('change');
                disabled_selects(["departamento", "provincia", "distrito", "establecimiento", "profesion", "entidad"], true);
            }
        }
    });

    $("#departamento").change(function (data) {
        if (data.currentTarget.selectedIndex > 0 && $('#editsw').is(":checked")) {
            clear_selects(["provincia", "distrito", "establecimiento"], true);
            append_data_select('provincia', data.currentTarget.value, 'cod_prov', 3);
        }
    });

    $("#provincia").change(function (data) {
        if (data.currentTarget.selectedIndex > 0 && $('#editsw').is(":checked")) {
            var mcod = $('#departamento').val() + ',' + data.currentTarget.value
            clear_selects(["distrito", "establecimiento"], true);
            append_data_select('distrito', mcod, 'cod_dis', 4)
        }
    });

    $("#distrito").change(function (data) {
        if (data.currentTarget.selectedIndex > 0 && $('#editsw').is(":checked")) {
            var ubigeo = $('#departamento').val() + $('#provincia').val() + data.currentTarget.value
            clear_selects(["establecimiento"], true);
            append_data_select('establecimiento', ubigeo, 'cod_renaes', 5)
        }
    });

    //ACCION - BTN CONTINUE - CHKEXTRANJERO
    $('#btncontinue').click(function (e) {
        e.preventDefault();
        $('.mostrar').show();
        $('#crdlaboral').collapse("hide");
        //LIMPIAR CONTROLES DE DATOS PERSONALES
        $('div.mostrar input').val("");
        $('div.mostrar input').prop("readonly", false);

        $('#div-btnextranjero').hide();

        //BOTON DE REGISTRO ADICIONAL
        $('#div-btn-registro').show();

        $("#editsw").prop("disabled", true);
        $("#editsw").prop("checked", false);

        $("#entidad").attr("required", false);
        $("#profesion").attr("required", false);
        $("#regimen").attr("required", false);
        $("#departamento").attr("required", false);
        $("#provincia").attr("required", false);
        $("#distrito").attr("required", false);
        $('#pliego').attr("required", false);
        $('#uejecutora').attr("required", false);
        $("#establecimiento").attr("required", false);
        $("#condicion").attr("required", false);
        $('#ruc').attr("required", false);
        $('#rsocial').attr("required", false);
        $('#tipo').attr("required", false);
    });

    $('#validar').click(function (e) {
        e.preventDefault();
        $('.mostrar').hide();
        $('#crdlaboral').collapse("hide");
        $("#editsw").prop("disabled", true);
        $("#editsw").prop("checked", false);
        reset_selects();
        $('#opcion').attr("disabled", true);

        var dni = $("#dni").val();
        var fecha = $("#fecha").val();

        if (dni != "" && fecha != "") {
            $("#loading").attr("hidden", false);
            $("#validar").attr("disabled", true);

            $.ajax({
                url: "index.php",
                data: { documento: dni, fecnac: fecha, controller: 'validar' },
                dataType: "json",
                type: "POST",
                success: function (data) {
                    //console.log(data);
                    var status = parseInt(data.status);
                    switch (status) {
                        case 0:
                            $("#nombres").val(""); $("#apepat").val(""); $("#apemat").val("");
                            $("#mensaje").html("Error desconocido, por favor reintente mas tarde.");
                            $("#miModal").modal();
                            $('#btnaceptar').click(function () {
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

                            //EXTRANJERO
                            if ($('#chkextranjero').is(":checked")) {
                                $("#div-pais").show();
                                $('#div-pais select[name="pais"]').prop("required", true);
                                $('#div-pais select[name="pais"]').prop("disabled", false);
                            } else {
                                $("#div-pais").hide();
                                $('#div-pais select[name="pais"]').prop("required", false);
                                $('#div-pais select[name="pais"]').prop("disabled", true);
                            }

                            if (id_curso == 190 || id_curso == 191 || id_curso == 192 ||
                                id_curso == 193 || id_curso == 194 || id_curso == 195 ||
                                id_curso == 196 || id_curso == 197) { // SI SE ELIGIÓ EL CURSO PARA VALIDAR PROFESORES
                                $('#crdlaboral').collapse("hide");
                                $("#div-btn-registro").show();

                                //DATOS LABORALES
                                $("#entidad").attr("required", false);
                                $("#profesion").attr("required", false);
                                $("#departamento").attr("required", false);
                                $("#provincia").attr("required", false);
                                $("#distrito").attr("required", false);
                                $("#establecimiento").attr("required", false);
                                $("#regimen").attr("required", false);
                                $("#condicion").attr("required", false);

                                //CAMPOS REQUERIDOS OCULTOS QUITADOS DE VALIDACI�N - ANGEL LAOS - 31-03-2022
                                $('#pliego').attr("required", false);
                                $('#uejecutora').attr("required", false);
                                $('#rsocial').attr("required", false);
                            } else {
                                $('#crdlaboral').collapse("show");
                                $("#div-btn-registro").hide();

                                //Si existe en la Base de Datos o es MINSA
                                if (data.ext == true || data.entidad == "MINSA") {
                                    $('#ruc').attr("required", false); $('#cruc').hide();
                                    $('#rsocial').attr("required", false); $('#crsocial').hide();
                                    $('#tipo').attr("required", false); $('#ctipo').hide();
                                    $('#establecimiento').attr("required", true); $('#cestablecimiento').show();
                                    disabled_selects(["departamento", "provincia", "distrito", "establecimiento", "profesion", "regimen"], true);
                                    // $("#correo").val(data.correo);
                                    // $("#telefono").val(data.telefono);

                                    $('#profesion').val(data.id_pro).trigger('change');
                                    $('#departamento').val(data.cod_dep).trigger('change');

                                    $('#provincia').append(new Option(data.provincia, data.cod_prov, false, false)).val(data.cod_prov).trigger('change');
                                    $('#distrito').append(new Option(data.distrito, data.cod_dis, false, false)).val(data.cod_dis).trigger('change');
                                    $('#establecimiento').append(new Option(data.establecimiento, data.c_renaes, false, false)).val(data.c_renaes).trigger('change');

                                    if (data.entidad == "EXTERNO") {
                                        $('#opcion').attr("disabled", true);
                                        $('#entidad').select2();
                                        $('#entidad').val(data.id_entidad).trigger('change');
                                        $('#uejecutora').attr("required", false); $('#cuejecutora').hide();
                                        $('#pliego').attr("required", false); $('#cpliego').hide();
                                        $('#condicion').attr("required", false);
                                        $('#regimen').val(data.id_reglab).trigger('change');
                                        $('#regimen').attr("disabled", data.id_reglab == "" ? false : true);
                                        $('#profesion').attr("disabled", data.id_pro == "" ? false : true);
                                        if (data.cod_dep === null) {
                                            $("#editsw").prop("checked", true);
                                            disabled_selects(["departamento", "provincia", "distrito", "establecimiento"], false);
                                        } else {
                                            $("#editsw").prop("checked", false);
                                        }
                                    } else {
                                        $('#opcion').attr("disabled", false);
                                        //$('#entidad').select2();
                                        $('#entidad').val(data.id_entidad).trigger('change');
                                        $("#pliego").val(data.pliego);
                                        $('#pliego').attr("required", true); $('#cpliego').show();
                                        $("#uejecutora").val(data.uejecutora);
                                        $('#uejecutora').attr("required", true); $('#cuejecutora').show();
                                        //$('#regimen').select2();
                                        $('#regimen').val(data.id_reglab).trigger('change');
                                        $('#regimen').attr("required", true);
                                        $('#condicion').append(new Option(data.condlab, data.id_condlab, false, false)).val(data.id_condlab).trigger('change'); $('#condicion').val(data.id_condlab)
                                        $('#condicion').attr("required", true);
                                    }
                                    //$('#chkactualizar').show();
                                } else {
                                    //reset_selects();
                                    $('#chkactualizar').hide();
                                    $('#uejecutora').attr("required", false); $('#cuejecutora').hide();
                                    $('#pliego').attr("required", false); $('#cpliego').hide();
                                    $('#condicion').attr("required", false);

                                    //$('#entidad').select2();
                                    $('#entidad').val(null).trigger('change');

                                    if (cmb.privado == "1") {
                                        $("#editsw").prop("checked", false);
                                        $('#establecimiento').attr("required", false); $('#cestablecimiento').hide();
                                        disabled_selects(["profesion", "entidad", "tipo"], false);
                                        disabled_selects(["departamento", "provincia", "distrito", "establecimiento"], true);
                                        $('#ruc').attr("required", true); $('#cruc').show();
                                        $('#rsocial').attr("required", true); $('#crsocial').show();
                                        $('#tipo').attr("required", true); $('#ctipo').show();
                                    } else {
                                        $("#editsw").prop("checked", true);
                                        $('#establecimiento').attr("required", true); $('#cestablecimiento').show();
                                        disabled_selects(["departamento", "provincia", "distrito", "establecimiento", "profesion", "entidad", "regimen"], false);
                                        $('#ruc').attr("required", false); $('#cruc').hide();
                                        $('#rsocial').attr("required", false); $('#crsocial').hide();
                                        $('#tipo').attr("required", false); $('#ctipo').hide();
                                    }
                                }
                            }
                            if (cmb.archivos == "1") {
                                $('#crdarchivo').collapse("show");
                                $('#div-guardar').hide();
                                //$('#upload').attr("required", true);
                                //$('#tipo').attr("required", true);
                            } else {
                                $('#crdarchivo').collapse("hide");
                                $('#div-guardar').show();
                                //$('#upload').attr("required", false);
                                //$('#tipo').attr("required", false);
                            }
                            $("#loading").attr("hidden", true);
                            $("#validar").attr("disabled", false);
                            break;

                        default:
                            $("#guardar").attr("disabled", false);
                            $("#loading").attr("hidden", true);
                            $("#validar").attr("disabled", false);
                            $("#nombres").val(""); $("#apepat").val(""); $("#apemat").val("");
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
        else {
            Swal.fire({
                title: "Hey!",
                text: "Escribe tu nro de documento y tu fecha de nacimiento para validarlo!",
                type: "warning",
                confirmButtonClass: "btn btn-confirm mt-2"
            });
        }
    })

    $('#btnaceptar').click(function (e) {
        $('#chkterminos').prop("checked", true);
        $('#miModal').modal('hide');
    });

    $("#chkterminos").on('change', function () {
        if ($(this).is(":checked")) {
            $('#chkterminos').prop("checked", false);
            $('#editor-title').text('Términos y Condiciones del trato de Información');
            $('#btnaceptar').removeClass('visible');
            $('#btnaceptar').addClass('invisible');
            $('#miModal').modal({ backdrop: 'static', keyboard: false, show: true });
        } else {
            $('#editor-title').text('Términos y Condiciones del trato de Información');
            $('#btnaceptar').removeClass('visible');
            $('#btnaceptar').addClass('invisible');
            $('#miModal').modal({ backdrop: 'static', keyboard: false, show: true });
        }
    });

    $('#mbody').scroll(function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            //console.log('Creo que llegó al final xd');
            $('#btnaceptar').removeClass('invisible');
            $('#btnaceptar').addClass('visible');
        }
    });

    $("input[name|='file']").change(function () {
        if ($(this).val() != "") {
            var file = this.files[0];
            var tipo_archivo = file.type;
            //console.log(tipo_archivo);
            if (tipo_archivo == "application/pdf") {
                var files = $(this)[0].files;
                var nombre = files[0].name;
                var txt = $(this).parent().next().children();
                txt.val("Archivo a subir: " + nombre);
            } else {
                $(this).val("");
                Swal.fire({
                    title: "Formato Inválido!",
                    text: "Solo se aceptan archivos con formato PDF!!",
                    type: "warning",
                    confirmButtonClass: "btn btn-confirm mt-2"
                });
                return false;
            }
        }
    });

    $('#rucvalida').click(function (e) {
        e.preventDefault();

        var ruc = $("#ruc").val();
        //console.log(dni);

        if (ruc.trim() != "" || ruc.trim().length == 11) {
            $("#loadingruc").attr("hidden", false);
            $("#rucvalida").attr("disabled", true);

            $.ajax({
                url: "index.php",
                data: { ruc: ruc.trim(), controller: 'rucvalida' },
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

                            $('#departamento').val(data.ubigeo.substring(0, 2)).trigger('change');
                            clear_selects(["provincia", "distrito"], true);
                            $('#provincia').append(new Option(data.provincia, data.ubigeo.substring(2, 4), false, false)).val(data.ubigeo.substring(2, 4)).trigger('change');
                            $('#distrito').append(new Option(data.distrito, data.ubigeo.substring(4, 6), false, false)).val(data.ubigeo.substring(4, 6)).trigger('change');

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
        else {
            Swal.fire({
                title: "Hey!",
                text: "Escribe un número de RUC válido!",
                type: "warning",
                confirmButtonClass: "btn btn-confirm mt-2"
            });
        }
    })

    $editor.submit(function (e) {
        e.preventDefault();
        if (this.checkValidity && !this.checkValidity()) return;
        var sdata;
        var cmb;
        var val_privado;
        var val_archivo;
        var val_idpliego;
        var val_uejec;
        var val_dni;
        var val_fecnac;
        var val_entidad;
        var val_estab;
        var val_idestab;
        var val_prof;
        var val_reglab;
        var val_condlab;
        var val_idcondlab;
        var val_ubigeo;
        var val_extranjero

        //EXTRANJERO
        if ($('#chkextranjero').is(":checked")) {
            val_extranjero = true;
            val_privado = 0;
            val_archivo = 0;
            val_idpliego = 0;
            val_uejec = 0;
            val_dni = 0;
            val_fecnac = 0;
            val_entidad = 0;
            val_estab = 0;
            val_idestab = 0;
            val_prof = 0;
            val_reglab = 0;
            val_condlab = 0;
            val_idcondlab = 0;
            val_ubigeo = 0;
        } else {
            val_extranjero = false;
            sdata = $dni.data('row');
            cmb = $cmb.data('values');
            val_privado = cmb.privado;
            val_archivo = cmb.archivos;
            val_idpliego = sdata.c_pliego;
            val_uejec = sdata.c_uejecutora;
            val_dni = $("#dni").val().trim();
            val_fecnac = $("#curso").val();
            val_entidad = $("#entidad").val();
            val_estab = $('#establecimiento').select2('data')[0].text;
            val_idestab = $("#establecimiento").val();
            val_prof = $("#profesion").val();
            val_reglab = $("#regimen").val();
            val_condlab = $('#condicion').select2('data')[0].text;
            val_idcondlab = $("#condicion").val();
            val_ubigeo = $("#departamento").val() + $("#provincia").val() + $("#distrito").val();

            if (cmb.archivos == "1") {
                if (!$("#chkterminos").is(":checked")) {
                    Swal.fire({
                        title: "Lo sentimos",
                        text: "Solo podras participar de este curso si aceptas los Términos y Condiciones del trato de Información.",
                        type: "warning",
                        confirmButtonClass: "btn btn-confirm mt-2"
                    });
                    return;
                }
            }
        }

        $("#guardar").attr("disabled", true);

        var formElement = document.getElementById("frmGuardar");
        var post = new FormData(formElement);
        post.append("extranjero", val_extranjero);
        post.append("controller", 'guardar');
        post.append("privado", val_privado);
        post.append("archivo", val_archivo);
        post.append("dni", val_dni);
        post.append("curso", $("#curso").val());
        post.append("fecnac", val_fecnac);
        post.append("entidad", val_entidad);
        post.append("ipliego", val_idpliego);
        post.append("iuejecutora", val_uejec);
        post.append("establecimiento", val_estab);
        post.append("iestablecimiento", val_idestab);
        post.append("id_pro", val_prof);
        post.append("id_reglab", val_reglab);
        post.append("condlab", val_condlab);
        post.append("icondlab", val_idcondlab);
        post.append("ubigeo", val_ubigeo);

        Swal.fire({
            title: "Guardando...",
            type: "info",
            showCloseButton: 0,
            showCancelButton: 0,
            showConfirmButton: 0,
            onBeforeOpen: function () {
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
            success: function (data) {
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
                }).then((result) => {
                    if (result) {
                        if (status == 2 || status == 6) {
                            location.reload();
                        }
                    }
                });
                $("#guardar").attr("disabled", false);
            }
        });
    })
});

function init_selects() {
    append_data_select('curso', '', 'id', 0, "---Seleccione un Curso---");
    //SELECT DE PAISES
    append_data_select('pais', '', 'id', 0, "---Seleccione un País---");
    append_data_select('departamento', '', 'cod_dep', 2);
    append_data_select('profesion', '', 'id_pro', 1);
    append_data_select('condicion', '', 'id_cond', 6);
    $('#entidad').select2();
    $('#regimen').select2();
    clear_selects(["provincia", "distrito", "establecimiento"], true);
}

function reset_selects() {
    $('#departamento').val(null).trigger('change');
    $('#profesion').val(null).trigger('change');
    $('#regimen').val(null).trigger('change');
    $('#condicion').val(null).trigger('change');
    clear_selects(["provincia", "distrito", "establecimiento"], true);
}

function append_data_select(select, id, cod, spin, tx = '') {
    $("#spinload" + spin).attr("hidden", false);
    $.ajax({
        url: "include/util/getFunctions.php",
        data: { function: 'get' + select, id: id },
        dataType: "json",
        type: "POST",
        success: function (data) {
            $('#' + select).select2({
                data: to_array_objects(data, cod, select, tx),
            });
            $("#spinload" + spin).attr("hidden", true);
        },
        error: function (data) {
            console.log(data.responseText);
            $("#spinload" + spin).attr("hidden", true);
        }
    });
}

function to_array_objects(params, cod, des, tx) {
    var data = new Array();
    data.push({ id: '', text: tx == '' ? 'Seleccione...' : tx });
    $.each(params, function (i, item) {
        var f = { id: item[cod], text: item[des] }
        data.push(f);
    });
    return data;
}

function clear_selects(params, zeroRow) {
    if (params.length > 0) {
        $.each(params, function (i, item) {
            $('#' + item).val(null).empty();
            if (zeroRow) {
                $('#' + item).append(new Option("Seleccione...", "", false, false)).trigger('change');
            }
        });
    }
}

function disabled_selects(params, val) {
    if (params.length > 0) {
        $.each(params, function (i, item) {
            $('#' + item).attr("disabled", val);
        });
    }
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}

function clear_inputs(params) {
    if (params.length > 0) {
        $.each(params, function (i, item) {
            $('#' + item).val('');
        });
    }
}