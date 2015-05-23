jQuery(document).ready(function($) {
// Show the login dialog box on click
	
		
   $('a#ajax-show-login').on('click', function(ajaxlogin){
        $('body').prepend('<div class="body-overlay"></div>');
        $('form#ajax-login').show();
       
	   $('form#ajax-login a.ajax-close').on('click', function(){
            $('div.body-overlay').remove();
            $('form#ajax-login').hide();
        });
        ajaxlogin.preventDefault();
    });

    // Perform AJAX login on form submit
    $('form#ajax-login').on('submit', function(ajaxloginform){
        $('form#ajax-login p.ajax-status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#ajax-login #username').val(), 
                'password': $('form#ajax-login #password').val(), 
                'security': $('form#ajax-login #security').val() },
            success: function(data){
                $('form#ajax-login p.ajax-status').text(data.message);
                if (data.loggedin == true){
                    document.location.href = ajax_login_object.redirecturl;
                }
            }
        });
        ajaxloginform.preventDefault();
    });
});