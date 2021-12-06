$(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
});
$(document).ready(function() {
    $('#atwidth').light2({
        atwidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#atwidth').removeClass('cS1-hidden');
        } 
    });  
});

function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
}