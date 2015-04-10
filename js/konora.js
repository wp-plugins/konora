jQuery(function ($) {

    var $list_form_konora = $('form.konora-form:not(.knrActive)');

    $list_form_konora.each(function () {

        var $form = $(this);
        $form.addClass('knrActive');
        
        $.get("http://panel.konora.com/api/form_stats", { circle_id: circle_id });

        $form.submit(function (e) {
            e.preventDefault();

            var name = $form.find('#konora-name').val();
            var surname = $form.find('#konora-surname').val();
            var email = $form.find('#konora-email').val();
            var phone = $form.find('#konora-phone').val();
            var street = $form.find('#konora-address').val();
            var city = $form.find('#konora-city').val();
            var district = $form.find('#konora-prov').val();
            var postcode = $form.find('#konora-CAP').val();
            var state = $form.find('#state').val();
            var note = $form.find('#konora-note').val();
            var sponsor = $form.find('#konora-sponsor').val();
            var birthday = $form.find('#konora-birthday').val();
            var redirect = $form.find('#konora-redirect').val();
            var signup = $form.find('#konora-signup').val();
            var pack = $form.find('#konora-pack').val();
            var recurrence = $form.find('#konora-recurrence').val();
            var url = $form.attr('action');

            SetCookie('email', email, 365);
            
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
                'recurrence': recurrence
            };

            $.ajax({
                url: url,
                type: 'GET',
                data: ajaxData
            })
                    .error(function () {
                        alert('Si è verificato un errore. Si prega di riprovare più tardi.');
                    })
                    .done(function () {
                        $.get("http://panel.konora.com/api/form_stats", { circle_id: circle_id, compiled: 1});
                
                        if (redirect  !== undefined) {
                            window.location.href = redirect;
                        } else {
                            $form.html('Il form è stato inviato correttamente!');
                        }
                    });

            $form.html('Stiamo inviando i tuoi dati...');
        });
    });
});

function SetCookie(cookieName, cookieValue, nDays) {
    var today = new Date();
    var expire = new Date();
    var domain;

    var host = window.location.host.split(".");
    if (host.length > 2) {
        domain = host.pop();
        domain = '.' + host.pop() + '.' + domain;
    } else {
        domain = '.' + host;
    }

    if (nDays === null || nDays === 0) {
        nDays = 1;
    }

    expire.setTime(today.getTime() + 3600000 * 24 * nDays);
    document.cookie = cookieName + "=" + escape(cookieValue)
            + ";expires=" + expire.toGMTString() + ";domain=" + domain;
}