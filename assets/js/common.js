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

// model open on button click
    function open_model(edit_id = '')
    {
        $('#alertMsg').html('');
        $("#formID").trigger('reset');

        $.ajax({
            type: "POST", 
            data: {edit_id:edit_id},
            url: "ajax/upload.php",
            cache: false,
            success: function (response) {
                
            }
        });
    }

    function change_name(docName='')
    {
        if(docName != ''){
            $('#docNameID').html(docName);
        }else{
            $('#docNameID').html($('.data_active').data('value'));
        }
    }