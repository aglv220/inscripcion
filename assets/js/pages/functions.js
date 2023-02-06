$("#overlay").show();

$.ajax({
    url: "include/util/getFunctions.php",
    data: { function: 'getCursosLibres' },
    dataType: "json",
    type: "POST",
    success: function (data) {
        if (data != null) {
            $("#owl-cursos-libres").html(data);
            $("#overlay").hide();
            $("#owl-cursos-libres").owlCarousel({
                items: 3,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [980, 2],
                itemsTablet: [768, 1],
                itemsTabletSmall: false,
                itemsMobile: [479, 1],
                singleItem: false,

                //Basic Speeds
                slideSpeed: 200,
                paginationSpeed: 800,
                rewindSpeed: 1000,

                // Navigation
                navigation: true,
                navigationText: ["Anterior", "Siguiente"],
                rewindNav: true,

                //Pagination
                pagination: true,
                paginationNumbers: true,

                // Responsive 
                responsive: true,
                responsiveRefreshRate: 200,
                responsiveBaseWidth: window
            });
            if ($('[data-plugin="tippy"]').length > 0) tippy('[data-plugin="tippy"]');

            $("#card-cursos-l").removeClass("h-300");
        } else {
            $("#owl-cursos-libres").html("<h5 class='text-center'>No se han encontrado cursos libres</h5>");
            $("#owl-cursos-libres").show();
            $("#overlay").hide();
            $("#card-cursos-l").removeClass("h-300");
        }
    },
    error: function (data) {
        //console.log(data.responseText);

    }

});

