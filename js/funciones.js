/**
 * Created by Jose Ponce on 11/08/2016.
 */
function enviar_mail(){
    var name=$("#name").val();
    var email=$("#email").val();
    var comment=$("#comment").val();
    var motivo=$("#motivo").val();
    var data = 'name=' + name + '&email=' + email+ '&motivo=' + motivo + '&comment='  + encodeURIComponent(comment);

    $('.text').attr('disabled','true');
    //show the loading sign
    $('.loading').show();
    //start the ajax
    $.ajax({
        url: "envia_mail.php",
        type: "GET",
        data: data,
        cache: false,
        success: function (html) {
            //if contact.php returned 1/true (send mail success)
            if (html==1) {

                $("#name").val("");
                $("#email").val("");
                $("#comment").val("");
                $("#motivo").val("");
                alert('Muchas gracias, te contestare a la brevedad.')
                //if contact.php returned 0/false (send mail failed)
            } else alert('Lo sentimos, error inesperado. Por favor, inténtelo de nuevo más tarde.');
        }
    });
}