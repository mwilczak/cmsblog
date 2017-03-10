tinymce.init({selector:'textarea'});

$(document).ready(function() {
    
 $('#selectAllBoxes').click(function(event){
     
     if(this.checked) {
         
         $('.checkBoxes').each(function(){
           this.checked = true;  
         });
     } else {
         
         $('.checkBoxes').each(function(){
         this.checked = false;  
         });
         
     }
 });
    
});

function loadUserOnline() {
    
    $.get("functions.php?onlineresults=result", function(data){
        
        $(".usersonline").text(data);
        
    });
}
setInterval(function(){
    
    loadUserOnline();
},500);

