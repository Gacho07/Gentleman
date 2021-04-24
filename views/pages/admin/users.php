<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-50">
            <h2 class="text-center mt-4">Users</h2>
            <hr class="mb-4" />
            <div class="container" id="users-table">

            </div>
            <a href="models/users/export_excel.php" class="btn btn-info ml-3">Export To Excel</a>
        </div>
    </div>

    <div class="row update-user">
        <div class="col-md-6 mx-auto">
            <form action="models/users/update.php" method="POST">
                <input type="hidden" name="tbHiddenID" id="tbHiddenId" />
                <div class="form-group">
                    <input type="text" name="tbFirstName" id="tbFirstName" placeholder="First Name" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="text" name="tbLastName" id="tbLastName" placeholder="Last Name" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="email" name="tbEmail" id="tbEmail" placeholder="Email" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="password" name="tbPassword" id="tbPassword" placeholder="Password" class="form-control" />
                </div>
                <div class="form-group">
                    <select name="ddlRole" id="ddlRole" class="form-control">
                        <?php $roles = getAllRoles();
                        foreach ($roles as $role) : ?>
                            <option value="<?= $role->role_id ?>"><?= $role->role_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="date" name="tbRegDate" id="tbRegDate" placeholder="Registration Date" class="form-control" />
                </div>
                <input type="submit" value="Update" class="btn btn-success" name="btnUpdateUser" />
            </form>

            <div class="update-message">
                <?php
                if (isset($_SESSION["update-message"])) {
                    echo ($_SESSION["update-message"]);
                    unset($_SESSION["update-message"]);
                }
                ?>
            </div>

        </div>
    </div>

</div>