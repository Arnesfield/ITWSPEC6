<?php

$arr = array_count_values(preg_split('/\s+/', $_POST['text']));
ksort($arr);

echo json_encode($arr);

?>