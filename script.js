function myFunction() {
    var x = document.getElementById("mobile");
    if (x.className === "displayNone") {
        x.className = "displayBlock";
    } else {
        x.className = "displayNone";
    }
}

$(window).resize(function() {
  if($(window).width()>=994){
  	$('#mobile').attr('class','displayNone'); 
  }  
});
$(window).resize(function() {
  if($(window).width()<=425){
  	$('.selectPhoto90').attr('display','none'); 
  }  
});





