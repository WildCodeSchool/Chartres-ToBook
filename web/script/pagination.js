
function pagination(nbParPage,divSelect,divPager)
{	
    //Initialisation
    var nbElem = $(divSelect).length;
    var nbPage = Math.ceil(nbElem / nbParPage);
    var pageLoad = 1;
    
    $(divSelect).each(function(index) {
        if (index < nbParPage)
            $(divSelect).eq(index).show();
        else
            $(divSelect).eq(index).hide();
    });
    
    $(divPager).html("<ul class='pagination pagination-lg'></ul>");
    for(i = 1; i < nbPage; i++){ $(divPager + ' ul').append("<li><a href='#' onclick='return false;'>" + i + "</a></li>"); }
    //Suivant Precedent
     $('.pagination').prepend("<li class='precedent'><a href='#' onclick='return false;'><span>Precedent</span></li>");
     $('.pagination').append("<li class='suivant'><a href='#' onclick='return false;'><span>Suivant</span></li>");

    //Changement click page
    $(divPager + ' ul li').click(function() {
        if ($(this).index() + 1 != pageLoad) {
            pageLoad = $(this).index() + 1;
            $(divSelect).hide();
            
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
            
            reset();
        }
    });

    //Reset & verification
    function reset() {
        if (nbPage < 2) $(divPager).hide();
        if (pageLoad == nbPage) $('.pagination li.suivant').hide(); else $('.pagination li.suivant').show();
        if (pageLoad == 1) $('.pagination li.precedent').hide(); else $('.pagination li.precedent').show();
        $(divPager + ' ul li').removeClass('active');
        $(divPager + ' ul li').eq(pageLoad -1).addClass('active');
    }
    
	
	//Evenement click sur suivant
    $('.pagination li.suivant').click(function() {
        if (pageLoad < nbPage) {
            pageLoad += 1;
            $(divSelect).hide();
            
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
            
            reset();
        }
    });
	
	//Evenement click sur precedent
    $('.pagination li.precedent').click(function() {
        if (pageLoad -1 >= 1) {
            pageLoad -= 1;
            $(divSelect).hide();
            
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
            
            reset();
        }
    });
    
    reset();
}