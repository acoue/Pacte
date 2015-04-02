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
    
    //Validation des formulaires
    $.validate({
        form : '#productForm'
    });
    
    $('#awesomeForm').isHappy({
    fields: {
      // reference the field you're talking about, probably by `id`
      // but you could certainly do $('[name=name]') as well.
      '#yourName': {
        required: true,
        message: 'Might we inquire your name'
      },
      '#email': {
        required: true,
        message: 'How are we to reach you sans email??',
        test: happy.email // this can be *any* function that returns true or false
      }
    }
  });
});

