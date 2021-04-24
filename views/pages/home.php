<div id="myCarousel" class="carousel slide mb-50" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php
        $slider = getSlider();
        for ($i = 0; $i < count($slider); $i++) :
        ?>
            <?php if ($i == 0) : ?>
                <li data-target="#myCarousel" data-slide-to="<?= $i ?>" class="active"></li>
            <?php else : ?>
                <li data-target="#myCarousel" data-slide-to="<?= $i ?>"></li>
            <?php endif; ?>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
        <?php
        $num = 0;
        foreach ($slider as $slide) :
            if ($num == 0) :
        ?>
                <div class="carousel-item active">
                    <a href="index.php?page=articles">
                        <img class="d-block w-100" src="<?= $slide->image ?>" alt="<?= $slide->alt ?>" />
                    </a>
                </div>
            <?php else : ?>
                <div class="carousel-item">
                    <a href="index.php?page=articles">
                        <img class="d-block w-100" src="<?= $slide->image ?>" alt="<?= $slide->alt ?>" />
                    </a>
                </div>
        <?php endif;
            $num++;
        endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section id="separated-articles">
    <div class="container">
        <h2 class="text-center mb-4">We Separate</h2>

        <div class="row">
            <?php
            $articles = getFeaturedArticles();
            foreach ($articles as $article) :
            ?>
                <div class="col-sm-4 col-xs-12">
                    <img src="<?= $article->original_image ?>" alt="<?= $article->alt ?>" class="img-fluid d-block mx-auto" />
                    <div class="text-center">
                        <p><?= $article->article_name ?></p>
                        <p><?= $article->price ?> &euro;</p>
                        <p><?= $article->description ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>