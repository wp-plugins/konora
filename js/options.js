$(function() {
   if (! $('#konora_login').is(':checked') ) {
      $('#konora_login_circle').prop('disabled', true);
   }
   
   $('#konora_login').change(function() {
      $('#konora_login_circle').prop('disabled',!$('#konora_login_circle').prop("disabled") );
   })
});