<!doctype html>
<html lang="en">
<head>
<?php echo $this->layout->block('layout/page/html/head') ?>
</head>
<body class="<?php echo $body_class ?>">
<header>
<?php echo $this->layout->block('layout/page/html/header') ?>
</header>
<div role="main" class="page">
<div class="main container">
<div class="col-main">
<?php $this->layout->get('col-main') ?>
</div>
</div>
</div>
<footer>
<?php echo $this->layout->block('layout/page/html/footer') ?>
</footer>
</body>
</html>