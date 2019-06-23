
<?php require_once("../../private/initialize.php"); ?>
<?php require_admin_login(); ?>
<?php include(LAYOUT_PATH . "/header.php"); ?>
<link rel="stylesheet" href="../../public/css/admin_index_style.css">

</head>
<body>
<?php include(LAYOUT_PATH . "/nav.php"); ?>

<?php
$totalRecords = mysqli_num_rows(get_users());

?>
<br>

    <a class="addUser" href="add_user.php" target="_blank">
    &nbsp;&nbsp;<button class="btn btn-primary">
        <i class="fa fa-plus">
            Add User
        </i>
    </button>
    </a>
<br><br>

<div class="form-group  col-lg-4 float-left">
    <span>
       Show:
    </span>
    <select id="entries" class="custom-select col-lg-3">
        <option value="10" selected>10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="all">all records</option>
    </select>
    <span>
        entiries
     </span>
</div>

    <i class="fa fa-arrow-up">

    </i>
    <i class="fa fa-arrow-down">

    </i>
<div class="form-group row float-right">
    <label class="col-form-label">Search</label>
    <div class="col-lg-9">
        <input type="text" class="form-control" id="searchInput">
    </div>
</div>


<?php
$users = get_users_default_limit();
?>
<input type="hidden" value="<?php echo $totalRecords?>" id="totalRecords">
<div id="freshItems">
    <?php if (isset($_SESSION["message"])) { ?>
        <div class="mess">
            <?php
            get_and_clear_session_error('message');
            ?>
        </div>
    <?php } ?>
<table class="table table-hover" >
    <thead class="thead-dark">
    <tr id="price">
        <th id="id" scope="col">id</th>
        <th id="name" scope="col">name</th>
        <th id="email" scope="col">email</th>
        <th id="birthdate" scope="col">birthdate</th>
        <th  scope="col">status
            <select id="statusFilter" class="custom-select col-lg-3">
                <option value="all" selected>all</option>
                <option value="ACCEPTED">ACCEPTED</option>
                <option value="BLOCKED">BLOCKED</option>
            </select>
        </th>
        <th  scope="col">action</th>
    </tr>
    </thead>

    <tbody id="tableData" >
        <?php while($user = mysqli_fetch_assoc($users)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($user["id"]) ?></td>
                <td><?php echo htmlspecialchars($user["name"]) ?></td>
                <td><?php echo htmlspecialchars($user["email"]) ?></td>
                <td><?php echo format_birthdate(htmlspecialchars($user["birthdate"])) ?></td>
                <td><span class="status
                   <?php if ($user["status"] == "ACCEPTED"){
                    echo " green";
                   } else{
                       echo " red";
                   } ?>">&nbsp;<?php echo htmlspecialchars($user["status"]) ?>&nbsp</span>
                </td>
                <td>
                    <button class="btn btn-primary edit" data-id="<?php echo $user["id"] ?>">
                        <i class="fa fa-edit">
                            edit
                        </i>
                    </button>
                    <button class="btn btn-danger delete" data-id="<?php echo $user["id"] ?>">
                        <i class="fa fa-trash">
                            delete
                        </i>
                    </button>
                    <a href="show.php?id=<?php echo urldecode(htmlspecialchars($user['id'])) ?>" target="_blank">
                        <button class="btn btn-dark" id="show">
                            <i class="fa fa-search">
                                show
                            </i>
                        </button>
                    </a>
                    <input type="hidden" id="hidID" value="<?php echo $user["id"];?>">
                </td>

            </tr>
        <?php } ?>
    </tbody>

</table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>

            </div>

            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                <button type="button" class="btn btn-danger" id="delete" style="display: none;">Delete</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="addBtn" style="display: none;">Add</button>
            </div>
        </div>
    </div>
</div>
</div>

<nav aria-label="Page navigation example" class="float-right">
    <ul class="pagination">
        <li class='page-item pre-page'><a class='page-link' href='javascript:void(0)'>Previous</a></li>
        <li class='page-item next-page'><a class='page-link' href='javascript:void(0)'> Next</a></li>
    </ul>
</nav>

<?php include(LAYOUT_PATH . "/footer.php"); ?>
