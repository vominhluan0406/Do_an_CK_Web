<?php
    $array = array(
        'freetuts',
        'freetuts',
        'thehalfheart',
        'freetuts.net',
        'freetuts.net',
        'freetuts'
    );
     
    echo '<pre>';
    $aa=array_count_values($array);
    print_r($aa);
?>