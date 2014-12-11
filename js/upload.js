$j = jQuery.noConflict();
$j(document).ready(function () {

    var custom_uploader;

    /* user clicks button on custom field, runs below code that opens new window */
    $j('#upload_image').click(function (e) {

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function () {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $j('#image_path').val(attachment.url);
        });

        //Open the uploader dialog
        custom_uploader.open();

    });
// window.send_to_editor(html) is how WP would normally handle the received data. 
// It will deliver image data in HTML format, so you can put them wherever you want.
    /*
     window.send_to_editor = function (html) {
     
     var image_url = $j('img', html).attr('src');
     $j('#image_path').val(image_url);
     tb_remove(); // calls the tb_remove() of the Thickbox plugin
     
     }
     */
});