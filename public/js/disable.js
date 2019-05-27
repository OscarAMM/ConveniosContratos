var observationCheck = document.getElementById('observationCheck');
var textArea = document.getElementById('observation');

observationCheck.addEventListener("click", function(){
    textArea.disabled = observationCheck.checked ? false:true;
    if(!textArea.disabled){
        textArea.focus();
    }
});

