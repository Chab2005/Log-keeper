<?php
function makeDoctype($pageTitle, $data) { ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="icon" href="./YOUR_ICON">
    
    <?php  foreach ($data['links'] as $link) { ?>
        <link href="<?=  $link  ?>" rel="stylesheet">
    <?php } ?>
    
</head>
<body>
<?php } ?>



