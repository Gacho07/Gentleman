<header id="header-dashboard" class="mb-4">
    <div class="row py-2">
        <div class="col-md-10">
            <h1><i class="fa fa-cog"></i> Dashboard <small>Manage Your Site</small></h1>
        </div>
        <div class="col-md-2">
            <div class="dropdown create">
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Create Content
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a type="button" data-toggle="modal" data-target="#add-article">Add Article</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>


<section id="main-dashboard">
    <div class="row">
        <div class="col-md-3 mt-4">
            <div class="list-group">
                <a href="index.html" class="list-group-item bg-warning">
                    <i class="fa fa-cog"></i> Dashboard
                </a>
                <a href="index.php?page=users" class="list-group-item"> Users <i class="fa fa-user"></i></a>
                <a href="index.php?page=admin_articles" class="list-group-item"> Articles <i class="fa fa-tshirt"></i></a>
                <a href="index.php?page=statistics" class="list-group-item"> Statistics <i class="fa fa-bar-chart"></i></a>
                <a href="index.php?page=orders" class="list-group-item"> Orders <i class="fa fa-shopping-cart"></i></a>
            </div>
        </div>
        <div class="col-md-9 mx-auto card p-0 mt-4">
            <div class="card-title bg-warning">
                <h3 class="card-title pl-3">Website Overview</h3>
            </div>
            <div class="card-group text-center">
                <div class="col-lg-3">
                    <div class="card my-4">
                        <div class="card-body">
                            <a href="index.php?page=users">
                                <h2>
                                    <?php $users = countUsers(); ?>
                                    <?= $users->users ?>
                                    <i class="fa fa-user"></i>
                                </h2>
                                <h5 class="card-title">Users</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card my-4">
                        <div class="card-body">
                            <a href="index.php?page=admin_articles">
                                <h2>
                                    <?php $articles = getNumberOfArticles(); ?>
                                    <?= $articles->articlesCount ?>
                                    <i class="fa fa-tshirt"></i>
                                </h2>
                                <h5 class="card-title">Articles</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card my-4">
                        <div class="card-body">
                            <a href="index.php?page=statistics">
                                <h2><i class="fa fa-bar-chart"></i></h2>
                                <h5 class="card-title">Statistics</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card my-4">
                        <div class="card-body">
                            <a href="index.php?page=orders">
                                <h2><?php $orders = countOrders(); ?>
                                    <?= $orders->orders ?>
                                    <i class="fa fa-shopping-cart"></i>
                                </h2>
                                <h5 class="card-title">Orders</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mt-4">
            <div class="card">
                <img class="card-img-top" src="assets/img/fa-user.png" alt="Card image cap" />
                <div class="card-body">
                    <h4 class="card-text">Number of currently logged users: <?= countLoggedUsers() ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-9 mx-auto card p-0 mt-4">
            <div class="card-title bg-warning">
                <h3 class="card-title pl-3">Latest Users</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                    </tr>

                    <?php
                    $latest_users = getLatestUsers();
                    foreach ($latest_users as $user) :
                    ?>
                        <tr>
                            <td><?= $user->first_name . " " . $user->last_name ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->registration_date ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="add-article" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="models/articles/insert.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Article</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="articleName" id="articleName">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="articleDescription" id="articleDescription"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="articlePrice" id="articlePrice">
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file" name="fileArticleImage">
                    </div>
                    <div class="form-group">
                        <label>Alt</label>
                        <input type="text" class="form-control" name="articleImageAlt" id="articleImageAlt">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="ddlCategory" id="ddlCategory" class="form-control">
                            <option value="0">Choose</option>
                            <?php
                            $categories = getCategories();
                            foreach ($categories as $category) :
                            ?>
                                <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="btnInsertArticle" id="btnInsertArticle">Save Changes</button>

                    <?php
                    if (isset($_SESSION["upload-error"])) {
                        $upload_error = $_SESSION["upload-error"];
                        foreach ($upload_error as $error) {
                            echo "<p>$error</p>";
                        }
                        unset($_SESSION["upload-error"]);
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>