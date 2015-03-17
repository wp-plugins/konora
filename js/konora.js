jQuery(function() {

   jQuery(".konora-form").submit(function(e) {
      e.preventDefault();
      
      $form = jQuery(this);
      
      name = jQuery('#konora-name').val();
      email = jQuery('#konora-email').val();
      phone = jQuery('#konora-phone').val();
      sponsor = jQuery('#konora-sponsor').val();
      
      redirect = jQuery('#konora-redirect').val();
      url = jQuery(this).attr('action');
      
      ajaxData = {'name': name, 'email': email, 'phone': phone, 'sponsor': sponsor};
      
      jQuery.ajax({
         url: url,
         type: 'GET',
         data: ajaxData
      }).error(function() {
         alert('Si è verificato un errore. Si prega di riprovare più tardi.');
      }).done(function() {
         if (redirect != '') {
            window.location.href = redirect;
         } else {
            $form.html('Il form è stato inviato correttamente!');
         }
      });
      
       $form.html('Stiamo inviando i tuoi dati...');
   });
   
});
