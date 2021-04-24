<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3 text-center">
            <form action="" method="GET" class="boxed-form">
                <div id="filter-div" class="toggle-menu">
                    <p>Category</p>
                    <select name="ddlCategory" id="ddlCategory" class="custom-select">
                        <option value="0">Choose</option>
                        <?php
                        $categories = getCategories();
                        foreach ($categories as $category) :
                        ?>
                            <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                        <?php endforeach; ?>
                    </select>

                    <p>Search</p>
                    <div class="form-group">
                        <input type="text" class="form-control" id="search-articles" placeholder="Search" />
                    </div>

                    <p>Sort by price</p>
                    <select name="ddlSort" id="ddlSort" class="custom-select">
                        <option value="0">Choose</option>
                        <option value="1">Ascending</option>
                        <option value="2">Descending</option>
                    </select>
                </div>
            </form>
        </div>

        <div id="all-articles" class="col-lg-9">

        </div>

        <div id="pagination">
            <ul id="pagination-list">

            </ul>
        </div>
    </div>
</div>