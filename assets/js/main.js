(function(){
    //#lecturer-login-form && #student-login-form
    $('#lecturer-login-form, #student-login-form').on('submit', function($e){
        $e.preventDefault();
        $e.stopPropagation();
        let $this = $(this);
        let $formData = Object.fromEntries(new FormData($this[0]));
        let method = $this.attr('method');
        let url = $this.attr('action');

        $.ajax({
            url,
            method,
            type: 'json',
            data: $formData,
            beforeSend: function() {
                $('.message-box').empty();
            },
            success: function($res) {
                if(!$res.status) {
                    $('.message-box').text($res.message).removeClass('text-primary').addClass('text-danger');
                } else {
                    $('.message-box').text($res.message).removeClass('text-danger').addClass('text-primary');
                    $this.delay(2000).queue(function(){
                        $res.redirect ? window.location.href = $res.redirect : null;
                    })
                }
            }
        })
    })


})()