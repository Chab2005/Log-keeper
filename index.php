<?php
require_once './components/boilerplate/doctype.php';
require_once './components/boilerplate/body.php';
require_once './components/boilerplate/footer.php';
require_once './components/boilerplate/header.php';

$title = "BOILERPLATE";

makeDoctype(
     $title , 
     [
      'links' => [
            "./public/stylesheets/custom/index.css",
       ]
     ]
);

makeHeader();
makeMain();
makeFooter();
?>

