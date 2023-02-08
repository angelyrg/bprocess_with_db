$("#form_test").on("submit", function(event){
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "save.php",
        data: $("#form_test").serialize(),
        success: function(resp){
            alert(resp)
        }
    });
});