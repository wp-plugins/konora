$(function() {
   $("#konora-form").submit(function(e) {
      e.preventDefault();
      
      name = $('#konora-name').val();
      email = $('#konora-email').val();
      
      url = $('#konora-form').attr('action');
      
      ajaxData = {'name': name, 'email': email, 'url': url};
      
      $.ajax({
         url: window.plugin_konora_url + '/form.php',
         type: 'GET',
         data: ajaxData
      }).error(function() {
         message = 'Si è verificato un errore. Si prega di riprovare più tardi.';
      }).done(function(r) {
         message = 'Il form è stato inviato correttamente!';
      }).always(function() {
         $('#konora-wrapper').html(message);
      });
      
   });
});
