import './bootstrap';


document.addEventListener('DOMContentLoaded', function(){

    let fileInput = document.querySelector('form input#input__file');
    if(fileInput !== null) {
        fileInput.addEventListener("change", function() {
            this.parentNode.submit();
        });
    }

});

