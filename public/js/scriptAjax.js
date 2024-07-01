//inclusion du token dans toutes les requetes ajax
jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});


// Fonction pour généraliser la recupération des données en AJAX
//Prend en parametre l'url, l'id de l'element à recuperer et l'emplacement de l'affichage
function getDonnees(url,id,affiche){
    var valeur_id=jQuery("#"+id).val();
    jQuery.ajax({
        type:"GET",
        url:"/"+url+"/"+valeur_id,
        data:"",
        dataType: "html",
        success: function(server_response){
        jQuery("#"+affiche).html(server_response).show();
        },
        error: function(server_response){
            Notification('Aucune donnée selectionnée','error');
        }
    });
}


function envoyerForm(idForm,affiche){
    var form_url = $("#"+idForm).attr("action"); //récupérer l'URL du formulaire
    var form_method = $("#"+idForm).attr("method"); //récupérer la méthode GET/POST du formulaire
    var form_data = $("#"+idForm).serialize(); //Encoder les éléments du formulaire pour la soumission
    console.log(form_url);        
        $.ajax({
        url : form_url,
        type: form_method,
        data : form_data,
        /* beforeSend: function () {
        jQuery("#"+affiche).css('text-align','center');
        jQuery("#"+affiche).html('<img src="/img/Preloader_11.gif">');
        },
        complete: function () {
            jQuery("#"+affiche).css('text-align','');
        }, */
        success: function(server_response){
            //console.log(server_response);
            jQuery("#"+affiche).html(server_response).show();
        },
        error: function(server_response){
            Notification('Aucune donnée selectionnée');
        }
    });
}

function getListeLocalite(url,affiche){
    
    var idregion=jQuery('#region').val();
    var idprovince=jQuery('#province').val();

    if(Number(idregion)==0){
        idregion=0;
    }
    if(Number(idprovince)==0){
        idprovince=0;
    }
    
    var chemin="/"+url+"/"+idregion+"/"+idprovince;
    console.log(chemin);
    jQuery.ajax({
        type:"GET",
        url:chemin,
        data:"",
        dataType: "html",
        beforeSend: function () {
            jQuery("#"+affiche).css('text-align','center');
            jQuery("#"+affiche).html('<img src="/images/Preloader_11.gif">');
        },
        complete: function () {
            jQuery("#"+affiche).css('text-align','');
        },
        success: function(server_response){
            jQuery("#"+affiche).html(server_response).show();
        },
        error: function(server_response){
            Notification('Une erreur est survenue!');
        }
    });
    
}