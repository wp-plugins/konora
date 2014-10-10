jQuery(function() {

   jQuery(".konora-form").submit(function(e) {
      e.preventDefault();
      
      name = jQuery('#konora-name').val();
      email = jQuery('#konora-email').val();
      
      url = jQuery(this).attr('action');
      
      ajaxData = {'name': name, 'email': email, 'url': url};
      
      jQuery.ajax({
         url: window.plugin_konora_url + '/form.php',
         type: 'GET',
         data: ajaxData
      }).error(function() {
         alert('Si è verificato un errore. Si prega di riprovare più tardi.');
      });
      
       jQuery(this).html('Il form è stato inviato!');
   });
   
});
