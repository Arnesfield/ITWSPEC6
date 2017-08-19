<?php

$arr = preg_split('/\s+/', $_POST['text']);
sort($arr);

$arr = array_count_values($arr);

echo json_encode(array('val' => $arr));

?>