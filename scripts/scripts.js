$(document).ready(function() {
    function restoreInput(form){
        form.find('input[type="text"]').val('');
        form.find('.custom-control-label').text('inactive');
        form.find('.custom-control-input')[0].checked = false;
        form.find('.role-select').val('User').change();
    }

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
    $('#btnOk, #btnOk-two').on("click", function() {
        if ($(this).attr("data-box") == 'top'){
            var option = $('.form-select').find("option:selected").val();
        }
        if ($(this).attr("data-box") == 'bottom') {
            var option2 = $('.form-select-two').find("option:selected").val();
        }
        var users = [];
        $(".checkSingle:checked").each(function() {
            users.push($(this).data('id'));
        });

        if(users.length <= 0) {
            $('#exampleModal').modal('show');
            $('.modal-title-one').text('Noting selected!');
            $('.modal-title-two').show();
            $('.swichControls').hide();
            $('.modal-title-two').text('Please select user.');
            $('#close-btn').on('click', function (e) {
                e.preventDefault();
                $("#exampleModal").modal('hide');
                $('.modal-title-two').hide();
            });
            return;
        }

        if (option == 0 || option2 == 0) {
            $('#save').hide('fast');
            $('#exampleModal').modal('show');
            $('.modal-title-one').text('Noting selected!');
            $('.modal-title-two').show();
            $('.swichControls').hide();
            $('.modal-title-two').text('Please select option.');
            // $('.modal-body').hide();
            $('#close-btn').on('click', function (e) {
                e.preventDefault();
                $('.modal-body').show();
                $('.modal-title-two').hide();
            });
            return;
        }
        var selected_values = users.join(",");
        if (option == 1 || option2 == 1) {
            $.ajax({
                type: "POST",
                url: "includes/UpdateStatus.php",
                cache:false,
                data:
                    {
                        ids : selected_values,
                        status : '1'
                    },
                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if(data['success']) {
                        const updatedUsers = data.updatedUsers;
                        updatedUsers.forEach(user => {
                            console.log(user);
                            const activeColor = user.status === '1' ? 'green' : 'red';
                            const inactiveColor = user.status === '0' ? 'green' : 'red';
                            const userTr = $('#row-user-' + user.id);
                            userTr.children('#status').children('div').attr('data-active', user.status);
                            userTr.children('#status').children('div').removeClass(inactiveColor).addClass(activeColor);
                        });
                        $('#checkedAll, .checkSingle').prop("checked", false);
                        $('.form-select-two option').prop("selected", function (){
                            return this.defaultSelected;
                        });
                        $('.form-select option').prop("selected", function (){
                            return this.defaultSelected;
                        });
                        $("#exampleModal").modal('hide');
                    } else {$('#exampleModal').modal('show');
                        $('.modal-title-one').show();
                        $('.modal-title-one').text('Noting selected!');
                        $('.modal-title-two').show();
                        $('.modal-title-one').text('Please select users.');
                        // $('.modal-body').text('Please select users.');
                        $('#close-btn').on('click', function (e) {
                            e.preventDefault();
                            $("#exampleModal").modal('hide');
                            $('.modal-title-two').hide();
                        });
                    }}
            });
            return;
        }

        if (option == 2 || option2 == 2) {

            console.log(selected_values);
            $.ajax({
                method: "POST",
                url: "includes/UpdateStatus.php",
                cache:false,
                data:{
                    ids : selected_values,
                    status : '0'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if(data['success']) {
                        const updatedUsers = data.updatedUsers;
                        updatedUsers.forEach(user => {
                            console.log(user);
                            const activeColor = user.status === '1' ? 'green' : 'red';
                            const inactiveColor = user.status === '0' ? 'green' : 'red';
                            const userTr = $('#row-user-' + user.id);
                            userTr.children('#status').children('div').attr('data-active', user.status);
                            userTr.children('#status').children('div').removeClass(inactiveColor).addClass(activeColor);
                        });
                        $('#checkedAll, .checkSingle').prop("checked", false);
                        $('.form-select-two option').prop("selected", function (){
                            return this.defaultSelected;
                        });
                        $('.form-select option').prop("selected", function (){
                            return this.defaultSelected;
                        });
                        $("#exampleModal").modal('hide');
                    } else {
                        $('#save').hide('fast');
                        $('#exampleModal').modal('show');
                        $('.modal-title-one').text('Noting selected!');
                        $('.modal-title-two').show();
                        $('.modal-title-two').text('Please select records.');
                        $('.close-btn').on('click', function (e) {
                            e.preventDefault();
                            $('#exampleModal')[0].reset();
                            $('.modal-title-two').hide();
                        });
                    }
                }
            });
            return;
        }

        if (option == 3 || option2 == 3) {
            $('#exampleModal').modal('show');
            $('.modal-title-one').text('Delete records');
            $('.modal-title-two').show();
            $('.modal-title-two').text('Do You Want to Delete the Records?');
            $('#delete').show('fast');
            $('#save').hide();
            $('#update').hide();
            $('#delete').show();
            $('.form-row').hide();
            $('.swichControls').hide();
            $('#close-btn').on('click', function (e) {
                e.preventDefault();
                $("#exampleModal").modal('hide');
                $('#delete').hide();
                $('.modal-title-two').hide();

            });
            $('#delete').on('click', function (e) {
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
                            $('#delete').hide();
                            $('.modal-title-two').hide();
                            users.forEach(userId => $('#row-user-' + userId).remove());
                            $('#checkedAll, .checkSingle').prop("checked", false);
                            $('.form-select-two option').prop("selected", function (){
                                return this.defaultSelected;
                            });
                            $('.form-select option').prop("selected", function (){
                                return this.defaultSelected;
                            });
                        } else {
                            $('#save').hide('fast');
                            $('#exampleModal').modal('show');
                            $('.modal-title-one').text('Noting selected!');
                            $('.modal-title-two').show();
                            $('.modal-title-two').text('Please select records.');
                            $('.close-btn').on('click', function (e) {
                                e.preventDefault();
                                $('#exampleModal')[0].reset();
                                $('.modal-title-two').hide();
                            });
                        }
                    }
                });
            });
        }
    });

    $('#add_button, #add_button-two').on('click', function (e) {
        e.preventDefault();
        $("#idForm").attr("action", "includes/Create_user.php");
        $('.modal-title-one').text('Add user');
        restoreInput($('#idForm'));
        $('#save').show();
        $('#update').hide();
        $('#exampleModal').modal('show');
        $('.form-row').show();
        $('.swichControls').show();
        $('#close-btn').on('click', function (e) {
            e.preventDefault();
            restoreInput($('#idForm'));
            $("#exampleModal").modal('hide');
            $('.form-row').hide();
            $('.swichControls').hide();
            $('#save').val("Add").hide();
        });

    });

    $('#idForm').on('submit', function (e) {
        e.preventDefault();
        $("#idForm").attr("action", "includes/Create_user.php");
        console.log("adding user")
        $.ajax({
            url: $("#idForm").attr("action"),
            method: "POST",
            data: $("#idForm").serialize(),
            success:function (data) {
                console.log($("#idForm").serialize());
                data = JSON.parse(data);
                console.log(data);
                if(data['success']){
                    data.newUser.forEach(element => {
                        console.log(element);
                        var activecolor = element.status === '1' ? 'green' : 'red';
                        var tr = document.createElement("tr");
                        tr.setAttribute('id', 'row-user-' + element.id);
                        $('<td><input class="checkSingle" type="checkbox" id="" data-id="'+element.id+'"></td>').appendTo(tr);
                        $('<td id="firstName">'+element.firstname+'</td>').appendTo(tr);
                        $('<td id="lastName">'+element.lastname+'</td>').appendTo(tr);
                        $('<td id="role">'+element.role+'</td>').appendTo(tr);
                        $('<td id="status"><div data-active="'+element.status+'" class="circle '+activecolor+'"></div></td>').appendTo(tr);
                        $('<td style="width: 20%;"><a href="#"  class="table-link text-info update"  name="update" data-id-user="'+element.id+'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-pencil fa-stack-1x fa-inverse"></i></span></a><a href="#" class="table-link danger delete" name="delete" data-id-user="'+element.id+'"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i></span></a></td>').appendTo(tr);
                        $('.getTable').append(tr);
                    });
                    restoreInput($('#idForm'));
                    $("#exampleModal").modal('hide');
                }else{
                    alert("Error...");
                }
            }
        });
    });

    $(document).on('click', ".update", function () {
        $("#idForm").attr("action", "includes/Update.php");
        $('#exampleModal').modal('show');
        $('.modal-title-one').show();
        $('.modal-title-one').text('Edit user');
        $('.form-row').show();
        $('.swichControls').show();
        $('#idForm .firstName input[name="firstName"]').val($(this).closest('tr').find('#firstName').text());
        $('#idForm .lastName input[name="lastName"]').val($(this).closest('tr').find('#lastName').text());
        let checked = $(this).closest('tr').find('#status > div:first-child').attr('data-active');
        console.log($('#idForm .custom-control-input'));
        $('#customSwitch').prop('checked', checked === '1' ? true : false);
        $('#idForm .custom-control-label').text(checked === '1' ? 'active' : 'inactive');
        let option = $(this).closest('tr').find('#role').text();
        $('#idForm .role-select').val(option);
        $('#idForm').find("#user_id").val($(this).attr("data-id-user"));
        $('#save').hide();
        $('#update').show();
        $('#close-btn').on('click', function (e) {
            e.preventDefault();
            $('.form-row').hide();
            $('.swichControls').hide();
            $('#save').val("Add").hide();
            $("#exampleModal").modal('hide');
            $('#update').hide();
        });

        $('#update').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#idForm").attr("action"),
                method: "POST",
                data: $("#idForm").serialize(),
                success:function (data) {
                    data = JSON.parse(data);
                    if(data['success']){
                        const userData = data.updatedUser;
                        const activeColor = userData.status === '1' ? 'green' : 'red';
                        const inactiveColor = userData.status === '0' ? 'green' : 'red';
                        const userId = $('#idForm').find("#user_id").val();
                        const userTr = $('#row-user-' + userId);
                        userTr.children('#firstName').text(userData.firstname);
                        userTr.children('#lastName').text(userData.lastname);
                        userTr.children('#role').text(userData.role);
                        userTr.children('#status').children('div').attr('data-active', userData.status);
                        userTr.children('#status').children('div').removeClass(inactiveColor).addClass(activeColor);
                        $("#exampleModal").modal('hide');
                    } else {
                        alert("Error...");
                    }
                }
            });
        });
    });


    $(document).on('click', ".delete", function () {
        var userId = $(this).attr("data-id-user");
        console.log(userId);
        $('#exampleModal').modal('show');
        $('.modal-title-one').show();
        $('.modal-title-one').text('Delete records');
        $('.modal-title-two').show();
        $('.modal-title-two').text('Do You Want to Delete the Records?');
        $('#delete').show();
        $('.form-row').hide();
        $('#update').hide();
        $('.swichControls').hide();
        $('#save').val("Add").hide();
        $('#close-btn').on('click', function (e) {
            e.preventDefault();
            $("#exampleModal").modal('hide');
            $('#delete').hide();
            $('.modal-title-two').hide();
        });
        $('#delete').on('click', function (e) {
            e.preventDefault(e);
            $.ajax({
                url: "includes/Delete.php",
                method: "POST",
                data: {id: userId},
                success:function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if (data['success']) {
                        $('#row-user-' + userId).remove();
                        $("#exampleModal").modal('hide');
                        $('#delete').hide();
                        $('.modal-title-two').hide();
                    } else {
                        alert("Error...");
                    }
                }
            });
        });
    });
});



