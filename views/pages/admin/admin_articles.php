<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-50">
            <h2 class="text-center mt-4">Articles</h2>
            <hr class="mb-4" />

            <div class="container" id="articles-table">

            </div>
        </div>
    </div>

    <div class="row update-article">
        <div class="col-md-6 mx-auto">
            <form action="models/articles/update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hiddenArticleId" id="hiddenArticleId" />
                <div class="form-group">
                    <input type="text" id="articleName" name="articleName" placeholder="Article name" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="number" id="articlePrice" name="articlePrice" placeholder="Article price" class="form-control" />
                </div>
                <input type="hidden" name="originalImage"/>
                <input type="hidden" name="newImage"/>
                <img src="" alt="" id="showImage"/>
                <div class="form-group">
                    <label for="articleImage">Image: &nbsp; </label>
                    <input type="file" name="articleImage" id="articleImage" />
                </div>
                <div class="form-group">
                    <textarea name="articleDescription" id="articleDescription" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <input type="date" name="updateDate" id="updateDate" class="form-control"/>
                </div>
                <div class="form-group">
                    <select name="ddlCategory" id="ddlCategory" class="form-control w-50">
                        <option value="0">Choose</option>
                        <?php
                        $categories = getCategories();
                        foreach ($categories as $category) :
                        ?>
                            <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" value="Update" class="btn btn-success" name="btnUpdateArticle" />
            </form>
            <div class="update-message">
                <?php
                if (isset($_SESSION["update-article-msg"])) {
                    echo $_SESSION["update-article-msg"];
                    unset($_SESSION["update-article-msg"]);
                }
                ?>
            </div>
        </div>
    </div>
</div>