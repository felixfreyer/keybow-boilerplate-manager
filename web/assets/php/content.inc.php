<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate = new Boilerplate('');
$categoriesArray = $boilerplate->getAllCategories();
$first = true;
foreach ($categoriesArray as $categoryArray) {
    $boilerplate = new Boilerplate($categoryArray['category']);
    if ($first) {
        $first = false;
        ?><div id="<?php echo  $boilerplate->getCategory(); ?>" class="content visible"><?php
    } else {
        ?><div id="<?php echo  $boilerplate->getCategory(); ?>" class="content"><?php
    }
    ?>
            <div class="box">
                <table class="table table-dark">
                    <tbody>
                        <?php echo $boilerplate->getBoilerplates(); ?>
                    </tbody>
                </table>
                <div class="add">
                    <i class="fas fa-plus <?php echo  $boilerplate->getCategory(); ?>" data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#<?php echo  $boilerplate->getCategory(); ?>addModal'></i>
                </div>
                <!-- Modals -->
                <div class="modal fade" id="<?php echo  $boilerplate->getCategory(); ?>addModal" tabindex="-1" role="dialog" aria-labelledby="<?php echo  $boilerplate->getCategory(); ?>addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo  $boilerplate->getCategory(); ?>addModalLabel">Add <?php echo  $boilerplate->getCategory(); ?> Boilerplate</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_name" name="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_name" placeholder="Name">
                                    </div>                   
                                    <div class="form-group">
                                        <textarea class="form-control" id="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_code" name="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_code" rows="5" placeholder="Code"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" class="form-control" id="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_category" name="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_category" value="php">
                                    <button type="button" class="btn btn-secondary" id="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_close" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" name="submit" id="<?php echo  $boilerplate->getCategory(); ?>_boilerplate_save" onclick="saveBoilerplate();" data-dismiss="modal">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php echo $boilerplate->getBoilerplatesModals(); ?>
            </div>
        </div>
    <?php
}