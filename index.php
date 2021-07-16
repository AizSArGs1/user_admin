
<?php
/**
 * @var string $result
 *
 */
require_once (__DIR__.'/includes/Read_user.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main-box-body clearfix">
                    <button type="button" id="add_button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal">add</button>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>1. Please select</option>
                        <option value="1">2. Set active</option>
                        <option value="2">3. Set not active</option>
                        <option value="3">4. Delete</option>
                    </select>
                    <button type="button" id="btnOk" class="btn btn-warning btn-filter mt-2" data-target="ok">ok</button>
                    <table class="table table-striped mt-2">
                        <thead class="thead-dark">
                        <tr class="showUser">
                            <th><input type="checkbox" id="checkedAll"></th>
                            <th><span>Name</span></th>
                            <th><span></span></th>
                            <th><span>Role</span></th>
                            <th><span>Status</span></th>
                            <th><span>Options</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($result as $res){?>
                            <tr>
                                <td><input class="checkSingle" type="checkbox" value="1" id="" data-id="<?php echo $res->id; ?>"></td>
                                <td class="user_id" data-id="<?php echo $res->id; ?>" hidden><?php echo $res->id; ?></td>
                                <td id="firstName"><?php echo $res->firstname; ?></td>
                                <td id="lastName"><?php echo $res->lastname; ?></td>
                                <td id="role"><?php echo $res->role; ?></td>
                                <td id="status"><div data-active="<?= $res->status ?>" class="circle <?= $res->status == 1 ? 'green' : 'red' ?>"></div></td>

                                <td style="width: 20%;">
                                    <a href="#"  class="table-link text-info update"  name="update" data-id-user="<?php echo $res->id; ?>">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="#" class="table-link danger delete" name="delete" data-id-user="<?php echo $res->id; ?>">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <button type="button" id="add_button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal">add</button>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>1. Please select</option>
                        <option value="1">2. Set active</option>
                        <option value="2">3. Set not active</option>
                        <option  value="3">4. Delete</option>
                    </select>
                    <button type="button" id="btnOk" class="btn btn-warning btn-filter mt-2" data-target="ok">ok</button>
                </div>
                <div class="modal fade hide" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="idForm" method="POST">
                            <input name="id" id="user_id" type="hidden" value="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3 firstName">
                                            <label for="firstName">First name</label>
                                            <input type="text" class="form-control" name="firstName" required>
                                        </div>
                                        <div class="col-md-4 mb-3 lastName">
                                            <label for="lastName">Last name</label>
                                            <input type="text" class="form-control" name="lastName" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-switch col-md-4 mb-3">
                                            <input type="checkbox" class="custom-control-input" name="status" id="customSwitch">
                                            <label class="custom-control-label" for="customSwitch">inactive</label>
                                        </div>
                                        <div>
                                            <select class="form-select col-md-4 mb-3" name="role" aria-label="Default select example">
                                                <option value="User" selected> User</option>
                                                <option value="Admin"> Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="save" class="btn btn-primary">Save changes</button>
                                </div>
                        </form>
                    </div>
                </div>
                <!--Delete Modal-->
                <form class="modal" id="delete" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-dark">Delete Record</h3>
                            </div>
                            <div class="modal-body">
                                <p> Do You Want to Delete the Record ?</p>
                                <button type="submit" class="btn btn-success" id="btn_delete_record">Delete Now</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="scripts/scripts.js"></script>
</body>
</html>