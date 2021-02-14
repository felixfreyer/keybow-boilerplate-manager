<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate = new Boilerplate('');
$categoriesArray = $boilerplate->getAllCategories();
$first = true;
?>
<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php
    foreach ($categoriesArray as $categoryArray) {
        $boilerplate = new Boilerplate($categoryArray['category']);
        if ($first) {
            $first = false;
            ?><li class="nav-item active"><?php
        } else {
            ?><li class="nav-item"><?php
        }
        ?>
          <a class="nav-link" href="#<?php echo  $boilerplate->getCategory(); ?>"><?php echo  $boilerplate->getCategory(); ?></a>
        </li>
        <?php
    }
    ?>
    </ul>
  </div>
  <div class="glow" style="left: 0%; width: 3%;"></div>
  <div class="glow" style="left: 35%; width: 10%;"></div>
  <div class="glow blink" style="left: 47%; width: 2%;"></div>
  <div class="glow" style="left: 50%; width: 6%;"></div>
  <div class="glow blink" style="right: 12%; width: 2%;"></div>
</nav>