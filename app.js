$(document).ready(function(){
    
    $("#modal_new").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: 'controller/process/process.store.php',
            type: 'POST',
            data: $("#newitem_form").serialize(),
            success: function(resp){
                console.log(resp)
                // $("#modal_new_level").modal("hide");
                // $("#form_message").html('');
                // $("#modal_success_message").html("New division created")
                // $("#modal_success").modal("show");
                // $('#modal_success').on('hide.bs.modal', function (e) {
                //     $("#modal_success_message").html("")
                //     window.location.reload();
                // })
            }
        })

    });

});