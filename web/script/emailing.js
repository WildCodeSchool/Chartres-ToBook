$(document).ready(function() {
    
    var profCode = $('#modalAjout').data('profcode');
    var localeAjout = $('#modalAjout').data('locale');
    var localeSuppr = $('#modalSuppr').data('locale');
    var arrayid = [];
    var arraymsg = [];
    var lastSelected;

    $('#modalAjoutClient').on('show.bs.modal', function() {
        var profCode = $(e.relatedTarget).data('profcode');
        $('.ajout form').removeAttr('action');
        $('.ajout form').attr('action', Routing.generate('wcs_emailing_import', {'profCode': profCode, '_locale': localeAjout}));
    });

    $('tr').click(function(event) {
        // récupère l'id du tr sélectionné
        idtr = this.id;
        // récupère le data-info du tr sélectionné
        var datainfo = $('#'+idtr).data('info');
        // récupère le data-id du tr sélectionné
        var dataid = $('#'+idtr).data('id');

        var tableRow = $(this).closest('tr').prevAll('tr').length+1;
        // alert(tableRow);
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            arraymsg.pop(datainfo);
            arrayid.pop(dataid);
        } else if (event.shiftKey) {
            arrayid = [];
            arraymsg = [];
            var table = $('.display');
            var start = Math.min(tableRow, lastSelected);
            var end = Math.max(tableRow, lastSelected);
            alert(start+", "+end);
            for (var i = start+1; i < end+2; i++) {
                // table.find('tr').eq(i).addClass('selected');
                alert(i);
                arraymsg.push(table.find('tr').eq(i).data('info'));
            }
            for (var i = start+1; i < end+2; i++) {
                table.find('tr').eq(i).addClass('selected');
                arrayid.push(table.find('tr').eq(i).data('id'));
            }
            alert(arraymsg+", "+arrayid);
        } else {
            $(this).addClass('selected');
            arraymsg.push(datainfo);
            arrayid.push(dataid);
            lastSelected = $(this).closest('tr').prevAll('tr').length+1;
            // alert(lastSelected);
        }
    });

    // fonction permettant la suppression de la sélection
    $('#vider').click(function() {
        $('.display').find('tr').removeClass('selected');
        arraymsg = [];
        arrayid = [];
    });

    // fonction permettant la suppression de la sélection
    $('#modalSupprClient').on('show.bs.modal', function() {
        var concatId = "";
        var concatEmail = "";
        var concatId = arrayid.join();
        var concatEmail = arraymsg.join(", ");
        $( ".listeSuppr" ).empty();
        $( ".listeSuppr" ).append( "<p>"+concatEmail+"</p>" );
        $('.suppr form').removeAttr('action');
        $('.suppr form').attr('action', Routing.generate('wcs_emailing_suppr', {'idClient': concatId, '_locale': localeSuppr}));
    });

    // fonction permettant d'envoyer la sélection des lignes vers l'email (join permet de passer d'un tableau à un string)
    $('#envoi').click(function() {
        $("#"+profCode).val( function( index, val ) {
            return "";
        });
        $("#"+profCode).val( function( index, val ) {
            return val + arraymsg.join();
        });
    });

} );