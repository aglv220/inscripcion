<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Inscripciones - Escuela Nacional de Salud Pública</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Formulario de Inscripción a los cursos de la Escuela Nacional de Salud Pública - ENSAP" name="description" />
    <meta content="ENSAP" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $CNG->wwwroot; ?>/assets/images/favicon.ico" />
    <!-- Plugins css-->
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/sweetalert/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="<?php echo $CNG->wwwroot; ?>/assets/css/bootstrap.min.css?v=2" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/css/app.min.css?v=3" rel="stylesheet" type="text/css" />
    <!-- OWL CAROUSEL 
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />-->
    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- ESTILO CSS -->
    <link href="<?php echo $CNG->wwwroot; ?>/assets/css/estilos.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $CNG->wwwroot; ?>/assets/js/funciones-headerV2.js"></script>
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom shadow-lg">
            <!-- LOGO -->
            <div class="logo-box">
                <a href="" class="logo text-center">
                    <span class="logo-lg">
                        <img src="<?php echo $CNG->wwwroot; ?>/assets/images/logo.png" alt="" height="60">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="<?php echo $CNG->wwwroot; ?>/assets/images/logo-sm.png" alt="" height="24">
                    </span>
                </a>
            </div>
        </div>
        <!-- end Topbar -->
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page" style="margin-left: 5px !important;">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">ENSAP</a></li>
                                        <li class="breadcrumb-item active">Inscripciones</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Inscripción para cursos de la Escuela Nacional de Salud Pública - ENSAP</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row d-none">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Formulario de Inscripción</h4>
                                <p class="sub-header">
                                    Por favor, rellene el formulario de Inscripción segun las indicaciones.
                                <ul class="sub-header">
                                    <li>Seleccione el curso de la lista al cual desea inscribirse, si es necesario use el cuadro de busqueda de la parte superior del campo.</li>
                                    <li>Ingrese su número de Número de Documento y su Fecha de Nacimiento (use el recuadro si es necesario) y luego haga click en "validar", sus datos personales (nombres y apellidos) se rellenarán automáticamente</li>
                                    <li>En caso usted sea personal de Salud que no pertenece al MINSA, seleccione su <b>Entidad</b> correspondiente y luego <b>ingrese el nombre del establecimiento en donde labora en el recuadro correspondiente</b></li>
                                    <li>Continúe con el resto de campos que se le solicita (datos de contacto), asegúsere se que estos sean los correctos, pues se usarán para comunicarle cualquier eventualidad respecto al curso.</li>
                                    <li>Haga click en "Registrarse", si todo es correcto, obtendrá un mensaje de confirmación, en caso contrario, vuelta a intentarlo en unos minutos.</li>
                                </ul>
                                <code class="highlighter-rouge"><b>La Escuela no se responsabiliza por el ingreso incorrecto de la información, quedando bajo su responsabilidad en caso de ocurrir alguna eventualidad respecto al curso. </b></code>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Formulario de Inscripción</h4>
                                <p class="sub-header text-primary font-weight-bold">
                                    Seleccione de la lista el curso al cual desea inscribirse.
                                </p>
                                <!--<a class="btn btn-primary probar">PROBAR</a>-->
                                <label for="curso">Seleccione un Curso</label>
                                <div class="input-group">
                                    <select class="select2 form-control" data-live-search="false" name="curso" id="curso" required>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id='spinload0' hidden><i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i></span>
                                    </div>
                                </div>

                                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show msg-aviso mt-2" role="alert" style="display:none;"></div>

                            </div> <!-- end card-body-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                    <!-- Form row -->
                    <div class="row collapse" id="crddescripcion">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="header-title">Información del Curso/Diplomado:</h4>
                                <p class="mt-2 mb-2 font-weight-bold" id="htmldesc">
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <form class="parsley-form" id="frmGuardar" action="index.php" method="POST">
                        <!-- Form row -->
                        <div class="row collapse" id="crdpersonal">
                            <div class="col-md-12">
                                <div class="card-box">

                                    <div class="div-cod-modular mb-3">
                                        <h4 class="header-title">Código modular</h4>
                                        <p class="sub-header text-primary font-weight-bold">
                                            Ingrese su código modular (Servicios educativos de Lima, Ica, Arequipa y Tumbes)
                                        </p>
                                        <div class="form-row">
                                            <div class="form-group position-relative col-md-4">
                                                <input type="text" class="form-control" data-parsley-minlength="7" maxlength="7" id="cod_modular" name="cod_modular" placeholder="Digite su código modular" required>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="header-title">Datos Personales</h4>
                                    <p class="sub-header text-primary font-weight-bold txt-datospers">
                                        Ingrese su Número de documento junto a su Fecha de Nacimiento, luego haga click en 'Validar', sus nombres y apellidos se rellenarán automáticamente
                                    </p>

                                    <!-- INICIO - DIV CHECKBOX EXTRANJERO -->
                                    <div class="form-row">
                                        <div class="form-group position-relative col-md-12" id="div-chkextranjero">
                                            <label for="editar">¿Es usted extranjero(a)?</label>

                                            <a class="btn btn-primary tippy-tooltip tooltip-style animate__animated animate__pulse animate__infinite infinite" data-plugin="tippy" data-tippy-placement="top" title="Active esta opción solo si usted es Extranjero y no cuenta con DNI del Perú ni con Carnet de Extranjería. <i>[Activate this option only if you are a foreigner and do not have a Peruvian national identity document or a Foreigner's Card]<i>"><i class="fas fa-question"></i></a>

                                            <div class="custom-control custom-switch form-control border-0">
                                                <input type="checkbox" class="custom-control-input" id="chkextranjero">
                                                <label class="custom-control-label" for="chkextranjero">Soy extranjero(a) y no cuento con DNI del Perú ni con Carnet de Extranjería</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN - DIV CHECKBOX EXTRANJERO -->

                                    <div class="form-row" id="div-dniperu"> <!-- DIV DNI PERU -->
                                        <div class="form-group position-relative col-md-4">
                                            <label id="label-dni" for="dni">Documento Nacional de Identidad</label>

                                            <a class="btn btn-success tippy-tooltip tooltip-style-v3 animate__animated animate__pulse animate__infinite infinite dni-tooltip" data-plugin="tippy" data-tippy-placement="top" title="Solo si no cuenta con ningún tipo de documento de identidad <b>(pasaporte, pase temporal, documento de otro país, etc.)</b> puede dejar este campo vacío, caso contrario, es <b>altamente recomendado</b> que ingrese este dato"><i class="fas fa-info"></i></a>

                                            <input type="text" class="form-control" data-parsley-minlength="8" maxlength="9" id="dni" name="dni" onkeypress="return numeros_enteros(event);" placeholder="DNI" required>
                                        </div>
                                        <div class="form-group position-relative col-md-4">
                                            <label for="fecha">Fecha de Nacimiento</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" data-toggle="input-mask" data-mask-format="00/00/0000" data-date-autoclose="true" maxlength="10" placeholder="dd/mm/aaaa" name="fecha" id="fecha" required>
                                                <div class="btn btn-success waves-effect waves-light" id="validar">
                                                    <span class="spinner-border spinner-border-sm mr-1" id="loading" hidden></span>
                                                    Validar
                                                </div>
                                            </div>
                                        </div>
                                         <!-- INICIO - SELECCION DE PAIS -->
                                        <div class="form-group position-relative col-md-4" id="div-pais">
                                            <label for="pais">País de procedencia</label>
                                            <div class="input-group">
                                                <select class="select2 form-control" data-live-search="false" name="pais" id="pais">
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id='spinload0' hidden><i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END - SELECCION DE PAIS -->
                                    </div>                                    
                                    <div class="form-row mostrar">
                                        <div class="form-group position-relative col-md-4">
                                            <label for="apepat">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="apepat" name="apepat" placeholder="Apellido Paterno" onkeypress="return solo_texto(event);" required readonly>
                                        </div>
                                        <div class="form-group position-relative col-md-4">
                                            <label for="apemat">Apellido Materno</label>
                                            <input type="text" class="form-control" id="apemat" name="apemat" placeholder="Apellido Materno" onkeypress="return solo_texto(event);" required readonly>
                                        </div>
                                        <div class="form-group position-relative col-md-4">
                                            <label for="nombres">Nombres</label>
                                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" onkeypress="return solo_texto(event);" required readonly>
                                        </div>
                                        <div class="form-group position-relative col-md-4 d-none">
                                            <label for="apecas">Apellido Casada</label>
                                            <input type="text" class="form-control" id="apecas" name="apecas" placeholder="Apellido Casada" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row mostrar">
                                        <div class="form-group position-relative col-md-4">
                                            <label for="correo">Email</label>
                                            <input type="email" parsley-type="email" class="form-control" id="correo" name="correo" placeholder="Email" required>
                                        </div>
                                        <div class="form-group position-relative col-md-4">
                                            <label for="correo">Confirmar Email</label>
                                            <input type="email" parsley-type="email" data-parsley-equalto="#correo" class="form-control" id="correo2" placeholder="Reingrese Email" required>
                                        </div>
                                        <div class="form-group position-relative col-md-4">
                                            <label for="celular">Número de Celular</label>
                                            <input type="phone" class="form-control" data-parsley-type="number" data-parsley-minlength="9" maxlength="9" onkeypress="return numeros_enteros(event);" id="celular" name="celular" placeholder="Celular" required>
                                        </div>
                                    </div>

                                    <!--<div class="mostrar-ext-il mt-2">
                                        <h4 class="header-title">Información Laboral</h4>
                                        <p class="sub-header text-primary font-weight-bold">
                                            Ingrese el nombre de la Institución donde labora y el nombre de la profesión que ejerce actualmente.
                                        </p>
                                        <div class="form-row">
                                            <div class="form-group position-relative col-md-4">
                                                <label for="ext_institucion">Institución</label>
                                                <input type="text" class="form-control" id="ext_institucion" name="ext_institucion" placeholder="Ingrese su Institución" onkeypress="return validar_institucion(event);"  maxlength="100">
                                            </div>

                                            <div class="form-group position-relative col-md-4">
                                                <label for="ext_profesion" class="control-label">Profesión</label>
                                                <input type="text" class="form-control" id="ext_profesion" name="ext_profesion" placeholder="Ingrese su Profesión" onkeypress="return solo_texto(event);"  maxlength="100">
                                            </div>
                                        </div>
                                    </div>-->


                                </div> <!-- end card-body-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <!-- Form row -->
                        <!-- <div class="row collapse" id="crdarchivo">
                                            <div class="col-md-12">
                                                <div class="card-box">
                                                    <h4 class="header-title">Carta de Presentación</h4>
                                                    <p class="sub-header text-primary font-weight-bold">
                                                        Adjunte la carta de presentación de la empresa/institución en la cual usted labora, misma que lo acredite como trabajador del área de Seguridad y Salud ocupacional (SSOMA).
                                                        Suba solo 1 archivo en formato PDF no mayor a 2mb, en el cual esten el/los documentos solicitados. </b>
                                                    </p>
                                                    <div class="form-row">
                                                        <div class="form-group position-relative col-md-4">
                                                            <div class="fileupload btn btn-success waves-effect waves-light mb-3">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Cargar certificado</span>
                                                                <input type="file" class="upload" name="upload" id="upload" accept="application/pdf">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-danger" id="txt-uploadx">Solo puedes subir achivos PDF</p>
                                                </div>
                                            </div>
                                        </div> -->
                        <!-- end row -->

                        <!-- Form row -->
                        <div class="row collapse" id="crdlaboral">
                            <div class="col-md-12">
                                <div class="card-box">

                                    <h4 class="header-title">Información Laboral</h4>
                                    <!-- INICIO - DIV CHECKBOX ENTIDAD PRIVADA -->
                                    <div class="form-row mostrar">
                                        <div class="form-group position-relative col-md-12 mt-2" id="div-chkprivado">
                                            <label for="editar">¿Usted pertenece a una Institución Privada u otra Institución Pública?</label>

                                            <a class="btn btn-primary tippy-tooltip tooltip-style animate__animated animate__pulse animate__infinite infinite" data-plugin="tippy" data-tippy-placement="top" title="Active esta opción solo si usted no trabaja para el Ministerio de Salud y en su lugar trabaja para una empresa del sector privado u otra entidad del estado. <i>[Enable this option only if you do not work for the Ministry of Health and instead work for a private sector company or other state entity]<i>"><i class="fas fa-question"></i></a>

                                            <div class="custom-control custom-switch form-control border-0">
                                                <input type="checkbox" class="custom-control-input" id="chkprivado">
                                                <label class="custom-control-label" for="chkprivado">Pertenezco a una Institución Privada u otra Entidad del Estado, por lo cual deseo registrar mis datos laborales manualmente</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN - DIV CHECKBOX ENTIDAD PRIVADA -->

                                    <!-- INICIO - DIV - DATOS LABORALES EXTRANJERO / PRIVADO -->
                                    <div class="mostrar-ext-il">
                                        <p class="sub-header text-primary font-weight-bold text-div-laboral">
                                            Ingrese el nombre de la Institución donde labora y el nombre de la profesión que ejerce actualmente.
                                        </p>
                                        <div class="form-row">
                                            <div class="form-group position-relative col-md-4 div-nroruc-ext">
                                                <label for="ext_nroruc">Nro. RUC de Centro Laboral</label>

                                                <a class="btn btn-success tippy-tooltip tooltip-style-v3 animate__animated animate__pulse animate__infinite infinite" data-plugin="tippy" data-tippy-placement="top" title="Solo si desconoce el RUC de la Institución donde labora, puede dejar vacío este campo, caso contrario, es <b>altamente recomendado</b> que ingrese este dato"><i class="fas fa-info"></i></a>

                                                <input type="text" class="form-control" id="ext_nroruc" name="ext_nroruc" placeholder="Ingrese el número de RUC de la Institución donde labora" onkeypress="return numeros_enteros(event);" data-parsley-minlength="11" maxlength="11">
                                            </div>
                                            <div class="form-group position-relative col-md-4">
                                                <label for="ext_institucion">Institución (Centro Laboral)</label>
                                                <input type="text" class="form-control" id="ext_institucion" name="ext_institucion" placeholder="Ingrese su Institución" onkeypress="return validar_institucion(event);" maxlength="100">
                                            </div>
                                            <div class="form-group position-relative col-md-4">
                                                <label for="ext_profesion" class="control-label">Profesión</label>
                                                <input type="text" class="form-control" id="ext_profesion" name="ext_profesion" placeholder="Ingrese su Profesión" onkeypress="return solo_texto(event);" maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN - DIV - DATOS LABORALES EXTRANJERO / PRIVADO -->

                                    <div class="div-laboral-minsa">
                                        <p class="sub-header text-primary font-weight-bold">
                                            <!--En caso usted sea personal de Salud que no pertenece al MINSA, seleccione su <b>Entidad</b> correspondiente y luego <b>seleccione el establecimiento en donde labora</b>-->
                                            Si usted es personal MINSA registrado correctamente en INFORHUS los datos a continuación se rellenarán automáticamente, caso contrario usted deberá completar su información laboral con las opciones disponibles. Si sus datos se rellenaron automáticamente, verifique que sus datos esten consignados correctamente (en este caso, el sistema no le permitirá editar ningún dato de información laboral), ya que en caso no sea así, deberá actualizar su información de INFORHUS (comunicándose a la central del MINSA).
                                        </p>

                                        <div class="form-row">
                                            <div class="form-group position-relative col-md-4">
                                                <label for="entidad">Entidad</label>
                                                <select class="select2 form-control" name="entidad" id="entidad" required disabled>
                                                    <option value="">Seleccione...</option>
                                                    <option id="opcion" value="1">MINSA</option>
                                                    <option value="8">MINSA - TERCERO</option>
                                                    <option value="2">FAP</option>
                                                    <option value="3">EJERCITO</option>
                                                    <option value="4">ESSALUD</option>
                                                    <option value="5">OTRO</option>
                                                    <option value="6">MINEDU</option>
                                                    <option value="7">INPE</option>
                                                    <option value="9">PNP</option>
                                                    <option value="10">SISOL</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="profesion" class="control-label">Profesión</label>
                                                    <div class="input-group required">
                                                        <!--<select class="select2 form-control" name="profesion" id="profesion" required disabled>--> <!-- ASI ESTABA ANTES -->
                                                        <select class="select2 form-control" name="profesion" id="profesion" disabled>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id='spinload1' hidden>
                                                                <i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="regimen" class="control-label">Régimen Laboral</label>
                                                    <select class="select2 form-control" name="regimen" id="regimen" required disabled>
                                                        <option value="">Seleccione...</option>
                                                        <option value="1">Regimen 276</option>
                                                        <option value="2">Regimen 728</option>
                                                        <option value="3">Regimen 1057</option>
                                                        <option value="4">Locación de Servicios</option>
                                                        <option value="6">Interno de Carreras de la Salud</option>
                                                        <option value="10">Planilla (Entidad Privada)</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4" hidden>
                                                <div class="form-group">
                                                    <label for="condicion" class="control-label">Condición Laboral</label>
                                                    <div class="input-group required">
                                                        <select class="select2 form-control" name="condicion" id="condicion" required disabled>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id='spinload6' hidden>
                                                                <i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group position-relative col-md-4" id=chkactualizar hidden>
                                                <label for="editar">Actualización</label>
                                                <div class="custom-control custom-switch form-control border-0">
                                                    <input type="checkbox" class="custom-control-input" id="editsw">
                                                    <label class="custom-control-label" for="editsw">Actualizar mi Información Laboral</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row div-ubigeo">
                                        <div class="form-group position-relative col-md-4">
                                            <label for="departamento">Departamento</label>
                                            <div class="input-group">
                                                <select class="select2 form-control" name="departamento" id="departamento" required disabled>
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id='spinload2' hidden>
                                                        <i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group position-relative col-md-4">
                                            <label for="provincia">Provincia</label>
                                            <div class="input-group">
                                                <select class="select2 form-control" name="provincia" id="provincia" required disabled>
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id='spinload3' hidden><i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group position-relative col-md-4">
                                            <label for="distrito">Distrito</label>
                                            <div class="input-group">
                                                <select class="select2 form-control" name="distrito" id="distrito" required disabled>
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id='spinload4' hidden><i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="div-laboral-minsa">
                                        <div class="form-row">
                                            <div class="form-group position-relative col-md-4" id="cpliego">
                                                <label for="apepat">Pliego</label>
                                                <input type="text" class="form-control" id="pliego" name="pliego" placeholder="Pliego" required readonly>
                                            </div>
                                            <div class="form-group position-relative col-md-4" id="cuejecutora">
                                                <label for="apemat">Unidad Ejecutora</label>
                                                <input type="text" class="form-control" id="uejecutora" name="uejecutora" placeholder="Unidad Ejecutora" required readonly>
                                            </div>
                                            <div class="form-group position-relative col-md-4" id="cestablecimiento">
                                                <label for="nombres">Establecimiento</label>
                                                <div class="input-group">
                                                    <select class="select2 form-control" name="establecimiento" id="establecimiento" required disabled>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id='spinload5' hidden><i class="spinner-border text-primary" style="height:1.3rem; width:1.3rem;" role="status"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group position-relative col-md-4" id="cruc">
                                                <label for="ruc">Número de RUC</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" data-parsley-minlength="11" maxlength="11" id="ruc" name="ruc" placeholder="Nro de RUC">
                                                    <div class="btn btn-success waves-effect waves-light" id="rucvalida">
                                                        <span class="spinner-border spinner-border-sm mr-1" id="loadingruc" hidden></span>
                                                        Validar
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                            <div class="form-group position-relative col-md-4" id="crsocial">
                                                <label for="rsocial">Razón Social</label>
                                                <input type="text" class="form-control" id="rsocial" name="rsocial" placeholder="Razón Social" required readonly>
                                            </div>
                                            <div class="form-group position-relative col-md-4" id="ctipo">
                                                <label for="tipo">Tipo de Empresa</label>
                                                <select class="select2 form-control" name="tipo" id="tipo" required disabled>
                                                    <option value="1">Tipo 1 (5 a 20 Trabajadores no incluidos en el DS 003-98 SA)</option>
                                                    <option value="2">Tipo 2 (Hasta 20 Trabajadores incluidos en el DS 003-98 SA)</option>
                                                    <option value="3">Tipo 3 (21 a 50 Trabajadores)</option>
                                                    <option value="4">Tipo 4 (51 a 100 Trabajadores)</option>
                                                    <option value="5">Tipo 5 (101 a 500 Trabajadores)</option>
                                                    <option value="6">Tipo 6 (mas de 500 Trabajadores)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-2" id="div-guardar">
                                        <div class="form-group position-relative col-md-6">
                                            <input class="btn btn-primary waves-effect waves-light" type="submit" id="guardar" form="frmGuardar" value="Registrarse">
                                            <a class="btn btn-danger tippy-tooltip tooltip-style-v2 animate__animated animate__pulse animate__infinite infinite btn-info-laboral" data-plugin="tippy" data-tippy-placement="top" title="<p align='justify'>Para poder activar nuevamente el <font class='text-primary'>Botón <b>'Registrarse'</b></font>, de clic nuevamente sobre el <font class='text-success'>Botón de color verde <b>'Validar'</b></font> de la parte superior (mayormente para personal MINSA), caso contrario pruebe cualquiera de estas 2 opciones <b>(Si el sistema lo permite)</b>:
                                            <br><b>a.</b> Complete todos los datos laborales faltantes y de clic en el <font class='text-primary'>Botón <b>'Registrarse'</b></font>.
                                            <br><b>b.</b> Complete los datos laborales solicitados y luego seleccione el Departamento, Provincia y Distrito de su Lugar de Trabajo, realizando ello, el <font class='text-primary'>Botón <b>'Registrarse'</b></font> se activará.</p>"><i class="fas fa-exclamation"></i></a>
                                            <!-- <span class="spinner-border spinner-border-sm mr-1" id="saving" hidden></span> -->
                                        </div>
                                    </div>

                                </div><!-- end card-body-->
                            </div>
                        </div> <!-- end Row-->

                        <!-- Form row -->
                        <div class="row collapse" id="crdarchivo">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Archivos Requeridos</h4>
                                    <div id="progressbarwizard">
                                        <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                            <li class="nav-item">
                                                <a href="#file-01" data-bs-toggle="tab" data-toggle="tab" class="nav-link active">
                                                    <span class="number">1</span>
                                                    <span class="d-none d-sm-inline">Carta de Compromiso del Director</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#file-02" data-bs-toggle="tab" data-toggle="tab" class="nav-link">
                                                    <span class="number">2</span>
                                                    <span class="d-none d-sm-inline">Carta de Compromiso del Participate</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#file-03" data-bs-toggle="tab" data-toggle="tab" class="nav-link">
                                                    <span class="number">3</span>
                                                    <span class="d-none d-sm-inline">Copia de Título Profesional</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#file-04" data-bs-toggle="tab" data-toggle="tab" class="nav-link">
                                                    <span class="number">4</span>
                                                    <span class="d-none d-sm-inline">Copia de Documento de Identidad</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#file-05" data-bs-toggle="tab" data-toggle="tab" class="nav-link">
                                                    <span class="number">5</span>
                                                    <span class="d-none d-sm-inline">Experiencia</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#file-06" data-bs-toggle="tab" data-toggle="tab" class="nav-link">
                                                    <span class="number">6</span>
                                                    <span class="d-none d-sm-inline">Asignación de Cargo</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link">
                                                    <span class="number">7</span>
                                                    <span class="d-none d-sm-inline">Finalizar</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content b-0 pt-0 mb-0">

                                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 20%;"></div>
                                            </div>

                                            <div class="tab-pane active" id="file-01">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="sub-header text-secondary font-weight-bold">
                                                            Adjunte la carta de compromiso firmada por el director o jefe inmediato de su institución en la cual usted labora, para ello descargue el formato adjunto haciendo click en el boton rojo que se encuentra debajo de esta linea, y luego de ser firmado, escanéelo.
                                                            Suba solo 1 archivo en formato PDF no mayor a 2mb, en el cual esten el/los documentos solicitados.</b>
                                                        </p>
                                                        <div class="row mb-3 mx-auto">
                                                            <div class="col-md-3 fileupload btn btn-primary">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Seleccionar Archivo</span>
                                                                <input type="file" class="upload" name="file-01" id="file-01" accept="application/pdf">
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input type="text" id="txt-upload" name="txt-upload" class="form-control" placeholder="<-- Seleccione su archivo..." disabled>
                                                            </div>
                                                            <button type="button" onclick="location.href='<?php echo $CNG->wwwroot; ?>/assets/files/1/Carta compromiso institucional_TELE_2022.docx'" class="col-md-2 btn btn-danger rounded-pill waves-effect waves-light">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Descargar Formato</span>
                                                            </button>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <ul class="pager wizard mb-0 list-inline text-end mt-2">
                                                    <li class="next list-inline-item">
                                                        <button type="button" class="btn btn-info" id="btnext-01">Siguiente<i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </li>
                                                </ul>
                                            </div><!-- end tab pane -->

                                            <div class="tab-pane" id="file-02">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="sub-header text-secondary font-weight-bold">
                                                            Adjunte la carta de compromiso firmada por usted, para ello descargue el formato adjunto haciendo click en el boton rojo que se encuentra debajo de esta linea, y luego de ser firmado, escanéelo.
                                                            Suba solo 1 archivo en formato PDF no mayor a 2mb, en el cual esten el/los documentos solicitados.</b>
                                                        </p>
                                                        <div class="row mb-3 mx-auto">
                                                            <div class="col-md-3 fileupload btn btn-primary">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Seleccionar Archivo</span>
                                                                <input type="file" class="upload" name="file-02" id="file-02" accept="application/pdf">
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input type="text" id="txt-upload" name="txt-upload" class="form-control" placeholder="<-- Seleccione su archivo..." disabled>
                                                            </div>
                                                            <button type="button" onclick="location.href='<?php echo $CNG->wwwroot; ?>/assets/files/1/Carta compromiso personal_TELE_2022.docx'" class="col-md-2 btn btn-danger rounded-pill waves-effect waves-light">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Descargar Formato</span>
                                                            </button>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <ul class="pager wizard mb-0 list-inline mt-2">
                                                    <li class="previous list-inline-item">
                                                        <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left me-1"></i>Anterior</button>
                                                    </li>
                                                    <li class="next list-inline-item float-right">
                                                        <button type="button" class="btn btn-info" id="btnext-02">Siguiente<i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </li>
                                                </ul>
                                            </div><!-- end tab pane -->

                                            <div class="tab-pane" id="file-03">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="sub-header text-secondary font-weight-bold">
                                                            Adjunte una copia simple de su Título Profesional, para ello escanée el mismo en formato PDF.
                                                            Suba solo 1 archivo en formato PDF no mayor a 2mb, en el cual esten el/los documentos solicitados.</b>
                                                        </p>
                                                        <div class="row mb-3 mx-auto">
                                                            <div class="col-md-3 fileupload btn btn-primary">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Seleccionar Archivo</span>
                                                                <input type="file" class="upload" name="file-03" id="file-03" accept="application/pdf">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" id="txt-upload" name="txt-upload" class="form-control" placeholder="<-- Seleccione su archivo..." disabled>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <ul class="pager wizard mb-0 list-inline mt-2">
                                                    <li class="previous list-inline-item">
                                                        <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left me-1"></i>Anterior</button>
                                                    </li>
                                                    <li class="next list-inline-item float-right">
                                                        <button type="button" class="btn btn-info" id="btnext-03">Siguiente<i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </li>
                                                </ul>
                                            </div> <!-- end tab pane -->

                                            <div class="tab-pane" id="file-04">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="sub-header text-secondary font-weight-bold">
                                                            Adjunte una copia simple de su Documento de Identidad, para ello escanée el mismo en formato PDF.
                                                            Suba solo 1 archivo en formato PDF no mayor a 2mb, en el cual esten el/los documentos solicitados.</b>
                                                        </p>
                                                        <div class="row mb-3 mx-auto">
                                                            <div class="col-md-3 fileupload btn btn-primary">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Seleccionar Archivo</span>
                                                                <input type="file" class="upload" name="file-04" id="file-04" accept="application/pdf">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" id="txt-upload" name="txt-upload" class="form-control" placeholder="<-- Seleccione su archivo..." disabled>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <ul class="pager wizard mb-0 list-inline mt-2">
                                                    <li class="previous list-inline-item">
                                                        <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left me-1"></i>Anterior</button>
                                                    </li>
                                                    <li class="next list-inline-item float-right">
                                                        <button type="button" class="btn btn-info" id="btnext-04">Siguiente<i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </li>
                                                </ul>
                                            </div> <!-- end tab pane -->

                                            <div class="tab-pane" id="file-05">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="sub-header text-secondary font-weight-bold">
                                                            Adjunte un archivo en el cuál liste su experiencia profesional, el archivo debe ser generado y/o escaneado en formato PDF.</b>
                                                        </p>
                                                        <div class="row mb-3 mx-auto">
                                                            <div class="col-md-3 fileupload btn btn-primary">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Seleccionar Archivo</span>
                                                                <input type="file" class="upload" name="file-05" id="file-05" accept="application/pdf">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" id="txt-upload" name="txt-upload" class="form-control" placeholder="<-- Seleccione su archivo..." disabled>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <ul class="pager wizard mb-0 list-inline mt-2">
                                                    <li class="previous list-inline-item">
                                                        <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left me-1"></i>Anterior</button>
                                                    </li>
                                                    <li class="next list-inline-item float-right">
                                                        <button type="button" class="btn btn-info" id="btnext-05">Siguiente<i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </li>
                                                </ul>
                                            </div> <!-- end tab pane -->

                                            <div class="tab-pane" id="file-06">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="sub-header text-secondary font-weight-bold">
                                                            Adjunte un archivo en el cuál consigne su Asignacion de Cargo. El archivo debe ser generado y/o escaneado en formato PDF.</b>
                                                        </p>
                                                        <div class="row mb-3 mx-auto">
                                                            <div class="col-md-3 fileupload btn btn-primary">
                                                                <span><i class="mdi mdi-cloud-upload mr-1"></i> Seleccionar Archivo</span>
                                                                <input type="file" class="upload" name="file-06" id="file-06" accept="application/pdf">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" id="txt-upload" name="txt-upload" class="form-control" placeholder="<-- Seleccione su archivo..." disabled>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <ul class="pager wizard mb-0 list-inline mt-2">
                                                    <li class="previous list-inline-item">
                                                        <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left me-1"></i>Anterior</button>
                                                    </li>
                                                    <li class="next list-inline-item float-right">
                                                        <button type="button" class="btn btn-info" id="btnext-06">Siguiente<i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </li>
                                                </ul>
                                            </div> <!-- end tab pane -->

                                            <div class="tab-pane" id="finish-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="text-center">
                                                            <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                            <h3 class="mt-0">Ya casi terminamos!</h3>

                                                            <p class="w-75 mb-2 mx-auto">Ahora, por favor ahora lea nuestros Terminos y Condiciones para el trato de su información, y de estar de acuerdo, haga click en el recuadro para que se habilite el check.</p>

                                                            <div class="mb-3">
                                                                <div class="form-check d-inline-block">
                                                                    <input class="form-check-input" type="checkbox" value="" id="chkterminos">
                                                                    <label class="form-check-label" for="terms-conditions-progresswizard">
                                                                        Acepto los <a id="terminos" href="javascript:void(0)">Términos y Condiciones</a> del trato de información
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <ul class="pager wizard mb-0 list-inline mt-2">
                                                    <li class="previous list-inline-item">
                                                        <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left me-1"></i>Anterior</button>
                                                    </li>
                                                    <li class="next list-inline-item float-right">
                                                        <input class="btn btn-success" type="submit" id="guardarx" form="frmGuardar" value="Registrarse" />
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> <!-- tab-content -->
                                    </div> <!-- end #progressbarwizard-->
                                </div> <!-- end card-->
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </form>

                    <!--- /****** CURSOS LIBRES EN PLATAFORMA *****/ --><!--
                    <div class="pmd-tabs">
                            <ul id="tabs-cursos" class="nav nav-tabs nav-fill nav-bordered nav-justified" role="tablist">
                                <li class="nav-item" data-plugin="tippy" data-tippy-placement="top" title="Formulario de inscripción a cursos de la plataforma virtual">
                                    <a class="nav-link active" href="#cursos-inscripcion" aria-controls="home" role="tab" data-toggle="tab">
                                        <i class="mdi mdi-book-edit icon-1-2x"></i>
                                        &nbsp;INSCRIPCIÓN A CURSOS Y/O DIPLOMADOS
                                    </a>
                                </li>
                                <li class="nav-item" data-plugin="tippy" data-tippy-placement="top" title="Listado de cursos de la plataforma virtual que no requieren inscripción">
                                    <a class="nav-link" href="#cursos-libres" aria-controls="about" role="tab" data-toggle="tab">
                                        <i class="mdi mdi-book-settings icon-1-2x"></i>
                                        &nbsp;LISTADO DE CURSOS LIBRES
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body" style="background-color: transparent !important;">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="cursos-inscripcion">
                                </div>
                                <div role="tabpanel" class="tab-pane" id="cursos-libres">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="card-cursos-l" class="h-300">
                                                <div id="overlay">
                                                    <div class="spinner"></div>
                                                    <h4 class="mt-3">Cargando listado de cursos</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-12">
                                                        <h4 class="header-title">Cursos de libre acceso</h4>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <button type="button" class="btn btn-primary btn-block rounded-pill waves-effect waves-light float-right" data-toggle="modal" data-target="#modal_instrucciones">
                                                            <span class="btn-label"><i class="mdi mdi-information-outline"></i></span><b>INTRUCCIONES DE ACCESO</b>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="sub-header text-primary font-weight-bold mb-3 mt-2">
                                                    Para acceder al contenido de alguno de los cursos listados a continuación, de clic sobre el botón "Ir al curso" que se encuentra dentro de la cartilla del curso en cuestión.
                                                    Adicional a ello tome en cuenta las indicaciones que se muestran al pasar el cursor sobre el botón redondo con un signo de interrogración "?", el cual se encuentra en cada una de las cartillas de los cursos.
                                                </p>
                                                <div id="owl-cursos-libres" class="owl-carousel"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        --><!--- /****** END - CURSOS LIBRES EN PLATAFORMA *****/ -->

                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->

        <div class="modal fade" id="modal_instrucciones" tabindex="-1" role="dialog" aria-labelledby="modal_instrucciones_Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_instrucciones_Title">INSTRUCCIONES DE ACCESO A CURSOS LIBRES</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p align="justify">
                            Para acceder a los cursos libres de la plataforma virtual educativa de la ENSAP, siga los siguientes pasos a continuación
                        </p>
                        <p class="mb-2">
                            PRIMER PASO: De clic sobre el botón "Ir al curso".
                        </p>
                        <center>
                            <img src="<?php echo $CNG->wwwroot; ?>/assets/images/acceso.jpg" class="img-fluid img-modal-i" alt="Botón de acceso al curso" data-plugin="tippy" data-tippy-placement="top" title="Este botón se encuentra en cada uno de los cursos libres del listado horizontal">
                        </center>
                        <p class="mt-2 mb-2">
                            SEGUNDO PASO: Luego le cargará la página de la plataforma virtual educativa, aquí tendrá que dar clic en el botón "Iniciar sesión como invitado"
                        </p>
                        <center>
                            <img src="<?php echo $CNG->wwwroot; ?>/assets/images/invitado.jpg" class="img-fluid img-modal-i" alt="Botón invitado" data-plugin="tippy" data-tippy-placement="top" title="Solo podrá acceder al contenido del curso si da clic en el botón indicado">
                        </center>
                        <p class="mt-2">
                            TERCER PASO: Si usted siguió correctamente todos los pasos, habrá accedido al contenido del curso libre de su elección.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-check"></i>&nbsp;COMPRENDIDO</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="miModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editor-title">Escuela Nacional de Salud Pública</h4>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                    </div>
                    <div class="modal-body p-4" id="mbody">
                        <p id="mensaje" class="text-justify">
                            <b>Alcance y finalidad</b></br>
                            A través del acceso general a PEES.MINSA.GOB.PE no se recopilan datos personales sin
                            consentimiento. Sin embargo, a traves de formularios, servicios, consultas y encuestas
                            al interior de este portal se podrán requerir datos personales necesarios para el ejercicio
                            de nuestras funciones en el ámbito de nuestras competencias. Sin perjuicio de lo
                            anterior, en los casos en que recopile información para otras finalidades, se requerirá el
                            consentimiento del titular de datos personales para los efectos de su tratamiento, no
                            pudiendo utilizarse para finalidades no informadas.
                            </br></br>
                            <b>Transferencia</b></br>
                            Los datos personales recabados podrán ser transferidos o suministrados a las entidades
                            públicas para el ejercicio de sus funciones en el marco de sus competencias y cuando
                            resulte necesario para el cumplimiento de los servicios, trámites, reclamos, denuncias u
                            otros, iniciados o solicitados por el usuario.
                            Los datos serán almacenados en los servidores de Microsoft Azure, realizándose
                            un flujo transfronterizo a los Estados Unidos de América de dichos datos personales.
                            Asimismo, la Entidad garantiza que el tratamiento de sus datos se limite a las finalidades
                            antes autorizadas, que se mantengan de forma confidencial, así como que se
                            implementen las medidas de seguridad que exige la Ley de Protección de Datos
                            personales, su Reglamento y los Lineamientos para Uso de Servicios en la Nube para
                            Entidades de la Administración Pública del Estado Peruano emitidos por la Secretaría
                            de Gobierno Digital.
                            </br></br>
                            <b>Seguridad de los Datos Personales</b></br>
                            En cumplimiento de la normativa vigente, se han adoptado medidas legales,
                            organizativas y técnicas apropiadas para garantizar la seguridad de los datos
                            personales, evitando su alteración, pérdida, tratamiento indebido o acceso no
                            autorizado. En ese sentido, sólo se realizará el tratamiento de los datos personales que
                            estén almacenados en repositorios que reúnan las condiciones de seguridad exigidas
                            por la normativa de seguridad de la información, protección de datos personales y uso
                            de servicios en la nube en la Administración Pública del Estado Peruano.
                            </br></br>
                            <b>Vigencia y Modificación de la Política de Privacidad</b></br>
                            La Presidencia del Consejo de Ministros se reserva el derecho a modificar su Política
                            de Privacidad en el supuesto de que exista un cambio en la legislación vigente, doctrinal,
                            jurisprudencial. La Presidencia del Consejo de Ministros podrá realizar modificaciones y
                            correcciones a esta Política de Privacidad.
                            Si se introdujera algún cambio en esta política, el nuevo texto se publicará en la
                            plataforma. Por favor sírvase verificar regularmente este documento para consultar los
                            cambios que puedan haber existido y de qué manera le pueden afectar.
                            </br></br>
                            <b>Enlaces</b></br>
                            La presente política de privacidad no se garantiza en los accesos a través de enlaces
                            con este sitio, ni a los enlaces desde este sitio con otros portales
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No Acepto</button>
                        <button type="button" class="btn btn-success waves-effect waves-light" id="btnaceptar">Acepto los Términos</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <!-- Footer Start -->
        <footer class="footer" style="left:0px !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2017 - <?= Date("Y") ?> &copy; <a href="https://www.minsa.gob.pe/ensap/" target="_blank">Escuela Nacional de Salud Pública - ENSAP</a>
                    </div>
                    <div class="col-md-6 d-none">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">Ayuda</a>
                            <a href="javascript:void(0);">Contacto Soporte</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
    <!-- Vendor js -->
    <script src="<?php echo $CNG->wwwroot; ?>/assets/js/vendor.min.js"></script>
    <!-- Validation js (Parsleyjs) -->
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/parsleyjs/parsley.min.js"></script>
    <!-- App js -->
    <script src="<?php echo $CNG->wwwroot; ?>/assets/js/app.min.js"></script>
    <!-- Plugins Js -->
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/select2/select2.min.js?v=2"></script>
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/sweetalert/sweetalert2.min.js"></script>
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <!-- Init js-->
    <script src="<?php echo $CNG->wwwroot; ?>/assets/js/pages/form-pickers.init.js"></script>
    <script src="<?php echo $CNG->wwwroot; ?>/assets/js/pages/form.init.V26.js"></script>
    <!-- POPPER -->
    <script scr="https://unpkg.com/@popperjs/core@2"></script>
    <!-- OWL CAROUSEL 
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/owl-carousel/owl.carousel.min.js"></script>-->
    <!-- TIPPY JS -->
    <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/tippy/tippy.all.min.js"></script>
    <!-- FUNCIONES JS 
    <script src="<?php echo $CNG->wwwroot; ?>/assets/js/pages/functions.js"></script>-->
</body>

</html>