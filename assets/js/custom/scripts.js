(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var $modal = $('#ajax-modal');
    $(document).on('click', '[data-toggle="ajax-modal"]', function (e) {
        e.preventDefault();
        var element = $(this);
        var url = $(this).attr('href');
        if (url.indexOf('#') === 0) {
            $('#mainModal').modal('open');
        } else {
            $.get(url, function (data) {
                $modal.modal();
                $modal.html(data);
            });
        }
    });
    $(document).on('click', '.btn-delete', function (e){e.preventDefault(); confirm_dialog($(this).parent('form')); });
    function confirm_dialog(form){
        BootstrapDialog.show({
            title: 'Deleting a record',
            message: 'You are about to delete a record, this action cannot be undone, proceed?',
            buttons: [{
                icon: 'fa fa-check',
                label: ' Yes',
                cssClass: 'btn-success pull-left',
                action: function(){
                    form.submit();
                }
            }, {
                icon: 'fa fa-remove',
                label: ' No',
                cssClass: 'btn-danger pull-right',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
        return false;
    }
    $(document).on('submit', '.ajax-submit', function(e){
        e.preventDefault();
        var $form = $(this),$modalBody = $form.find('.modal-body'),$modal = $form.find('div.modal-content'),button=$form.find('[type=submit]');
        $modalBody.find('.alert').remove();
        var formData = new FormData(this);
        var ajaxNonReload = false;
        if($form.hasClass('ajaxNonReload')){
            ajaxNonReload = true;
            formData.append('ajaxNonReload', 'true');
        }
        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            async:false,
            beforeSend:function () {
                $("input,textarea").each(function(){
                    $(this).parents('.form-group').removeClass("has-error");
                });
                button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Sending ...');
                $modal.addClass('spinner');
            },
            success : function(data){
                if(ajaxNonReload) {
                    if(data.success){
                        var errorsHtml= '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.msg + '</div>';
                    }else{
                        var errorsHtml= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.msg + '</div>';
                    }
                    $modalBody.prepend(errorsHtml);
                    $form.trigger("reset");
                }else{
                    window.location.reload('true');
                }
            },
            error : function(jqXhr, json, errorThrown){
                var response = jqXhr.responseJSON;
                var errorStr = '';
                if(response.errors) {
                    $.each(response.errors, function (key, value) {
                        $('[name="' + key + '"]').parents('.form-group').addClass("has-error");
                        errorStr += '- ' + value[0] + '<br/>';
                    });
                    var errorsHtml = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorStr + '</div>';
                }else{
                    var errorsHtml= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + response.msg + '</div>';
                }
                $modalBody.prepend(errorsHtml);
            },
            complete : function(){
                button.prop('disabled', false).html('SUBMIT');
                $modal.removeClass('spinner');
            }
        });
    });
})(jQuery);