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
        form : 'create_form'
    });
    $.validate({
        form : 'validate_inscription_form'
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