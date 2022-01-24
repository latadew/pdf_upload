$(document).ready(function(){
    get_pdf_list();
});

// get employee list on page load
function get_pdf_list()
{
    $.ajax({
        type: "POST", 
        url: "api/get_pdf_list.php",
        cache: false,
        dataType:'html',
        success: function (response) {
            $("#divDocID").html(response);
            change_name();
        }
    });
}

// Upload doc api call
$("form#formID").submit(function(e)
{
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        type: "POST", 
        url: "api/upload.php",
        dataType : 'json',
        cache : false,
        contentType : false,
        processData : false,
        data: formData,
        success: function (response) {
            if (response.status == 'success') 
            {
                $("#alertMsg").html('<div class="alert alert-success alert-dismissible show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $("#formID").trigger('reset');
                get_pdf_list();
            } else {
                $("#alertMsg").html('<div class="alert alert-danger alert-dismissible show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');   
            }
        }
    });
});

function change_name(docName='')
{
    if(docName != ''){
        $('#docNameID').html(docName);
    }else{
        $('#docNameID').html($('.data_active').data('value'));
    }
}