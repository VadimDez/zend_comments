/**
 * Created by vadimdez on 10/11/13.
 */

$(document).ready(function()
{
    var param1  = 10;
    var offsetCocktails  = 10;
    var offsetCategories = 10;
    var offsetIngridients= 10;

    $(".comment").click(function() {
        var id = "/"+$(this).attr("data-in");

        var form = "<form action='/zend_comments/public/comments/add"+id+"' method='POST' name='comments' id='comments'><input type='hidden' name='id' value=''><br><label><span>Name</span><input type='text' name='senderName' value=''></label><br><label><span>text</span><textarea name='text'></textarea></label><br><input type='submit' name='submit' id='submitbutton' value='Send'><br></form>";

        $(this).parent().append(form);
        $(this).hide();
    });

});