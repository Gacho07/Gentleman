<div class="container">
    <h2 class="text-center my-4"><?= $article->article_name ?></h2>
    <hr />

    <div class="row one-article-div">
        <div class="col-xs-12 col-md-6 text-center">
            <img src="<?= $article->original_image ?>" alt="<?= $article->alt ?>" class="img-fluid" />
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="about-text">
                <h3>Price</h3>
                <p><?= $article->price ?> &euro;</p>
                <h3>Description</h3>
                <p><?= $article->description ?></p>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']->role_name == 'user') : ?>
                    <button type="button" data-id=<?= $article->article_id ?> class="btn btn-success add-to-cart-btn">Add To Cart <i class="fa fa-shopping-cart"></i></button>
                <?php else : ?>
                    <p class="text-warning">If you want to buy, you must login first.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>