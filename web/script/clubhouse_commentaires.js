$(document).ready(function() 
{
    $('.answer-comment').click(function(e)
    {
        var comment = $(this).parent().parent();
        console.log(comment.attr('id').substr(8));

        $('.reply-to-comment #contenu_contContId').val(comment.attr('id').substr(8));
        $('.reply-to-comment > div').attr('class', '');
    });

});
