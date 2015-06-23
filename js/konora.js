jQuery(function ($) {

    var $list_form_konora = $('form.konora-form:not(.knrActive)');

    $list_form_konora.each(function () {

        var $form = $(this);
        $form.addClass('knrActive');

        $form.submit(function (e) {
            e.preventDefault();

            var name = $form.find('#name').val();
            var surname = $form.find('#surname').val();
            var email = $form.find('#email').val();
            var phone = $form.find('#phone').val();
            var street = $form.find('#address_street_1').val();
            var city = $form.find('#address_city_1').val();
            var district = $form.find('#address_district_1').val();
            var postcode = $form.find('#address_postcode_1').val();
            var state = $form.find('#address_state_1').val();
            var note = $form.find('#note').val();
            var sponsor = $form.find('#sponsor').val();
            var birthday = $form.find('#birthday_day').val();
            var redirect = $form.find('#redirect').val();
            var signup = $form.find('#signup').val();
            var pack = $form.find('#pack').val();
            var recurrence = $form.find('#recurrence').val();
            var url = $form.attr('action');

            var ajaxData = {
                'name': name !== 'undefined' ? name : '',
                'surname': surname,
                'email': email,
                'phone': phone,
                'sponsor': sponsor,
                'address_street_1': street,
                'address_city_1': city,
                'address_district_1': district,
                'address_postcode_1': postcode,
                'address_state_1': state,
                'note': note,
                'birthday_day': birthday,
                'signup': signup,
                'pack': pack,
                'recurrence': recurrence,
                'id_circle': circle_id
            };

            if (email == '') {
                alert('Inserire una email corretta!!!!');
            } else if ((email.indexOf('hotmail.com') > -1) || (email.indexOf('hotmail.it') > -1)) {
                alert('ATTENZIONE. In questa pagina NON puoi usare HOTMAIL per registrarti. Gentilmente usa un\'altra email. Se non ce l\'hai creane una su gmail');
            } else {

                $.ajax({
                        url: url,
                        type: 'GET',
                        data: ajaxData
                    })
                    .error(function () {
                        alert('Si è verificato un errore. Si prega di riprovare più tardi.');
                    })
                    .done(function () {
                        if (redirect !== undefined) {
                             window.location.href = redirect;
                        } else {
                            $form.html('Il form è stato inviato correttamente!');
                        }
                    });
                
                $form.html('Stiamo inviando i tuoi dati...');
            }    
        });

    });
});