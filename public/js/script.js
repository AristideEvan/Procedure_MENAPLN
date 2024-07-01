/**
 * fichier pour les scripts personnels de js
 */
/**debut du script consernant select2 */
jQuery('select').select2({
    language: "fr"
});

jQuery('#province').select2({
  placeholder: "Province"
});

jQuery('#region').select2({
  placeholder: "Région"
});

jQuery('#commune').select2({
  placeholder: "Commune"
});

jQuery('#statut').select2({
  placeholder: "Statut"
});

jQuery('#region').select2({
  placeholder: "Région"
});

jQuery('select').select2({
  placeholder: "Sélectionner",
  language: "fr"
});



/* jQuery(document).ready(function() {
    jQuery('#example').DataTable( {
        "language": {
            "sProcessing": "Traitement en cours ...",
            "sLengthMenu": "Afficher _MENU_ lignes",
            "sZeroRecords": "Aucun résultat trouvé",
            "sEmptyTable": "Aucune donnée disponible",
            "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
            "sInfoEmpty": "Aucune ligne affichée",
            "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
            "sInfoPostFix": "",
            "sSearch": "Chercher:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Chargement...",
            "oPaginate": {
              "sFirst": "Premier", "sLast": "Dernier", "sNext": ">", "sPrevious": "<"
            },
            "oAria": {
              "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
            }
          },
          dom: 'Blfrtip',
          buttons: [
            //'copyHtml5',
            'excelHtml5',
            //'csvHtml5',
            'pdfHtml5'
        ],
          responsive: true,
          "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tout"]],
          colReorder: true,
          ordering: true
      } );
  } );
 */
  function Notification(message,typeMsg){
    jQuery.rtnotify({
      title: "",
      message: message,
      type: typeMsg,
      permanent: false,
      timeout: 2,
      fade: true,
      width: 300
  });
}

function Supprimer(href){
  jQuery('#pourSupp').prop('action', href);
  //jQuery('#nb').text(text);
console.log('test');
  jQuery("#suppModal").modal();
}  

function Payer(href){
  jQuery('#paymentForm').prop('action', href);
  //jQuery('#nb').text(text);
console.log(href);
  jQuery("#paymentModal").modal();
}

function Mouvement(href){
  jQuery('#mouvementForm').prop('action', href);
  //jQuery('#nb').text(text);
console.log(href);
  jQuery("#mouvementModal").modal();
}

/** fonction pour afficher des fenetres de type popup */
/*function popUp(chemin,id){
  console.log(chemin);
  jQuery('#envoi').load(chemin, function(){
    jQuery("#"+id).modal();
});
}*/



 /*  pour faire afficher le mot de passe */
 jQuery(".toggle-password").click(function() {

  jQuery(this).toggleClass("fa-eye fa-eye-slash");
  var input = jQuery(jQuery(this).attr("toggle"));
  if (input.attr("type") == "password") {
  input.attr("type", "text");
  } else {
  input.attr("type", "password");
  }
});

function changerEtatCompte(href,text){
  jQuery('#changeEtat').prop('action', href);
    jQuery('#zoneMessage').text(text);
    jQuery("#changeEtatModal").modal();
}

function unlink(href,text){
  jQuery('#delier').prop('action', href);
    //jQuery('#zoneMessage').text(text);
    jQuery("#unlink").modal();
}

function popupDfa(href){
  jQuery('#decisionDfa').prop('action', href);
  var where=jQuery('#where').val();
  var tableForm=jQuery('#tableForm').val();
  jQuery('#wherePop').val(where);
  jQuery('#tableFormPop').val(tableForm);
  jQuery("#decisionModal").modal();
}

/** fonction pour afficher des détails */
function detail(chemin){
    jQuery('#envoi').load(chemin, function(){
      jQuery("#detail").modal();
  })
}

/** fonction pour afficher des détails */
function popUp(chemin,id){
  console.log(chemin);
  jQuery('#envoi').load(chemin, function(){


    console.log("je suis dans le popup"+id)
    jQuery("#"+id).modal();
})
}

$(function(){
	$('.sm,.ssm').prop("disabled",true);
	function count_checkbox_checked(){
		nchecked = 0;
		$('.parent,.sm').each(function(index){
			if($(this).prop('checked')){
				nchecked = nchecked + 1;
			}
		});
		$('input[name="nbmenu"]').val(nchecked);
	}
	$('#toutMenu').click(function(){
		if($(this).prop('checked')){
			$('.parent,.sm,.ssm').prop("checked",true);
			$('.sm,.ssm').prop("disabled",false);
		}else{
			$('.parent,.sm, .ssm').prop("checked",false);
			$('.sm,.ssm').prop("disabled",true);
		}
		count_checkbox_checked();
	});
	$('.parent,.sm').click(function(){
		if($(this).prop('checked')){
			$('.fils'+$(this).attr("value")).prop("disabled",false);
		}else{
			$('.fils'+$(this).attr("value")).prop("disabled",true);
			$('.fils'+$(this).attr("value")).prop("checked",false);
            $('.pfils'+$(this).attr("value")).prop("disabled",true);
			$('.pfils'+$(this).attr("value")).prop("checked",false);
		}
		count_checkbox_checked();
	});
    $('.sm').css('margin-left','20px');
    $('.ssm').css('margin-left','40px');
});

//desactiver le niveau daction dans la création de l'utilisateur
function Deactiver(id){
  var valeur_id=jQuery("#"+id).val();
  var act="";
  $('.zoneAction').each(function(index){
    act=$(this).attr('act');
    if(act>valeur_id){
      jQuery('select[act="'+act+'"]').attr('disabled', 'true').css('background-color', '#E3E3E3').val("");
    }else{
      jQuery('select[act="'+act+'"]').removeAttr('disabled');
      jQuery('select[act="'+act+'"]').removeAttr('style');
    }
  });
}

function Cacher(id) {
  var statut = jQuery("#" + id + " option:selected").val();

  $('.zoneVisible').each(function(index) {
    var act = 1;
    var actDeux = 2;
    
    
    if (statut == 1) {
      var divElement = jQuery('div[act="' + act + '"]');
      var divElementDeux = jQuery('div[act="' + actDeux + '"]');
      divElement.show().attr('display', 'block');
      divElementDeux.hide().attr('display', 'none');
    } else {
      var divElement = jQuery('div[act="' + act + '"]');
      var divElementDeux = jQuery('div[act="' + actDeux + '"]');
      divElement.hide().attr('display', 'none');
      divElementDeux.show().attr('display', 'block');
    }
  });
}



function verifierChamp(){
  var valeur;
  var nbr=0;
  $('.obliger').each(function(index){
    valeur=$(this).val();
    if(valeur==''){
      $(this).css('border','1px solid #F00');
      nbr++;
    }else{
      $(this).removeAttr('style');
    }
  });
  console.log(nbr);
  return nbr;
}


 /* Fonction pour activer un element du ménu */
 jQuery(document).ready(function() {
  var chemin=jQuery(location).attr("pathname");
  var indice=chemin.split('/');
  var tailleTab = indice.length;
  var elem=indice[1];
  //console.log();

  jQuery('#colapse-'+indice[tailleTab-2]).addClass('menu-is-opening menu-open');
  jQuery('#sousMenu'+indice[tailleTab-1]).addClass('lienActiver');
});


function changerEtatSortis(href){
  
  //href = href+"/"+struc;
    jQuery('#changeEtatSortis').prop('action', href);
    //jQuery('#zoneMessage').text(text);
    jQuery("#changeEtatSortisModal").modal();
}

function getConvention(id){
  var statut = $('#'+id+" option:selected").text();
  var valeurStatut = statut.toLowerCase();

  if(valeurStatut=='public'){
    $("#conventionne").removeAttr('required');
    $("#conventionne").prop("disabled",true);
  }else{
    $("#conventionne").prop('required',true);
    $("#conventionne").removeAttr('disabled');
  }
  console.log(statut.toLowerCase());
}


/**
 * fonction pour calculer le nombre de fille en fonction du côta ainsi que du nombre de bourse total
 */

 function calculNombreBourse(){
  var nbrTotalBourse=jQuery('#nbrTotalBourse').val();
  var cotaFille=jQuery('#quotaFille').val();
  if(Number(nbrTotalBourse)!=0 && Number(cotaFille!=0)){
      var nbrFille=(nbrTotalBourse*cotaFille)/100;
      var nbrGarcon=nbrTotalBourse-nbrFille;

      var nbrMeriteFille=(Math.round(nbrFille)*40)/100;
      //console.log(nbrMeriteFille);
      var nbrSocialFille=nbrFille-nbrMeriteFille;

      var nbrMeriteGar=(Math.round(nbrGarcon)*40)/100;
      var nbrSocialGar=nbrGarcon-nbrMeriteGar;

      jQuery('#nbrFille').val(Math.round(nbrFille));
      jQuery('#nbrGarcon').val(Math.round(nbrGarcon));

      jQuery('#nbrGarconMerite').val(Math.round(nbrMeriteGar));
      jQuery('#nbrGarconSocial').val(Math.round(nbrSocialGar));

      jQuery('#nbrFilleMerite').val(Math.round(nbrMeriteFille));
      jQuery('#nbrFilleSocial').val(Math.round(nbrSocialFille));

      jQuery('#nbreFille').val(Math.round(nbrFille));
      jQuery('#nbreGarcon').val(Math.round(nbrGarcon));

      jQuery('#nbreGarconMerite').val(Math.round(nbrMeriteGar));
      jQuery('#nbreGarconSocial').val(Math.round(nbrSocialGar));

      jQuery('#nbreFilleMerite').val(Math.round(nbrMeriteFille));
      jQuery('#nbreFilleSocial').val(Math.round(nbrSocialFille));
  }
  

 // console.log('fille '+nbrFille+' et garcon '+nbrGarcon);
}


function checkTout(id,classe){
  if($('#'+id).prop('checked')){
      $('.'+classe).prop("checked",true);
  }else{
      $('.'+classe).prop("checked",false);
  }
}

function Collapser(id){
  var chaine=id.split('-');/* Pour recuperer le num du collapse */
  var ordre=chaine[1];/* Num du collapse */
  var classe=jQuery("#collapse-"+ordre).prop('class');

  if (classe=='collapse'){/* afficher si collapse */
      jQuery("#collapse-"+ordre).addClass('show');
  }else{/* Collapser si le collapse est affiché */
      jQuery("#collapse-"+ordre).removeClass('show');
  }
  for (var i = 1; i <=12; i++) {/* Decollapser tous les autres collapses*/
      if (id!='collaps-'+i) {
          jQuery("#collapse-"+i).removeClass('show');
      }
  }
}

function validerDate(debut,limit,niveau){
  var dateDebut=$('#'+debut);
  var dateLimit=$('#'+limit);

  if(dateDebut.val()!="" && dateLimit.val()!=""){
    var partsDeb=dateDebut.val().split("-");
    var date_debut=new Date(partsDeb[2],partsDeb[1]-1,partsDeb[0]);
    
    var partsLimit=dateLimit.val().split("-");
    var dateLimite=new Date(partsLimit[2],partsLimit[1]-1,partsLimit[0]);
    //console.log(aujourd);
    if(dateLimite<date_debut){
      if(Number(niveau)==1){
        dateDebut.val("");
      }else{
        dateLimit.val("");
      }
        //popupAlert("La date de début ne peut être antérieure &agrave; date limite!");
        $.rtnotify({
            title: "",
            message: "La date de début ne peut être antérieure &agrave; date limite!",
            type: "error",
            permanent: false,
            timeout: 5,
            fade: true,
            width: 300
        });
    }
  }

  $(document).ready(function() {
    jQuery('[data-mask]').inputmask();
  });

jQuery(".phone").inputmask({"mask": "(+999) 99-99-99-99"});

function numeroter(classElem){
    var t=1;
    jQuery("."+classElem).each(function(){
        jQuery(this).attr('name',classElem+''+t)
        jQuery(this).attr('id',classElem+''+t)
        t++;
    });
}

  
}