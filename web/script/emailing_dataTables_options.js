$(document).ready(function() {
    
    // stylisation du datatable avec selection multiple sans pagination et avec scroll
    $('table.display').DataTable( {
        select: {
            style: 'multi'
        },
        scrollY:        "200px",
        scrollCollapse: true,
        paging:         false,
    } );

} );