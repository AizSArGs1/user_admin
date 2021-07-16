$(document).ready(function() {
    $(".custom-control-input").on("change", function() {
        let label = $(this).parent().find("label");
        if ($(this).is(":checked")) {
            label.text("active");
        } else {
            label.text("inactive");
        }
    });

    $("#checkedAll").change(function() {
        if (this.checked) {
            $(".checkSingle").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkSingle").each(function() {
                this.checked=false;
            });
        }
    });

    $(".checkSingle").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".checkSingle").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#checkedAll").prop("checked", true);
            }
        }
        else {
            $("#checkedAll").prop("checked", false);
        }
    });

    $('#btnOk').on("click", function() {
        var users = [];
        var option = $('.form-select').find("option:selected").val();
        $(".checkSingle:checked").each(function() {
            users.push($(this).data('id'));
        });
        if(users.length <=0) {
            alert("Please select records.");
        }
        var selected_values = users.join(",");
        if (option == 1){
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "includes/UpdateStatus.php",
                cache:false,
                data:{
                    ids : selected_values,
                    status : '1'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if(data['success']){
                        $("#exampleModal").modal('hide');
                        location.reload();
                    }else{
                        alert("Error...");
                    }
                }
            });
        }

        if (option == 2){
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "includes/UpdateStatus.php",
                cache:false,
                data:{
                    ids : selected_values,
                    status : '0'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if(data['success']){
                        $("#exampleModal").modal('hide');
                        location.reload();
                    }else{
                        alert("Error...");
                    }
                }
            });
        }
        if (option == 3){
            $.ajax({
                type: "POST",
                url: "includes/MassDelete.php",
                cache:false,
                data:{
                    ids : selected_values
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if(data['success']){
                        $("#exampleModal").modal('hide');
                        location.reload();
                    }else{
                        alert("Error...");
                    }
                }
            });
        }

    });

    $('#add_button').on('click', function () {
        $("#idForm").attr("action", "includes/Create_user.php");
        $('.modal-title').text('Add user');
        $('#save').val("Add");
        $('#idForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#idForm").attr("action"),
                method: "POST",
                data: $("#idForm").serialize(),
                success:function (data) {
                    data = JSON.parse(data);
                    if(data.success){
                        $("#exampleModal").modal('hide');
                        // alert('Data added successfully !');
                        location.reload();
                    }else{
                        alert("Error...");
                    }
                }
            });
        });
    });

    $('.update').on('click', function () {
        $("#idForm").attr("action", "includes/Update.php");
        $('#idForm .firstName input[name="firstName"]').val($(this).closest('tr').find('#firstName').text());
        $('#idForm .lastName input[name="lastName"]').val($(this).closest('tr').find('#lastName').text());
        let checked = $(this).closest('tr').find('#status > div:first-child').data('active');
        $('#idForm input[name="status"]').attr('checked',Boolean(checked)).next().text(checked === 1 ? 'active' : 'inactive');
        $('#idForm').find("#user_id").val($(this).attr("data-id-user"));
        $('#exampleModal').modal('show');
        $('.modal-title').text('Edit user');
        $('#save').val("Add");
        $('#idForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#idForm").attr("action"),
                method: "POST",
                data: $("#idForm").serialize(),
                success:function (data) {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data);
                    if(data['success']){
                        $("#exampleModal").modal('hide');
                        // alert('Data added successfully !');
                        location.reload();
                    }else{
                        alert("Error...");
                    }
                }
            });
        });
    });

    $('.delete').on('click', function (e) {
        e.preventDefault();
        var userId = $(this).attr("data-id-user");
        $.ajax({
            url: "includes/Delete.php",
            method: "POST",
            data: {id: userId},
            success:function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data['success']) {
                    $("data").remove();
                    // alert('Data added successfully !');
                    location.reload();
                } else {
                    alert("Error...");
                }

                location.reload();
            }
        });
    });
});



