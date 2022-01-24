 $(document).ready(function(){
      // alert(3);
        // get_employee_list();
    });

// get employee list on page load
    function get_employee_list()
    {
        $.ajax({
            type: "POST", 
            url: "ajax/employee_list.php",
            cache: false,
            success: function (response) {
                $("#employee_list").html(response);
                $('.datatable').DataTable();
            }
        });
    }

// model open on button click
    function open_model(edit_id = '')
    {
        $('#alert_msg').html('');
        $("#form_id").trigger('reset');

        $.ajax({
            type: "POST", 
            data: {edit_id:edit_id},
            url: "ajax/add_employee.php",
            cache: false,
            success: function (response) {
                $("#modal_body").html(response);
                initialize_multiselect();
                $("#myModal").modal({
                    backdrop: "static",
                    keyboard: false,
                });
            }
        });
    }