$(document).ready(function() {
    
    var profCode = $('#modal').data('profcode');
    var locale = $('#modal').data('locale');
    var arraymsg = [];
    var lastSelected;

    $('#modalAjoutClient').on('show.bs.modal', function(e) {
        var profCode = $(e.relatedTarget).data('profcode');
        $(e.currentTarget).find('.modal-body form').removeAttr('action');
        $(e.currentTarget).find('.modal-body form').attr('action', Routing.generate('wcs_emailing_import', {'profCode': profCode, '_locale': locale}));
    });

    $('tr').click(function(event) {
        // récupère l'id du tr sélectionné
        idtr = this.id;
        // récupère le data-info du tr sélectionné
        var datainfo = $('#'+idtr).data('info');
        var tableRow = $(this).closest('tr').prevAll('tr').length + 1;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            arraymsg.pop(datainfo);
        } else if (event.shiftKey) {
            var table = $('.display');
            var start = Math.min(tableRow, lastSelected);
            var end = Math.max(tableRow, lastSelected);
            for (var i = start+1; i < end+1; i++) {
                table.find('tr').eq(i).addClass('selected');
                arraymsg.push(table.find('tr').eq(i).data('info'));
            } 
        } else {
            $(this).addClass('selected');
            arraymsg.push(datainfo);
            lastSelected = $(this).closest('tr').prevAll('tr').length + 1;  
        }
    });

    // fonction permettant la suppression de la sélection
    $('#suppr').click(function() {
        var table = $('.display');
        table.find('tr').removeClass('selected');
        arraymsg = [];
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