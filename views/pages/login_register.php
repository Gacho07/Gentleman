<div class="container login-container">
    <div class="row">
        <div class="col-lg-6">
            <form action="models/login.php" method="POST" onSubmit="return checkInputs();" id="form-submit">
                <fieldset>
                    <div id="legend">
                        <legend>Login</legend>
                    </div>
                    <div class="control-group">
                        <div class="form-group">
                            <input type="email" id="email" name="tbEmail" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group">
                            <input type="password" id="password" name="tbPassword" class="form-control" placeholder="Password" />
                        </div>
                    </div>
                    <div class="control-group">
                        <input type="submit" value="Login" name="btnLogin" id="btnLogin" class="btn btn-success" />
                    </div>
                </fieldset>
            </form>

            <div class="errors-response">
                <?php
                if (isset($_SESSION["login_errors"])) {
                    $error = $_SESSION["login_errors"];
                    echo "<p>$error</p>";
                    unset($_SESSION["login_errors"]);
                }
                ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div id="register-form">
                <form class="form-horizontal">
                    <fieldset>
                        <div id="legend">
                            <legend>Register</legend>
                        </div>
                        <div class="control-group">
                            <div class="form-group">
                                <input type="text" id="tbFirstName" class="form-control" placeholder="Marko" />
                                <p class="help-block">First name must start uppercase, person can have multiple first names.</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group">
                                <input type="text" id="tbLastName" class="form-control" placeholder="Jackson" />
                                <p class="help-block">Last name must start uppercase, person can have multiple last names.</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group">
                                <input type="email" id="tbEmail" class="form-control" placeholder="example@gmail.com" />
                                <p class="help-block">Email must be in valid form.</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group">
                                <input type="password" id="tbPassword" class="form-control" placeholder="Password363" />
                                <p class="help-block">Password must contain at least one uppercase letter and number. Min length is 8 characters.</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group">
                                <button type="button" id="btnRegister" class="btn btn-success">Register</button>
                            </div>
                            <div id="feedback" class="text-danger"></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>