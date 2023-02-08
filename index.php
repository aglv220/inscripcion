<?php
require_once(__DIR__ . '/config/config.php');

if ($CNG->maintenance) {
    require_once($CNG->dirroot . '/include/view/maintenance.php');
} else {
    if (isset($_POST['controller'])) {
        switch ($_POST['controller']) {
            case 'validar':
                require_once($CNG->dirroot . '/include/util/validaciones.php');

                $v = new validaciones();
                $tipo = strlen($_POST['documento']) == 8 ? "1" : "2";
                $response = $v->validar_documento($tipo, $_POST['documento'], $_POST['fecnac']);

                header('Content-type: application/json; charset=utf-8');
                echo $response;
                break;

            case 'rucvalida':
                require_once($CNG->dirroot . '/include/util/validaciones.php');

                $v = new validaciones();
                $response = $v->validar_ruc($_POST['ruc']);

                header('Content-type: application/json; charset=utf-8');
                echo $response;
                break;

            case 'guardar':
                require_once($CNG->dirroot . '/include/controller/alumno.php');

                $extranjero = $_POST["extranjero"];
                
                $curso = $_POST["curso"];
                // CODIGO MODULAR
                $cod_modular = $_POST["cod_modular"];
                $apepat = $_POST["apepat"];
                $apemat = $_POST["apemat"];
                $apecas = $_POST["apecas"];
                $nombres = $_POST["nombres"];
                $correo = $_POST["correo"];
                $celular = $_POST["celular"];
                $fecha = date("Y-m-d H:i:s");
                $pais = 89;

                if ($extranjero) {
                    //PAIS SI ES EXTRANJERO
                    $pais = $_POST["pais"];
                    $nrodocrandom = random_int(100000000,999999999);
                    $dni = $nrodocrandom;
                    $fecnac = "1969/01/01";
                    $entidad = "1";
                    $region = "01"; //CAMBIAR A LIMA
                    $ubigeo = "150101";
                    $profesion = "01010301"; //CAMBIAR A NO ESPECIFICADO
                    $regimenlab = "10";
                    $pliego = "M. DE SALUD";
                    $ipliego = "011";
                    $uejecutora = "ADMINISTRACION CENTRAL - MINSA";
                    $iuejecutora = "0117";
                    $establecimiento = "ADMINISTRACION CENTRAL";
                    $iestablecimiento = "01000000";
                    $condicionlab = "Designado no de carrera";
                    $icondicionlab = "CL44";
                    $ruc = "0123456780";
                    $tipo = "";
                } else {
                    $dni = $_POST["dni"];
                    $fecnac = DateTime::createFromFormat('d/m/Y', $_POST["fecnac"])->format('Y-m-d');
                    $entidad = $_POST["entidad"];
                    $region = substr($_POST["ubigeo"], 0, 2);
                    $ubigeo = $_POST["ubigeo"];
                    $profesion = $_POST["id_pro"];
                    $regimenlab = $_POST["id_reglab"];

                    if ($entidad == "1") {
                        $pliego = $_POST["pliego"];
                        $ipliego = $_POST["ipliego"];
                        $uejecutora = $_POST["uejecutora"];
                        $iuejecutora = $_POST["iuejecutora"];
                        $establecimiento = $_POST["establecimiento"];
                        $iestablecimiento = $_POST["iestablecimiento"];
                        $condicionlab = $_POST["condlab"];
                        $icondicionlab = $_POST["icondlab"];
                        $ruc = "";
                        $tipo = "";
                    } else {
                        $pliego = "";
                        $ipliego = "";
                        $uejecutora = "";
                        $iuejecutora = "";
                        $condicionlab = "";
                        $icondicionlab = "";

                        if ($_POST['privado'] == "1") {
                            $establecimiento = $_POST["rsocial"] == "" ? $_POST["establecimiento"] : $_POST["rsocial"];
                            $iestablecimiento = $_POST["iestablecimiento"];
                            $ruc = isset($_POST["ruc"]) ? $_POST["ruc"] : "";
                            $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "";
                        } else {
                            $establecimiento = $_POST["establecimiento"];
                            $iestablecimiento = $_POST["iestablecimiento"];
                            $ruc = "";
                            $tipo = "";
                        }
                    }
                }

                $a = new alumno();

                if ($curso == 0) {
                    $result = array(
                        "status" => 0
                    );
                } else {

                    $file_uploaded = '';
                    if ($_POST['archivo'] == "1") {
                        $stfile = true;
                        foreach ($_FILES as $file) {
                            if ($file["error"] == 4 || empty($file["name"])) {
                                $stfile = false;
                            }
                        }
                        if ($stfile) {
                            $ctfl = 0;
                            foreach ($_FILES as $f => $file) {
                                $ctfl += 1;
                                $FILE = new SplFileInfo($file["name"]);
                                $EXTENSION_FILE = $FILE->getExtension();
                                $VALID_EXTENSIONS = array("pdf");
                                if (in_array($EXTENSION_FILE, $VALID_EXTENSIONS)) {
                                    $SOURCE = $file['tmp_name'];
                                    $URL_FOLDER = "/upload/" . $_POST["curso"] . "/" . $_POST["dni"] . "/";
                                    $FOLDER_IU = $CNG->dirroot . $URL_FOLDER;
                                    if (!file_exists($FOLDER_IU)) {
                                        mkdir($FOLDER_IU, 0777, true);
                                    }
                                    $NOM_ARCHIVO = $dni . "_" . $_POST["curso"] . "_" . $f . "_" . date("Ymd") . ".pdf";
                                    $ruta_guardado = $FOLDER_IU . $NOM_ARCHIVO;
                                    if (move_uploaded_file($SOURCE, $ruta_guardado)) {
                                        $sp = $ctfl == 1 ? "" : "|";
                                        $file_uploaded = $file_uploaded  . $sp . $NOM_ARCHIVO;
                                    } else {
                                        $ERROR_UPLOAD = "Error al guardar archivo subido";
                                    }
                                } else {
                                    $ERROR_UPLOAD = "Archivo con Extención no admitida";
                                }
                            }
                        } else {
                            $ERROR_UPLOAD = "Error al subir los archivos";
                        }
                    }
                    if (isset($ERROR_UPLOAD)) {
                        $result = array(
                            "status" => 0,
                            "mensaje" => $ERROR_UPLOAD
                        );
                    } else {
                        //MODIFICADO CON CÓDIGO MODULAR
                        $result = $a->saveAlumnoByCurso(
                            $dni,
                            $fecnac,
                            $entidad,
                            $pliego,
                            $ipliego,
                            $uejecutora,
                            $iuejecutora,
                            $establecimiento,
                            $iestablecimiento,
                            $region,
                            $nombres,
                            $apepat,
                            $apemat,
                            $apecas,
                            $correo,
                            $celular,
                            $fecha,
                            $curso,
                            $ubigeo,
                            $profesion,
                            $regimenlab,
                            $condicionlab,
                            $icondicionlab,
                            $ruc,
                            $tipo,
                            $file_uploaded,
                            $cod_modular,
                            $pais
                        );
                    }
                }

                header('Content-type: application/json; charset=utf-8');
                echo json_encode($result, JSON_FORCE_OBJECT);
                break;
            default:
                echo "Illegal Access";
                break;
        }
    } else {
        if (isset($_REQUEST["reporte_ensapbi"])) {
            include $CNG->dirroot . '/include/view/reporte.php';
        } else {
            require_once($CNG->dirroot . '/include/controller/curso.php');
            include $CNG->dirroot . '/include/view/inscripcion.php';
        }
    }
}
