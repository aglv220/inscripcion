$(document).ready(function () {
    /******** INICIALIZACIÓN *******/
    //INICIALIZACIÓN DE SELECT2
    $(".select2").select2()
    init_selects();
    //INICIALIZACIÓN DE TOOLTIPS
    tippy('.tippy-tooltip');
    tippy('.tippy-tooltip-tab');
    //INICIALIZACIÓN DE FORMULARIOS
    $(".parsley-form").parsley()

    /******** VARIABLES GLOBALES *******/
    var $dni = $('#dni');
    var $editor = $('#frmGuardar');
    var $frmuser = $('#frmListCursos');
    var $cmb = $('#curso');
    var $btn_info_laboral = $('.btn-info-laboral');
    var $lbl_dni = $('#label-dni');
    var $tooltip_doc = $('.dni-tooltip');
    var id_curso = 0;
    var txtdatospers = "Ingrese su Número de documento junto a su Fecha de Nacimiento, luego haga click en 'Validar', sus nombres y apellidos se rellenarán automáticamente";
    var txtdatospers1 = "Si usted cuenta con DNI del Perú o Carnet de Extranjería, ingrese su Número de documento junto a su Fecha de Nacimiento, luego haga click en 'Validar', sus nombres y apellidos se rellenarán automáticamente; caso contrario si usted es Extranjero(a) y no cuenta con DNI ni con Carnet de Extranjería, active la casilla 'Soy extranjero(a) y no cuento con DNI del Perú ni con Carnet de Extranjería'";
    var txtdatospers2 = "Para continuar con el proceso de registro ingrese sus datos personales, tales como: Documento de Identidad (del documento que tenga disponible, ya sea pasaporte, pase temporal o algún documento de su país de procedencia, caso contrario puede dejarlo vacío), Fecha de nacimiento, País de procedencia, Apellido Paterno, Apellido Materno, Nombres, Email, Confirmación de Email y Número de celular";
    var textlaboral_ext = "Ingrese el nombre de la Institución donde labora y el nombre de la profesión que ejerce actualmente.";
    var textlaboral_priv = "Ingrese el nro. RUC y Nombre de la Institución donde labora, el nombre de la Profesión que ejerce actualmente y seleccione el Departamento, Provincia y Distrito (secuencialmente) donde usted labora.";
    var txt_lbl_dni_peru = "Documento Nacional de Identidad";
    var txt_lbl_dni_ext = "Documento de Identidad (Opcional)";
    var lst_tipos_participante = ["minsa", "extranjero", "privado", "acreditado"];
    var tipo_participante = 0;
    var participante_noinforhus = false;
    var validar_rucxsunat = false;
    var is_curso_libre = false;
    //var cursos_libreacceso = [0];

    //CAMPOS DE BUSQUEDA DE INSCRIPCIONES
    var search_doc = $('input[name="search_doc"]');
    var search_mail = $('input[name="search_mail"]');
    var search_ape = $('input[name="search_ape"]');
    var search_btn = $('#btn-search');
    var chkuseemail = $('#chkuseemail');
    var div_search_doc = $('#id-search-doc');
    var div_search_email = $('#id-search-email');

    //$('#table-search').DataTable();

    /******** DATOS POR DEFECTO *******/
    //BUSQUEDA DE INSCRIPCIONES
    chkuseemail.prop("checked", false);
    search_mail.prop("required", false);
    div_search_email.hide();

    //DATOS PERSONALES
    $('.mostrar').hide();
    //DIV LABORAL EXTRANJERO / PRIVADO
    $('.mostrar-ext-il').hide();
    //DIV LABORAL PERSONAL MINSA
    $('.div-laboral-minsa').hide();
    //CAMPO CODIGO MODULAR
    $(".div-cod-modular").hide();
    //CHK-EXTRANJERO
    $("#div-chkextranjero").hide();
    $("#div-pais").hide();
    $('.mostrar-ext-il').hide();
    $('.div-laboral-minsa').hide();
    $('#chkextranjero').prop("disabled", true);
    $('#guardar').prop("disabled", false);
    //SECCION-PRIVADO
    mostrar_seccion_privado(false);

    $('.div-ubigeo').show();
    //NRO RUC MANUAL
    $('.div-nroruc-ext').hide();
    $btn_info_laboral.hide();
    //TOOLTIP DE DOCUMENTO DE IDENTIDAD
    $tooltip_doc.hide();
    //MENSAJE DE AVISO POR CURSO
    //$(".msg-aviso").hide();

    /******** EVENTOS DE CONTROLES *******/

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

    //CAMPO DNI
    $('#dni').on('input', function () {
        var vacio = $(this).prop('value') === '';
        if (vacio) {
            //TIPO DE PARTICIPANTE
            tipo_participante = 0; //MINSA

            $('.mostrar').hide();
            $('#crdlaboral').collapse("hide");
            clear_inputs(["apepat", "apemat", "nombres", "apecas", "fecha"]);

            if (is_curso_libre) { //ES CURSO LIBRE
                //CHKEXTRANJERO
                $('#chkextranjero').prop("checked", false);
                //DIV PAIS
                $("#div-pais").hide();
                $('#div-pais select[name="pais"]').prop("required", false);
                $('#div-pais select[name="pais"]').prop("disabled", true);
                //RESETEAR SELECCION DE PAIS
                $('#pais').val(null).trigger('change');
                //CHKPRIVADO
                mostrar_seccion_privado(true);
                //CAMPOS PARA VALIDAR POR RENIEC
                $('input[name="dni"]').prop("required", true);
                $lbl_dni.html(txt_lbl_dni_peru);
                $tooltip_doc.hide();
                $('input[name="dni"]').attr("data-parsley-minlength", 8);
                $('input[name="dni"]').prop("maxlength", 9);
                $('input[name="dni"]').prop("placeholder", "Documento Nacional de Identidad del Perú");
                //BTN VALIDAR DNI
                $("#validar").show();
                $("#validar").attr("disabled", false);
                $("#loading").attr("hidden", true);
            }
        }
    });

    $('[data-toggle="input-mask"]').each(function (t, e) {
        var n = $(e).data("maskFormat")
            , a = $(e).data("reverse");
        null != a ? $(e).mask(n, {
            reverse: a
        }) : $(e).mask(n)
    })

    //CHECKBOX USE EMAIL
    chkuseemail.on('change', function () {
        if (!chkuseemail.is(":disabled")) {
            search_mail.val("");
            search_doc.val("");
            if (chkuseemail.is(":checked")) {
                div_search_doc.hide();
                div_search_email.show();
                search_mail.prop("required", true);
                search_doc.prop("required", false);
            } else {
                div_search_doc.show();
                div_search_email.hide();
                search_mail.prop("required", false);
                search_doc.prop("required", true);
            }
        }
    });

    //CHECKBOX PARTICIPANTE EXTRANJERO
    $("#chkextranjero").on('change', function () {
        if (!$('#chkextranjero').is(":disabled")) {
            //LIMPIAR CONTROLES DE DNI Y FECHA DE NACIMIENTO
            $('input[name="dni"]').val("");
            $('input[name="fecha"]').val("");
            //RESETEAR SELECCION DE PAIS
            $('#pais').val(null).trigger('change');
            //VALIDAR CAMBIOS EN EL CHECKBOX EXTRANJERO
            if ($('#chkextranjero').is(":checked")) { //PARTICIPANTE EXTRANJERO
                //TIPO DE PARTICIPANTE
                tipo_participante = 1;

                $("#div-pais").show();
                $('#div-pais select[name="pais"]').prop("required", true);
                $('#div-pais select[name="pais"]').prop("disabled", false);

                //BTN VALIDAR DNI
                $("#validar").hide();
                $("#validar").attr("disabled", true);
                $("#loading").attr("hidden", true);

                //CAMPOS DE DOCUMENTO Y FECHA DE NACIMIENTO
                $('input[name="dni"]').prop("required", false);
                $lbl_dni.html(txt_lbl_dni_ext);
                $tooltip_doc.show();

                $('input[name="dni"]').attr("data-parsley-minlength", 5);
                $('input[name="dni"]').prop("maxlength", 20);
                $('input[name="dni"]').prop("placeholder", "Documento de Identidad");

                //DATOS PERSONALES
                $(".txt-datospers").html(txtdatospers2);

                //SECCIÓN DE DATOS PERSONALES
                $('.mostrar').show();
                //SECCIÓN LABORAL COMPLETA
                $('#crdlaboral').collapse("show");
                //DIV LABORAL MINSA
                $('.div-laboral-minsa').hide();
                //DIV LABORAL EXTRANJERO / PRIVADO
                $('.mostrar-ext-il').show();
                //BOTON GUARDAR
                $("#guardar").attr("disabled", false);
                //NRO RUC MANUAL
                $('.div-nroruc-ext').hide();
                //BOTON INFO LABORAL
                $btn_info_laboral.hide();

                //CHK-PRIVADO
                mostrar_seccion_privado(false);

                //LIMPIAR CONTROLES DE DATOS PERSONALES
                $('div.mostrar input').val("");
                $('div.mostrar input').prop("readonly", false);
                //INFORMACIÓN LABORAL - EXTRANJERO
                $('div.mostrar-ext-il input').prop("required", true);
                $('div.mostrar-ext-il input').prop("disabled", false);
                $('div.mostrar-ext-il input').val("");
                //DESHABILITAR Y OCULTAR CAMPO DE NUMERO RUC PARA EXTRANJEROS
                $('#ext_nroruc').prop("required", false);
                $('#ext_nroruc').prop("disabled", true);

                //TEXTO DE SECCION LABORAL
                $('.text-div-laboral').html(textlaboral_ext);

                $("#nombres").prop("readonly", false);
                $("#apepat").prop("readonly", false);
                $("#apemat").prop("readonly", false);
                $("#apecas").prop("readonly", false);

                //CAMPOS DE UBIGEO
                $('.div-ubigeo').hide();
                //EDITAR CAMPOS LABORALES
                $("#editsw").prop("disabled", true);
                $("#editsw").prop("checked", false);

                //DATOS LABORALES
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

            } else { //PARTICIPANTE DEL PERÚ
                //TIPO DE PARTICIPANTE
                tipo_participante = 0;

                $("#div-pais").hide();
                $('#div-pais select[name="pais"]').prop("required", false);
                $('#div-pais select[name="pais"]').prop("disabled", true);

                //BTN VALIDAR DNI
                $("#validar").show();
                $("#validar").attr("disabled", false);
                $("#loading").attr("hidden", true);

                //CAMPOS PARA VALIDAR POR RENIEC
                $('input[name="dni"]').prop("required", true);
                $lbl_dni.html(txt_lbl_dni_peru);
                $tooltip_doc.hide();

                $('input[name="dni"]').attr("data-parsley-minlength", 8);
                $('input[name="dni"]').prop("maxlength", 9);
                $('input[name="dni"]').prop("placeholder", "Documento Nacional de Identidad del Perú");

                //DATOS PERSONALES
                $(".txt-datospers").html(txtdatospers1);
                //NRO RUC MANUAL
                $('.div-nroruc-ext').show();
                //SECCION DE DATOS PERSONALES
                $('.mostrar').hide();
                //CHK-PRIVADO
                mostrar_seccion_privado(true);
                //SECCIÓN LABORAL
                $('#crdlaboral').collapse("hide");
                //DIV LABORAL EXTRANJERO / PRIVADO
                $('.mostrar-ext-il').hide();
                //DIV LABORAL MINSA
                $('.div-laboral-minsa').hide();

                //INFORMACIÓN LABORAL - EXTRANJERO
                $('div.mostrar-ext-il input').prop("required", false);
                $('div.mostrar-ext-il input').prop("disabled", true);
                $('div.mostrar-ext-il input').val("");
            }
        }
    });

    //CHECKBOX PARTICIPANTE DE ENTIDAD PRIVADA
    $("#chkprivado").on('change', function () {
        if (!$('#chkprivado').is(":disabled")) {
            //REINICIAR INPUTS DE EXTRANJEROS / PRIVADO
            $('div.mostrar-ext-il input').val("");
            //REINICIAR SELECTS DE UBIGEO
            $('#departamento').val(null).trigger('change');
            clear_selects(["provincia", "distrito"], true);

            //CAMPOS DE UBIGEO
            if (participante_noinforhus == true) { //SI PASO RENIEC Y NO TIENE INFORHUS
                $("#departamento, #provincia, #distrito").prop("disabled", false);
                $("#departamento, #provincia, #distrito").prop("required", true);
            } else {
                $("#departamento, #provincia, #distrito").prop("disabled", true);
                $("#departamento, #provincia, #distrito").prop("required", false);
            }

            if ($('#chkprivado').is(":checked")) { //PERTENECE A UNA ENTIDAD PRIVADA
                //TIPO DE PARTICIPANTE
                tipo_participante = 2;
                //DIV LABORAL EXTRANJERO / PRIVADO
                $('.mostrar-ext-il').show();
                //DIV LABORAL MINSA
                $('.div-laboral-minsa').hide();
                //CAMPOS DE UBIGEO
                $("#departamento, #provincia, #distrito").prop("disabled", false);
                $("#departamento, #provincia, #distrito").prop("required", true);
                //NRO RUC MANUAL
                $('.div-nroruc-ext').show();
                //DATOS LABORALES EXTRANJEROS / ENTIDAD PRIVADA
                $('div.mostrar-ext-il input').prop("required", true);
                $('div.mostrar-ext-il input').prop("disabled", false);

                //QUITAR REQUERIDO DE RUC PARA PRIVADOS - POR DESCONOCIMIENTO
                $('#ext_nroruc').prop("required", false);

                //DATOS LABORALES
                $("#entidad").attr("required", false);
                $("#profesion").attr("required", false);
                $("#regimen").attr("required", false);
                $('#pliego').attr("required", false);
                $('#uejecutora').attr("required", false);
                $("#establecimiento").attr("required", false);
                $("#condicion").attr("required", false);
                $('#ruc').attr("required", false);
                $('#rsocial').attr("required", false);
                $('#tipo').attr("required", false);
                //TEXTO INFORMATIVO DE SECCIÓN LABORAL
                $('.text-div-laboral').html(textlaboral_priv);
                //BOTON INFO LABORAL
                $btn_info_laboral.hide();
            } else { //PERTENECE AL MINSA U OTRA INSTITUCIÓN ACREDITADA
                //TIPO DE PARTICIPANTE
                if (participante_noinforhus == true) { //SI NO TIENE INFORHUS
                    tipo_participante = 3; //ES ACREDITADO
                    $('#entidad').val(null).trigger('change');
                    $('#profesion').val(null).trigger('change');
                    $('#regimen').val(null).trigger('change');
                    $('#departamento').val(null).trigger('change');
                    $('#provincia').val(null).trigger('change');
                    $('#distrito').val(null).trigger('change');
                    $('#establecimiento').val(null).trigger('change');
                } else { //TIENE DATOS EN LA BASE DE DATOS
                    if ($("#entidad").selectedIndex == 1 || $("#entidad").val() == 1) {
                        tipo_participante = 0; //ES MINSA
                    } else {
                        tipo_participante = 3; //ES ACREDITADO
                    }
                }
                //DIV LABORAL EXTRANJERO / PRIVADO
                $('.mostrar-ext-il').hide();
                //DIV LABORAL MINSA
                $('.div-laboral-minsa').show();
                //DATOS LABORALES EXTRANJEROS / ENTIDAD PRIVADA
                $('div.mostrar-ext-il input').prop("required", false);
                $('div.mostrar-ext-il input').prop("disabled", true);
                //NRO RUC MANUAL
                $('.div-nroruc-ext').hide();
                //DATOS LABORALES
                $("#entidad").attr("required", true);
                $("#profesion").attr("required", true);
                $("#regimen").attr("required", true);
                $('#pliego').attr("required", true);
                $('#uejecutora').attr("required", true);
                $("#establecimiento").attr("required", true);
                $("#condicion").attr("required", true);
                $('#ruc').attr("required", true);
                $('#rsocial').attr("required", true);
                $('#tipo').attr("required", true);
                //VALIDAR SELECCION DE PROVINCIA Y DISTRITO
                if ($("#provincia").val() == "" && $("#distrito").val() == "") {
                    $('#guardar').prop("disabled", true);
                    $btn_info_laboral.show();
                } else {
                    $('#guardar').prop("disabled", false);
                    $btn_info_laboral.hide();
                }
            }
        }
    });

    //CONVERTIR TEXTO A MAYUSCULAS
    $('.mostrar-ext-il input[type="text"], .mostrar input[type="text"]').keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });

    //SELECT DE CURSOS
    $("#curso").change(function (data) {
        if (data.currentTarget.selectedIndex > 0) {
            $('#crdpersonal').collapse("show");
            $('.mostrar').hide();
            //DIV LABORAL MINSA
            $('.div-laboral-minsa').hide();
            //NRO RUC MANUAL
            $('.div-nroruc-ext').hide();
            //SECCION LABORAL
            $('#crdlaboral').collapse("hide");
            clear_inputs(["dni", "apepat", "apemat", "nombres", "apecas", "fecha"]);
            //BOTON DE REGISTRO POR DEFECTO
            $('#guardar').prop("disabled", false);
            //CAMPO CODIGO MODULAR
            id_curso = data.currentTarget.value;

            //CURSOS CON CODIGO MODULAR
            if (id_curso == 178 || id_curso == 179) {
                $(".div-cod-modular").show();
                $("#cod_modular").prop("required", true);
            } else {
                $(".div-cod-modular").hide();
                $("#cod_modular").prop("required", false);
            }

            //CAMPOS POR DEFECTO - DIV CHKEXTRANJERO
            $("#div-chkextranjero").hide();
            //CAMPOS POR DEFECTO - CHKPRIVADO
            $('#chkprivado').prop("checked", false);
            //CAMPOS POR DEFECTO - CHKEXTRANJERO
            $('#chkextranjero').prop("checked", false);

            //CAMPOS POR DEFECTO - PAIS
            $("#div-pais").hide();
            $('#div-pais select[name="pais"]').prop("required", false);
            $('#div-pais select[name="pais"]').prop("disabled", true);
            //INFORMACIÓN LABORAL - EXTRANJERO
            $('div.mostrar-ext-il input').prop("required", false);
            $('div.mostrar-ext-il input').prop("disabled", true);
            $('div.mostrar-ext-il input').val("");
            $(".txt-datospers").html(txtdatospers);

            //DATOS PARA VALIDACIÓN RENIEC
            $('input[name="dni"]').prop("required", true);
            $('input[name="dni"]').val("");
            $('input[name="fecha"]').val("");
            $('input[name="dni"]').attr("data-parsley-minlength", 8);
            $('input[name="dni"]').prop("maxlength", 9);
            $('input[name="dni"]').prop("placeholder", "Documento Nacional de Identidad del Perú");
            $lbl_dni.html(txt_lbl_dni_peru);
            $tooltip_doc.hide();

            //BOTON VALIDAR DNI
            $("#validar").show();

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
                    /** DATOS ADICIONALES */
                    values.tipo_curso = data[0].curso_tipo;
                    values.curso_detalle = data[0].curso_detalle;
                    values.curso_libre = data[0].curso_libre == null ? 0 : data[0].curso_libre;

                    //TIPO DE PARTICIPANTE POR DEFECTO (MINSA)
                    tipo_participante = 0;

                    if (values.curso_libre == 1) { //ES CURSO LIBRE
                        //MOSTRAR CHECKBOX DE EXTRANJERO
                        $("#div-chkextranjero").show();
                        $('#chkextranjero').prop("disabled", false);
                        $(".txt-datospers").html(txtdatospers1);
                        //MOSTRAR CHECKBOX DE PRIVADO
                        mostrar_seccion_privado(true);
                        is_curso_libre = true;
                    } else { //CURSO DE INSCRIPCIÓN SOLO MINSA
                        //OCULTAR CHECKBOX DE EXTRANJERO
                        $("#div-chkextranjero").hide();
                        $('#chkextranjero').prop("disabled", true);
                        $(".txt-datospers").html(txtdatospers);
                        //OCULTAR CHECKBOX DE PRIVADO
                        mostrar_seccion_privado(false);
                        is_curso_libre = false;
                    }

                    if (values.curso_detalle != null && values.curso_detalle != "") {
                        $(".msg-aviso").show();
                        $(".msg-aviso").html(values.curso_detalle);
                    } else {
                        $(".msg-aviso").hide();
                        $(".msg-aviso").html("");
                    }

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

    $(".probar").click(function (data) {
        console.log(lst_tipos_participante[tipo_participante]);
    });

    $("#entidad").change(function (data) {
        if ((data.currentTarget.selectedIndex == 1)) { //SI NO TIENE INFORHUS Y SELECCIONO MINSA
            tipo_participante = 0; // ES MINSA
        } else {
            tipo_participante = 3; // ES ACREDITADO
        }
    });

    $("#departamento").change(function (data) {
        var pass = false;
        var selects_to_clear = [];
        if ((data.currentTarget.selectedIndex > 0 && $('#editsw').is(":checked") && !$('#chkprivado').is(":checked"))) {
            selects_to_clear = ["provincia", "distrito", "establecimiento"];
            pass = true;
        }
        if ((data.currentTarget.selectedIndex > 0 && $('#chkprivado').is(":checked"))) {
            selects_to_clear = ["provincia", "distrito"];
            pass = true;
        }
        if (pass) {
            clear_selects(selects_to_clear, true);
            append_data_select('provincia', data.currentTarget.value, 'cod_prov', 3);
        }

    });

    $("#provincia").change(function (data) {
        var pass = false;
        if ((data.currentTarget.selectedIndex > 0 && $('#editsw').is(":checked") && !$('#chkprivado').is(":checked"))) {
            selects_to_clear = ["distrito", "establecimiento"];
            pass = true;
        }
        if ((data.currentTarget.selectedIndex > 0 && $('#chkprivado').is(":checked"))) {
            selects_to_clear = ["distrito"];
            pass = true;
        }
        if (pass) {
            var mcod = $('#departamento').val() + ',' + data.currentTarget.value
            clear_selects(selects_to_clear, true);
            append_data_select('distrito', mcod, 'cod_dis', 4)
        }
    });

    $("#distrito").change(function (data) {
        if ((data.currentTarget.selectedIndex > 0 && $('#editsw').is(":checked") && !$('#chkprivado').is(":checked"))) {
            var ubigeo = $('#departamento').val() + $('#provincia').val() + data.currentTarget.value
            clear_selects(["establecimiento"], true);
            append_data_select('establecimiento', ubigeo, 'cod_renaes', 5)
            $('#guardar').prop("disabled", false);
        }
        if ((data.currentTarget.selectedIndex > 0 && $('#chkprivado').is(":checked"))) {
            $('#guardar').prop("disabled", false);
        } else if ((data.currentTarget.selectedIndex == 0 && $('#chkprivado').is(":checked"))) {
            $('#guardar').prop("disabled", true);
        }
    });

    //BOTON VALIDAR POR RENIEC
    $('#validar').click(function (e) {
        e.preventDefault();
        $('.mostrar').hide();
        $('.mostrar-ext-il').hide();
        //INFORMACIÓN LABORAL - EXTRANJERO        
        $('div.mostrar-ext-il input').prop("required", false);
        $('div.mostrar-ext-il input').prop("disabled", true);
        $('div.mostrar-ext-il input').val("");
        //BOTON DE REGISTRO POR DEFECTO
        $('#guardar').prop("disabled", false);
        //DIV LABORAL MINSA
        $('.div-laboral-minsa').hide();
        //SECCION LABORAL COMPLETA
        $('#crdlaboral').collapse("hide");
        $("#editsw").prop("disabled", true);
        $("#editsw").prop("checked", false);
        reset_selects();
        $('#opcion').attr("disabled", true);

        var dni = $("#dni").val();
        var fecha = $("#fecha").val();

        if (!is_curso_libre) { //SI NO ES UN CURSO LIBRE (false)
            mostrar_seccion_privado(false);
        }

        if (dni != "" && fecha != "") {
            $("#loading").attr("hidden", false);
            $("#validar").attr("disabled", true);

            $.ajax({
                url: "index.php",
                data: { documento: dni, fecnac: fecha, controller: 'validar' },
                dataType: "json",
                type: "POST",
                success: function (data) {
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

                            //DIV CAMPOS UBIGEO
                            $('.div-ubigeo').show();
                            //NRO RUC MANUAL
                            $('.div-nroruc-ext').hide();
                            //BOTON INFO LABORAL
                            $btn_info_laboral.hide();

                            $("#editsw").prop("disabled", false);
                            $("#nombres").val(data.nombres);
                            $("#apepat").val(data.apepat);
                            $("#apemat").val(data.apemat);
                            $("#apecas").val(data.apecas);

                            //DIV PAIS
                            if ($('#chkextranjero').is(":checked")) {
                                $("#div-pais").show();
                                $('#div-pais select[name="pais"]').prop("required", true);
                                $('#div-pais select[name="pais"]').prop("disabled", false);
                            } else {
                                $("#div-pais").hide();
                                $('#div-pais select[name="pais"]').prop("required", false);
                                $('#div-pais select[name="pais"]').prop("disabled", true);
                            }

                            $("#nombres").prop("readonly", true);
                            $("#apepat").prop("readonly", true);
                            $("#apemat").prop("readonly", true);
                            $("#apecas").prop("readonly", true);

                            if (id_curso == 190 || id_curso == 191 || id_curso == 192 ||
                                id_curso == 193 || id_curso == 194 || id_curso == 195 ||
                                id_curso == 196 || id_curso == 197) { // SI SE ELIGIÓ EL CURSO PARA VALIDAR PROFESORES
                                $('#crdlaboral').collapse("hide");
                                //DATOS LABORALES
                                $("#entidad").attr("required", false);
                                $("#profesion").attr("required", false);
                                $("#departamento").attr("required", false);
                                $("#provincia").attr("required", false);
                                $("#distrito").attr("required", false);
                                $("#establecimiento").attr("required", false);
                                $("#regimen").attr("required", false);
                                $("#condicion").attr("required", false);

                                //CAMPOS REQUERIDOS OCULTOS QUITADOS DE VALIDACION - ANGEL LAOS - 31-03-2022
                                $('#pliego').attr("required", false);
                                $('#uejecutora').attr("required", false);
                                $('#rsocial').attr("required", false);
                            } else {
                                //SECCION LABORAL COMPLETA
                                $('#crdlaboral').collapse("show");
                                //DIV LABORAL MINSA
                                $('.div-laboral-minsa').show();
                                //DIV LABORAL EXTRANJERO / PRIVADO
                                $('.mostrar-ext-il').hide();

                                //Si existe en la Base de Datos o es MINSA (INFORHUS)
                                if (data.ext == true || data.entidad == "MINSA") {

                                    participante_noinforhus = false;
                                    $('#ruc').attr("required", false); $('#cruc').hide();
                                    $('#rsocial').attr("required", false); $('#crsocial').hide();
                                    $('#tipo').attr("required", false); $('#ctipo').hide();

                                    $('#establecimiento').attr("required", true); $('#cestablecimiento').show();
                                    disabled_selects(["entidad", "departamento", "provincia", "distrito", "establecimiento", "profesion", "regimen"], true);
                                    // $("#correo").val(data.correo);
                                    // $("#telefono").val(data.telefono);

                                    $('#profesion').val(data.id_pro).trigger('change');
                                    $('#departamento').val(data.cod_dep).trigger('change');

                                    $('#provincia').append(new Option(data.provincia, data.cod_prov, false, false)).val(data.cod_prov).trigger('change');
                                    $('#distrito').append(new Option(data.distrito, data.cod_dis, false, false)).val(data.cod_dis).trigger('change');
                                    $('#establecimiento').append(new Option(data.establecimiento, data.c_renaes, false, false)).val(data.c_renaes).trigger('change');

                                    //OCULTO OPCIÓN SI EXISTE EN LA BD
                                    if (is_curso_libre) {
                                        mostrar_seccion_privado(false);
                                    }

                                    if (data.entidad == "EXTERNO") { //CARGADO EN LA BD PERO SIN INFORHUS
                                        $('#opcion').attr("disabled", true);
                                        $('#entidad').select2();
                                        $('#entidad').val(data.id_entidad).trigger('change');
                                        $('#uejecutora').attr("required", false); $('#cuejecutora').hide();
                                        $('#pliego').attr("required", false); $('#cpliego').hide();
                                        $('#condicion').attr("required", false);
                                        $('#regimen').val(data.id_reglab).trigger('change');
                                        $('#regimen').attr("disabled", data.id_reglab == "" ? false : true);
                                        $('#profesion').attr("disabled", data.id_pro == "" ? false : true);

                                        if (data.id_entidad === null) { //SI EL CAMPO ENTIDAD NO EXISTE EN LA BD
                                            disabled_selects(["entidad"], false);
                                        }

                                        if (data.cod_dep === null) {
                                            $("#editsw").prop("checked", true);
                                            disabled_selects(["departamento", "provincia", "distrito", "establecimiento"], false);
                                        } else {
                                            $("#editsw").prop("checked", false);
                                        }
                                        console.log("EXTERNO");

                                    } else { //ES PERSONAL MINSA CON INFORHUS

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
                                        //TIPO DE PARTICIPANTE
                                        tipo_participante = 0; //ES MINSA
                                    }
                                    //$('#chkactualizar').show();
                                } else { //VALIDADO POR RENIEC PERO NO PERTENECE AL MINSA (NO INFORHUS)
                                    //reset_selects();
                                    participante_noinforhus = true;

                                    $('#chkactualizar').hide();
                                    $('#uejecutora').attr("required", false); $('#cuejecutora').hide();
                                    $('#pliego').attr("required", false); $('#cpliego').hide();
                                    $('#condicion').attr("required", false);

                                    //$('#entidad').select2();
                                    $('#entidad').val(null).trigger('change');

                                    /** ACTIVAR CHECKBOX DE ENTIDAD PRIVADA **/
                                    if (is_curso_libre) {
                                        mostrar_seccion_privado(true);
                                    }

                                    if (cmb.privado == "1") {
                                        $("#editsw").prop("checked", false);
                                        $('#establecimiento').attr("required", false); $('#cestablecimiento').hide();
                                        disabled_selects(["profesion", "entidad", "tipo"], false);
                                        disabled_selects(["departamento", "provincia", "distrito", "establecimiento"], true);
                                        $('#ruc').attr("required", true); $('#cruc').show();
                                        $('#rsocial').attr("required", true); $('#crsocial').show();
                                        $('#tipo').attr("required", true); $('#ctipo').show();

                                        /*** VERIFICAR POR QUE NO SE ACTIVA EL CHKPRIVADO PARA PERSONAS SIN DATOS EN LA BD ***/
                                        console.log("CMB-PRIVADO 1");
                                    } else {
                                        $("#editsw").prop("checked", true);
                                        $('#establecimiento').attr("required", true); $('#cestablecimiento').show();
                                        disabled_selects(["departamento", "provincia", "distrito", "establecimiento", "profesion", "entidad", "regimen"], false);
                                        $('#ruc').attr("required", false); $('#cruc').hide();
                                        $('#rsocial').attr("required", false); $('#crsocial').hide();
                                        $('#tipo').attr("required", false); $('#ctipo').hide();

                                        console.log("CMB-PRIVADO 2");
                                    }

                                    //TIPO DE PARTICIPANTE
                                    tipo_participante = 3; //ES ACREDITADO
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
                            $("#rsocial").val(data.rsocial);
                            //$('#departamento').val(data.ubigeo.substring(0, 2)).trigger('change');

                            $('#departamento').val(data.departamento[0]).trigger('change');
                            clear_selects(["provincia", "distrito"], true);

                            //$('#provincia').append(new Option(data.provincia, data.ubigeo.substring(2, 4), false, false)).val(data.ubigeo.substring(2, 4)).trigger('change');
                            $('#provincia').append(new Option(data.provincia[1], data.provincia[0], false, false)).val(data.provincia[0]).trigger('change');

                            //$('#distrito').append(new Option(data.distrito, data.ubigeo.substring(4, 6), false, false)).val(data.ubigeo.substring(4, 6)).trigger('change');
                            $('#distrito').append(new Option(data.distrito[1], data.distrito[0], false, false)).val(data.distrito[0]).trigger('change');

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
    });

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
        var v_tipopart = lst_tipos_participante[tipo_participante];

        //NUMERO DE DOCUMENTO
        txt_dni = $("#dni").val().trim();
        val_dni = txt_dni == "" || txt_dni == null ? 0 : txt_dni;
        //FECHA DE NACIMIENTO
        val_fecnac = $("#fecha").val();

        //TIPOS DE PARTICIPANTE: minsa, extranjero, privado
        if (v_tipopart == "extranjero") {
            val_privado = 0;
            val_archivo = 0;
            val_idpliego = 0;
            val_uejec = 0;
            val_entidad = $("#ext_institucion").val();
            val_estab = 0;
            val_idestab = 0;
            val_prof = $("#ext_profesion").val();
            val_reglab = 0;
            val_condlab = 0;
            val_idcondlab = 0;
            val_ubigeo = 0;
        } else if (v_tipopart == "privado") {
            val_privado = 0;
            val_archivo = 0;
            sdata = $dni.data('row');
            val_idpliego = sdata.c_pliego;
            val_uejec = sdata.c_uejecutora;
            val_entidad = $("#ext_institucion").val();
            val_prof = $("#ext_profesion").val();
            val_ubigeo = $("#departamento").val() + $("#provincia").val() + $("#distrito").val();
            val_estab = 0;
            val_idestab = 0;
            val_reglab = 0;
            val_condlab = 0;
            val_idcondlab = 0;
        } else { //ES MINSA O ACREDITADO
            sdata = $dni.data('row');
            cmb = $cmb.data('values');
            val_privado = cmb.privado;
            val_archivo = cmb.archivos;
            val_idpliego = sdata.c_pliego;
            val_uejec = sdata.c_uejecutora;
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
        post.append("tipo_participante", lst_tipos_participante[tipo_participante]);

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

    function badge_estado(estado) {
        var hmtl_badge = "<span class='badge rounded-pill";
        var tipo_badge = "dark";
        switch (estado) {
            case "CURSO EN EJECUCIÓN":
                tipo_badge = "success";
                break;
            case "EN FASE DE INSCRIPCIÓN":
                tipo_badge = "primary";
                break;
            case "CIERRE DE INSCRIPCIÓN":
                tipo_badge = "warning";
                break;
            case "CURSO FINALIZADO":
                tipo_badge = "danger";
                break;
        }
        hmtl_badge += " bg-" + tipo_badge + "'>" + estado + "</span>";
        return hmtl_badge;
    }

    function enlace_curso(estado, codmoodle) {
        html_enlace = '<a class="badge badge-outline-purple rounded-pill"';
        if (estado == "CURSO EN EJECUCIÓN") {
            if (codmoodle != "" && codmoodle != null) {
                enlace_plataforma = 'http://pees.minsa.gob.pe/course/view.php?id=';
                html_enlace += ' href="' + enlace_plataforma + codmoodle + '" target="_blank">IR AL ENLACE';
            } else {
                html_enlace += '>NO ENCONTRADO';
            }
        } else {
            html_enlace += '>NO DISPONIBLE';
        }
        html_enlace += '</a>'
        return html_enlace;
    }

    function msg_alerta(tipo, titulo) {
        Swal.fire({
            title: titulo,
            type: tipo,
            showCloseButton: 0,
            showCancelButton: 0,
            showConfirmButton: 0,
            allowOutsideClick: false
        });
    }

    $frmuser.submit(function (e) {
        e.preventDefault();
        if (this.checkValidity && !this.checkValidity()) return;

        var formElement = document.getElementById("frmListCursos");
        var post = new FormData(formElement);
        post.append("function", 'ConsultaCursosParticipantes');

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: post,
            contentType: false,
            dataType: "json",
            cache: false,
            processData: false,
            beforeSend: function () {
                msg_alerta("info", "Buscando información");
            },
            success: function (data) {
                var a = $("#table-search").DataTable();
                a.destroy();
                tabla = "";
                if (data == false) {
                    Swal.close();
                    Swal.fire({
                        title: "No se encontró información",
                        text: "Los datos ingresados no retornaron resultados",
                        type: "error",
                        confirmButtonClass: "btn btn-confirm mt-2"
                    }).then((result) => {
                        if (result) {
                            Swal.close();
                        }
                    });
                } else {                    
                    $.each(data, function (i, item) {
                        tabla += "<tr>";
                        tabla += "<td>" + item.curso + "</td>";
                        tabla += "<td>" + item.cursotipo + "</td>";
                        tabla += "<td>" + item.ins_inicio + "</td>";
                        tabla += "<td>" + item.ins_fin + "</td>";
                        tabla += "<td>" + item.ejec_inicio + "</td>";
                        tabla += "<td>" + item.ejec_fin + "</td>";
                        tabla += "<td>" + item.fecins + "</td>";
                        tabla += "<td>" + badge_estado(item.estado) + "</td>";
                        tabla += "<td>" + enlace_curso(item.estado,item.codmoodle) + "</td>";
                        tabla += "<td>" + item.cursodetalle + "</td>";
                        tabla += "</tr>";
                    });
                    Swal.close();
                }
                $("#bodytable").html(tabla);
                var a = $("#table-search").DataTable({
                    responsive: true,
                    lengthChange: !1,
                    scrollY: "400px",
                    scrollX: !0,
                    scrollCollapse: !0,
                    paging: !1,
                    language: {
                        paginate: {
                            previous: "<i class='mdi mdi-chevron-left'>",
                            next: "<i class='mdi mdi-chevron-right'>"
                        }
                    },
                    drawCallback: function () {
                        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                    }
                });
                a.buttons().container().appendTo("#table-search_wrapper .col-md-6:eq(0)");
                search_mail.val("");
                search_doc.val("");
                search_ape.val("");
            }
        });
    })

});

function mostrar_seccion_privado(estado = true) {
    $('#chkprivado').prop("checked", false);
    if (estado) {
        $("#div-chkprivado").show();
        $('#chkprivado').prop("disabled", false);
    } else {
        $("#div-chkprivado").hide();
        $('#chkprivado').prop("disabled", true);
    }
}

function init_selects() {
    append_data_select('curso', '', 'id', 0, "---Seleccione un Curso---");
    //SELECT DE PAISES
    append_data_select('pais', '', 'id', 0, "---Seleccione su País de procedencia---");
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