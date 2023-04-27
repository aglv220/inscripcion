var pathname = window.location.pathname;
var data_path = pathname.split("/");
var root_path = "/" + data_path[1] + "/";
var url = window.location.href;
var page_name = getPageName(url);

//DATA DE COLUMNAS (JSON) DE LA DATATABLE
function json_dcols_dtable(columnas) {
    json_data_columnas = [];
    if (Object.keys(columnas).length > 0) {
        $.each(columnas, function (i, item) {
            json_data_columnas.push({ data: item })
        });
    }
    return json_data_columnas;
}

//OPCIONES DE LA DATATABLE
function opc_dtable(opc_table) {
    var datos_array = [];
    var valopc_responsive = true;
    var valopc_scrolly = "600px";
    var valopc_lengthmenu = [10, 20, 30];
    var valopc_idisplaylength = 10;
    if (Object.keys(opc_table).length > 0) {
        valopc_responsive = opc_table[0].responsive !== undefined ? opc_table[0].responsive : valopc_responsive;
        valopc_scrolly = opc_table[1].scrolly !== undefined ? opc_table[1].scrolly : valopc_scrolly;
        valopc_lengthmenu = opc_table[2].lengthmenu !== undefined ? opc_table[2].lengthmenu : valopc_lengthmenu;
        valopc_idisplaylength = opc_table[3].idisplaylength !== undefined ? opc_table[3].idisplaylength : valopc_idisplaylength;
    }
    datos_array = [
        { vo_responsive: valopc_responsive },
        { vo_scrolly: valopc_scrolly },
        { vo_lengthmenu: valopc_lengthmenu },
        { vo_idisplaylength: valopc_idisplaylength }
    ];
    return datos_array;
}

//INICIALIZACIÓN DE LA DATATABLE
function inicializar_dtable(id_datatable, form_data, function_on_beforeSend, function_on_complete, columnas_tbl, opc_table = [], ajax_frm_type = "POST") {
    datatable_init = $(id_datatable).DataTable({
        responsive: opc_dtable(opc_table)[0].vo_responsive,
        scrollY: opc_dtable(opc_table)[1].vo_scrolly,
        scrollCollapse: !0,
        lengthMenu: [opc_dtable(opc_table)[2].vo_lengthmenu, opc_dtable(opc_table)[2].vo_lengthmenu],
        iDisplayLength: opc_dtable(opc_table)[3].vo_idisplaylength,
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        ordering: false,
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        },
        ajax: {
            url: root_path + "include/util/getFunctions.php",
            type: ajax_frm_type,
            data: function (d) {
                $.each(form_data, function (key, val) {
                    d[val.name] = val.value;
                });
            },
            beforeSend: function () {
                function_on_beforeSend();
            },
            complete: function (data) {
                function_on_complete(data);
            },
            onerror: function (data) {
                Swal.close();
                Swal.fire({
                    title: "Error de Obtención de datos",
                    text: "Se ha perdido la conexión a la base de datos",
                    type: "error",
                    confirmButtonClass: "btn btn-confirm mt-2"
                }).then((result) => {
                    if (result) {
                        Swal.close();
                    }
                });
            },
            dataSrc: ''
        },
        columns: json_dcols_dtable(columnas_tbl)
    });
    return datatable_init;
}

function getPageName(url) {
    var index = url.lastIndexOf("/") + 1;
    var filenameWithExtension = url.substr(index);
    var filename = filenameWithExtension.split(".")[0];
    return filename;
}