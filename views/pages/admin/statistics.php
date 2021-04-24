<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center mt-4">Page Traffic Statistics <br> <small>(Last 24 hours)</small></h2>
            
            <hr class="mb-4" />
            <div class="container" id="statistics-div">
                <table class="table table-striped table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <?php foreach (getAllPages() as $name) : ?>
                                <td><?= $name ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach (getPageTrafficDate() as $percentage) : ?>
                                <td><?= $percentage ?>%</td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>