function ChangeVisibility(id){
    var elem = document.getElementById(id);
    if(elem.style.display == ""){
        document.getElementById(id).style.display='block';  
    } else if(elem.style.display == "none"){
        document.getElementById(id).style.display='block';       
    } else {
        document.getElementById(id).style.display='none';
    }
}

function ChangeVisibilityAndTextInChamp(id, idText, valueText){
    var elem = document.getElementById(id);
    
    if(elem.style.display == ""){
        document.getElementById(id).style.display='block';
        document.getElementById(idText).value=valueText;
    } else if(elem.style.display == "none"){
        document.getElementById(id).style.display='block';  
        document.getElementById(idText).value=valueText;     
    } else {
        document.getElementById(id).style.display='none';
        document.getElementById(idText).value='';
    }
    
    
    
    
}

$(document).ready(function(){
	
	/* Formulaire Engagement */
	$( "#date_engagement" ).datepicker();
    //Validation des formulaires
    $.validate({
        form : '#iInscription_form'
    });
    $.validate({
        form : '#add_inscription_form'
    });
    $.validate({
        form : '#create_form'
    });
    $.validate({
        form : '#validate_inscription_form'
    });
    //Formulaire changement de mot de passe
    $.validate({
        form : '#changePwd_form'
    });
    //Formulaire compte
    $.validate({
        form : '#compte_form'
    });
    //Formulaire du mot de passe oublié
    $.validate({
        form : '#password_form'
    });
    //Formulaire de contact
	$.validate({
	    form : '#contact_form'
	});
    //Formulaire edition question
	$.validate({
	    form : '#edit_question_form'
    });
    //Formulaire ajout question
	$.validate({
	    form : '#add_question_form'
    });
    //Formulaire edition parametre
	$.validate({
	    form : '#edit_parametre_form'
    });
    //Formulaire ajout parametre
	$.validate({
	    form : '#add_parametre_form'
    });
    //Formulaire edition utilisateur
	$.validate({
	    form : '#edit_utilisateur_form'
    });
    //Formulaire ajout utilisater
	$.validate({
	    form : '#add_utilisateur_form'
    });
    //Formulaire ajout outils
	$.validate({
	    form : '#add_outil_form'
    });
    //Formulaire edition outils
	$.validate({
	    form : '#edit_outil_form'
    });
    //Formulaire ajout de membres
	$.validate({
	    form : '#add_membre_form'
    });
    //Formulaire edition de membres
	$.validate({
	    form : '#edit_membre_form'
    });
    //Formulaire edition du projet
	$.validate({
	    form : '#edit_projet_form'
    });
	//Formulaire ajout d'une desription d'equipe
	$.validate({
	    form : '#add_description_form'
    });
	//Formulaire de modification d'une desription d'equipe
	$.validate({
	    form : '#edit_description_form'
    });
	//Formulaire d'ajout d'une etape du calendrier
	$.validate({
	    form : '#add_calendrierProjet_form'
    });
	//Formulaire de modification d'une etape du calendrier
	$.validate({
	    form : '#edit_calendrierProjet_form'
    });
	//Formulaire d'ajout d'une evaluation
	$.validate({
	    form : '#add_evaluation_form'
    });
	//Formulaire de modification d'une evaluation
	$.validate({
	    form : '#edit_evaluation_form'
    });
	//Formulaire d'ajout d'un plan d'action
	$.validate({
	    form : '#add_plan_form'
    });
	//Formulaire d'edition d'un plan d'action
	$.validate({
	    form : '#edit_plan_form'
    });
	//Formulaire d'ajout d'une etape du plan d'action
	$.validate({
	    form : '#add_etape_form'
    });
	//Formulaire d'edition d'un plan d'action
	$.validate({
	    form : '#edit_etape_form'
    });
	//Formulaire d'ajout d'une mesure a T0
	$.validate({
	    form : '#add_mesure_form'
    });
	//Formulaire d'edition d'une mesure a T0
	$.validate({
	    form : '#edit_mesure_form'
    });
	//Formulaire d'ajout d'un type d'indicateur
	$.validate({
	    form : '#add_type_indicateur_form'
    });
	//Formulaire d'edition d'un type d'indicateur
	$.validate({
	    form : '#edit_type_indicateur_form'
    });
	//Formulaire d'ajout d'une question pour enquete de satisfaction
	$.validate({
	    form : '#add_enquete_form'
    });
	//Formulaire d'edition d'une question pour enquete de satisfaction
	$.validate({
	    form : '#edit_enquete_form'
    });
	//Formulaire d'ajout d'une reponse a enquete de satisfaction
	$.validate({
	    form : '#add_enquete_reponse_form'
    });
	//Formulaire d'edition d'une reponse a enquete de satisfaction
	$.validate({
	    form : '#edit_enquete_reponse_form'
    });
	//Formulaire d'ajout d'un etablissement
	$.validate({
	    form : '#add_etablissement_form'
    });
	//Formulaire d'edition d'un etablissement
	$.validate({
	    form : '#edit_etablissement_form'
    });
	
	
	/*
	 * Test du mot de passe
	 * */
	$('#pass1, #pass2').on('keyup', function(e) {
		
	     if($('#pass1').val() != '' && $('#pass2').val() != '' && $('#pass1').val() != $('#pass2').val()) {
	    	 $('#messagePwd').removeClass().addClass('alert alert-danger').html('Les 2 valeurs ne correspondent pas ! ');
	    	 return false;
	     }
	     // Must have capital letter, numbers and lowercase letters
	     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

	     // Must have either capitals and lowercase letters or lowercase and numbers
	     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	     if (strongRegex.test($(this).val())) {
            // If reg ex matches strong password
            $('#messagePwd').removeClass().addClass('alert alert-success').html('Mot de passe correctement sécurisé.');
	     } else if (mediumRegex.test($(this).val())) {
            // If medium password matches the reg ex
            $('#messagePwd').removeClass().addClass('alert alert-info').html('Renforcez votre mot de passe en utilisant plus de lettres majuscules, plus de chiffres et de caractères spéciaux.');
	     } else {
            // If password is ok
            $('#messagePwd').removeClass().addClass('alert alert-danger').html('Mot de passe faible, essayez d\'utiliser des nombres et des lettres majuscules.');
	     }
        
	     return true;
	});
	
	$('#password').on('keyup', function(e) {		
	     
	     // Must have capital letter, numbers and lowercase letters
	     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
	     // Must have either capitals and lowercase letters or lowercase and numbers
	     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	     if (strongRegex.test($(this).val())) {
           // If reg ex matches strong password
           $('#messagePwd').removeClass().addClass('alert alert-success').html('Mot de passe correctement sécurisé!');
	     } else if (mediumRegex.test($(this).val())) {
           // If medium password matches the reg ex
           $('#messagePwd').removeClass().addClass('alert alert-info').html('Renforcez votre mot de passe en utilisant plus de lettres majuscules, plus de chiffres et de caractères spéciaux !');
	     } else {
           // If password is ok
           $('#messagePwd').removeClass().addClass('alert alert-danger').html('Mot de passe faible, essayez d\'utiliser des nombres et des lettres majuscules.');
	     }
       
	     return true;
	});
	
	
	/* Bouton aide */
    $(".BoutonAide a").popover({
        placement : 'top'
    });
    
    $('[data-toggle="tooltip"]').tooltip()
    
    $("input[name='radioPlanAct']").change(function() {
        if ($("input[name='radioPlanAct']:checked").val() == '1')
           // document.getElementById('divCachePlanAction').style.visibility="hidden";
            document.getElementById('divCachePlanAction').style.display="none";
        else
            //document.getElementById('divCachePlanAction').style.visibility="visible";
            document.getElementById('divCachePlanAction').style.display="block";
    });

});





/* French initialisation for the jQuery UI date picker plugin. */
/* Written by Keith Wood (kbwood{at}iinet.com.au),
			  StÃ©phane Nahmani (sholby@sholby.net),
			  StÃ©phane Raimbault <stephane.raimbault@gmail.com> */
(function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		// AMD. Register as an anonymous module.
		define([ "../jquery.ui.datepicker" ], factory );
	} else {

		// Browser globals
		factory( jQuery.datepicker );
	}
}(function( datepicker ) {
	datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: 'Précédent',
		nextText: 'Suivant',
		currentText: 'Aujourd\'hui',
		monthNames: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin',
			'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
		monthNamesShort: ['janv.', 'fevr.', 'mars', 'avril', 'mai', 'juin',
			'juil.', 'aout', 'sept.', 'oct.', 'nov.', 'dec.'],
		dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
		dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
		dayNamesMin: ['D','L','M','M','J','V','S'],
		weekHeader: 'Sem.',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	datepicker.setDefaults(datepicker.regional['fr']);

	return datepicker.regional['fr'];

}));