<?php 

error_reporting(E_ALL); ini_set('display_errors', 1);

/***********************************************************************************
  
Counting Things
  
************************************************************************************/

$video = $_POST["video"];
$meta = $_POST["meta"];

// The meta file.
$meta_file = '../../assets/works/meta/' . $video . '-' . $meta . '.txt';

// The meta count.
$meta_count = file_get_contents($meta_file);

// Increment the meta.
file_put_contents($meta_file, ++$meta_count);

?>