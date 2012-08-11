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
    
<div class="row">
<div class="span9">
<div class="col-main">
<?php $this->layout->get('col-main') ?>
</div>
</div>
<div class="span3">
<div class="col-left">
<?php $this->layout->get('col-right') ?>
</div>
</div>
</div>
    
</div>
</div>
<footer>
<?php echo $this->layout->block('layout/page/html/footer') ?>
</footer>
</body>
</html>