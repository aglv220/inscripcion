<?php
    require_once(__DIR__.'/../../config/config.php');
    //require_once($CNG->dirroot .'/include/controller/ubigeo.php');

    switch ($_POST['function']) 
    {
        case 'getUbigeoDet':
            require_once($CNG->dirroot .'/include/controller/ubigeo.php');
            $p = new ubigeo();
            $data = $p->getUbigeoDet($_POST['ubigeo']);

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getdepartamento':
            require_once($CNG->dirroot .'/include/controller/ubigeo.php');
            $p = new ubigeo();
            $data = $p->getDepartamento();

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getprovincia':
            require_once($CNG->dirroot .'/include/controller/ubigeo.php');
            $p = new ubigeo();
            $data = $p->getProvinciaByDepartamento($_POST['id']);

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getdistrito':
            require_once($CNG->dirroot .'/include/controller/ubigeo.php');
            $p = new ubigeo();
            $id = explode(",", $_POST['id']);
            $data = $p->getDistritoByProvincia($id[0], $id[1]);

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getestablecimiento':
            require_once($CNG->dirroot .'/include/controller/ubigeo.php');
            $p = new ubigeo();
            $data = $p->getEstablecimientoByUbigeo($_POST['id']);

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getprofesion':
            require_once($CNG->dirroot .'/include/controller/alumno.php');
            $p = new alumno();
            $data = $p->getProfesion();
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getcondicion':
            require_once($CNG->dirroot .'/include/controller/alumno.php');
            $p = new alumno();
            $data = $p->getCondicion();
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;        

        case 'getcurso':
            require_once($CNG->dirroot .'/include/controller/curso.php');
            $p = new cursos();
            $data = $p->getAllCursos();
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getpais':
            require_once($CNG->dirroot .'/include/controller/pais.php');
            $p = new paises();
            $data = $p->getAllPaises();
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        case 'getCursoSet':
            require_once($CNG->dirroot .'/include/controller/curso.php');
            $p = new cursos();
            $data = $p->getCursoSet($_POST['id']);
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        break;

        /****** LISTADO DE CURSOS LIBRES******/
        case 'getCursosLibres':
            require_once($CNG->dirroot .'/include/controller/curso.php');
            $p = new cursos();
            $data = $p->getCursosLibres();
            //LISTADOS DE DATOS
            $clases = array("primary","danger","success","secondary");
            $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $t_curso = array("Estudios Transversales","Formación para la capacitación","Gestión de la Salud","Salud de las personas","Salud familiar y comunitaria","Capacitación SERUMS","Salud y medio ambiente");

            // ICONOS
            $icono_curso = '<i class="mdi mdi-book-education"></i>';
            $icono_calendar = '<i class="mdi mdi-calendar"></i>';
            $icono_info = '<i class="mdi mdi-help" ></i>';
            $icono_tipo = '<i class="mdi mdi-library" ></i>';
            $icono_detalle = '<i class="mdi mdi-information-outline"></i>';
            $icon_pencil = '<i class="mdi mdi-pencil-plus"></i>';
            $icon_eval = '<i class="mdi mdi-notebook-edit-outline"></i>';
            $icon_link = '<i class="mdi mdi-link-variant"></i>';

            //CONTENIDO TOOLIP 1
            $info_link_curso = "De clic para ir al curso en plataforma";

            //URL IMAGEN DE CRONOGRAMA DE EVALUACIONES MOOC
            $url_img_crono = $CNG->wwwroot . '/assets/images/cronograma.jpg';
            $url_img_inscrip = $CNG->wwwroot . '/assets/images/ficha_inscripcion.jpg';
            //CONTENIDO TOOLTIP CERTIFICACION
            $img_insc = "<img src='".$url_img_inscrip."' class='img-fluid'>";
            $eva_meses = array("11-2021","1-2022");
            $icon_c = str_replace('"',"'",$icono_calendar);
            $icon_i = str_replace('"',"'",$icon_pencil);
            $icon_e = str_replace('"',"'",$icon_eval);
            $icon_l = str_replace('"',"'",$icon_link);
            $crono_eva = $icon_c . " Meses de evaluación: ";
            for ($i = 0; $i < count($eva_meses); $i++) {
                $d = explode("-",$eva_meses[$i]);
                $mes = $meses[$d[0]];
                $year = $d[1];                
                $sep = $i > 0 ? " | " : "";
                $crono_eva .= $sep . " " . $mes . " " . $year;
            }
            $crono_eva .= "<br>" . $icon_i . " Plazo de inscripción a evaluación: del 18 al 22";
            $crono_eva .= "<br>" . $icon_e . " Plazo de ingreso a evaluación: del 26 al 30";
            $crono_eva .= "<br>" . $icon_l . " Enlace de inscripción a evaluación: <br>http://pees.minsa.gob.pe/inscripcion/ <i>(En la pestaña <b>INSCRIPCIÓN A CURSOS</b>)</i> ";
            $info_cert_mooc = "<p align='center'><b><u>!IMPORTANTE!</u></b></p><p align='justify'>Para certificar el curso MOOC seleccionado deberá <u><b>INSCRIBIRSE</b></u> a la <b>EVALUACIÓN</b> dentro del plazo establecido en el siguiente cronograma:<br>".$crono_eva."</p>".$img_insc;

            //TEXTO BOTON ENLACE
            $txt_enlace = 'Ir al curso';

            $HTML = "";
            $i_color_last = NULL;            

            if (count($data) > 0) {
                foreach ($data as $d) {
                    $id_moodle = $d["id_curso_moodle"];
                    $nom_largo = $d["nombre_largo"];
                    $f_ini = $d["fec_ini_curso"];
                    $f_fin = $d["fec_fin_curso"];
                    $info_curso = $d["curso_info"];
                    $detalle_curso = $d["curso_detalle"];
                    $tipo_curso = $d["curso_tipo"]; //0=> MOOC
                    $nom_tipo_c = $t_curso[$tipo_curso];

                    if ($tipo_curso == 0) { // SI EL CURSO ES MOOC (TRANSVERSAL)
                        $info_curso = $info_cert_mooc;
                    }

                    $i_color = rand(0, 3);
                    if ($i_color == $i_color_last) {
                        $i_color = $i_color >= 3 ? $i_color - 1 : $i_color + 1;
                    }
                    $color_c = $clases[$i_color];
                    $i_color_last = $i_color;

                    $boton_enlace = "";
                    if ($id_moodle != NULL && $id_moodle != "") {
                        $enlace = 'href="http://pees.minsa.gob.pe/course/view.php?id=' . $id_moodle . '" target="_blank"';
                        $tooltip_enlace = 'title="' . $info_link_curso . '" data-plugin="tippy" data-tippy-placement="right"';
                        $boton_enlace = '<a ' . $enlace . ' class="btn btn-' . $color_c . ' rounded-pill waves-effect waves-light f-bold mt-2" ' . $tooltip_enlace . '>
                            <span class="btn-label"><i class="fa fa-external-link-alt"></i></span>' . $txt_enlace . '</a>';
                    }

                    $boton_r = "";
                    if ($info_curso != NULL && $info_curso != "") {
                        $tooltip_info = 'title="' . $info_curso . '" data-plugin="tippy" data-tippy-placement="top"';
                        $boton_r = '<button class="btn btn-secondary btn-question waves-effect waves-light float-right animate__animated animate__pulse animate__infinite mt-2" ' . $tooltip_info . ' >' . $icono_info . '</button>';
                    }

                    $html_detalle_c = "";
                    if ($detalle_curso != NULL && $detalle_curso != "") {
                        $html_detalle_c = '<p class="card-text text-white mb-3">' . $icono_detalle . ' Descripción: ' . $detalle_curso . '</p> ';
                    }

                    $HTML .=
                        '<div class="item">
                            <div class="card text-white bg-' . $color_c . ' mb-4">
                                <div class="card-header bg-transparent border-bottom bold">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12">
                                            <div class="icon-curso">' . $icono_curso . '</div>
                                        </div>
                                        <div class="col-md-10 col-sm-12">' . $nom_largo . '</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-white">' . $icono_calendar . ' Fecha de inicio: ' . $f_ini . '</p>
                                    <p class="card-text text-white">' . $icono_calendar . ' Fecha de culminación: ' . $f_fin . '</p>
                                    <p class="card-text text-white">' . $icono_tipo . ' Línea estratégica: ' . $nom_tipo_c . '</p>
                                    ' . $html_detalle_c . $boton_enlace . $boton_r . '
                                </div>
                            </div>
                        </div>';
                }
            } else {
                $HTML = null;
            }
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($HTML, JSON_FORCE_OBJECT);
        break;
        /****** END LISTA DE CURSOS LIBRES ******/

        default:
            echo "Undefined function";
        break;
    }

    exit();