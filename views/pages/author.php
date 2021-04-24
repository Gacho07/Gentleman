<div class="container">
    <h2 class="text-center mt-4">About Author</h2>
    <div class="row">
        <div class="col text-center author-info">
            <?php $author = getAuthor();
            foreach ($author as $a) : ?>
                <a href="#">
                    <img src="<?= $a->image ?>" alt="<?= $a->alt ?>" class="img-fluid" />
                </a>
                <p><?= $a->first_name . " " . $a->last_name ?></p>
                <p>Index Number: <strong><?= $a->index_number ?></strong></p>
                <p><?= $a->description ?></p>
            <?php endforeach; ?>

            <a href="models/export_word.php" class="btn btn-info">Export To Word</a>
        </div>
    </div>
</div>