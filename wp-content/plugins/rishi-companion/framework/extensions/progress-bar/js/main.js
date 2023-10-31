document.addEventListener("DOMContentLoaded", function() { 
    var winHeight = window.innerHeight,
    docHeight = document.body.clientHeight,
    progressBar = document.querySelector( '#rt-progress-bar progress' ),
    max,
    value;
    /* Set the max scrollable area */
    max = docHeight - winHeight;
    progressBar?.setAttribute('max', max);

    window.addEventListener('scroll', function() {
        value = window.scrollY;
        progressBar?.setAttribute('value', value);
    });

});