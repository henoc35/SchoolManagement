$(document).ready(function(){

  $('.modal').modal();
  $('select').material_select();

  $('.datepicker').pickadate({
    selectMonths: false, // Creates a dropdown to control month
    selectYears: 40, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd' 
  });
  
  $(window).resize(function(){
    adminWrapper();
  });
 $('.button-collapse').sideNav({
      menuWidth: 240, // Default is 300
      closeOnClick: false // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
  $('.collapsible').collapsible();

  $('#card-alert .close').on('click', function(){
    $("#card-alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
  });
  $('#card-alert').on('click', function(){
    $("#card-alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
    }); 


});
