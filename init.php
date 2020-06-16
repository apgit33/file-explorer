<?php

// create the main directory one level forward from the main script
$home_dir = 'home';
if (!is_dir($home_dir)){ mkdir("home");}
//
chdir(getcwd() . DIRECTORY_SEPARATOR . $home_dir);
//
$init_dir = getcwd();

// create recycle bin directory
$recycle_bin__dir = 'recycle_bin';
if (!is_dir($recycle_bin__dir)) {mkdir("recycle_bin");}

?>