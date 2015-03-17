jQuery(function () {

    var $list_form_konora = jQuery('form.konora-form:not(.knrActive)');

    $list_form_konora.each(function () {

        var $form = jQuery(this);
        $form.addClass('knrActive');
        
        jQuery.get("https://www.konora.com/api/form_stats", { circle_id: circle_id });

        $form.submit(function (e) {
            e.preventDefault();

            name = $form.find('#konora-name').val();
            surname = $form.find('#konora-surname').val();
            email = $form.find('#konora-email').val();
            phone = $form.find('#konora-phone').val();
            city = $form.find('#konora-city').val();
            note = $form.find('#konora-note').val();
            sponsor = $form.find('#konora-sponsor').val();
            birthday = $form.find('#konora-birthday').val();

            redirect = $form.find('#konora-redirect').val();
            url = $form.attr('action');

            SetCookie('email', email, 365);
            
            ajaxData = {
                'name': name !== 'undefined' ? name : '',
                'surname': surname,
                'email': email,
                'phone': phone,
                'sponsor': sponsor,
                'address_city_1': city,
                'note': note,
                'birthday': birthday
            };

            jQuery.ajax({
                url: url,
                type: 'GET',
                data: ajaxData
            })
                    .error(function () {
                        alert('Si è verificato un errore. Si prega di riprovare più tardi.');
                    })
                    .done(function () {
                        jQuery.get("https://www.konora.com/api/form_stats", { circle_id: circle_id, compiled: 1});
                
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