
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<hr>
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-md-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">add</button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form id="idForm" action="includes/Create_user.php" method="POST">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                                <label for="firstName">First name</label>
                                                                <input type="text" class="form-control" name="firstName" required>
                                                            </div>
                                                        <div class="col-md-4 mb-3">
                                                                <label for="lastName">Last name</label>
                                                                <input type="text" class="form-control" name="lastName" required>
                                                            </div>
                                                    </div>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="status" id="customSwitch">
                                                        <label class="custom-control-label" for="customSwitch">active</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>

                                    </th>
                                    <th scope="col">
                                        <select class="form-select" aria-label="Default select example">
                                    <option selected>1. Please select</option>
                                    <option value="1">2. Set active</option>
                                    <option value="2">3. Set not active</option>
                                    <option value="3">4. Delete</option>
                                </select>
                                        <button type="button" class="btn btn-warning btn-filter" data-target="ok">ok</button>
                                    </th>
                                </tr>
                                <tr class="showUser">
                                    <th scope="col"><input type="checkbox" id="checkedAll"></th>
                                    <th scope="col">User</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                    <input class="checkSingle" type="checkbox" value="1" id="">
                                </th>
                                    <td>
                                        <a href="#" class="text-left">Full name 1</a>
                                    </td>
                                    <td class="text-left">Member</td>
                                    <td>
                                        <span class="label label-default">pending</span>
                                    </td>
                                </tr>
                                <tr>
                                <th scope="row">
                                    <input class="checkSingle" type="checkbox" value="2" id="">
                                </th>
                                <td>
                                    <a href="#" class="text-left">Full name 2</a>
                                </td>
                                <td><span class="user-subhead">Admin</span></td>
                                <td>
                                    <span class="label bg-success">Active</span>
                                </td>

                            </tr>
                                <tr>
                                <th scope="row">
                                    <input class="checkSingle" type="checkbox" value="3" id="">
                                </th>
                                <td>
                                    <a href="#" class="text-left">Full name 3</a>
                                </td>
                                <td><span class="user-subhead">Member</span></td>
                                <td>
                                    <span class="label label-danger">inactive</span>
                                </td>

                            </tr>
                            </tbody>
                            <tr>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src="scripts/scripts.js"></script></body>
</html>