jQuery(function($) {
    $('.upload-button').live('click', function(e) {
        window.adcode_id      = $(e.target).attr('rel');
        window.send_to_editor = image_upload_handler;

        tb_show('', 'media-upload.php?type=image&amp;amp;amp;TB_iframe=true');

        return false;
    });

    function image_upload_handler(html) {
        imgurl = $('img',html).attr('src');
        if(!imgurl) imgurl = $(html).attr('src');

        var el = $('#' + window.adcode_id);
        el.val(imgurl);
        el.parents('form').first().trigger('change');

        tb_remove();
    };
});