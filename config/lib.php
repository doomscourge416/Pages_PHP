<?php

function getPage(array $pages) {
    $pageNumber = 1;

    if(!empty($_GET['page'])){
        $pageNumber = (int) $_GET['page'];  // переводим GET['page'] в int и передаем это число в $pageNumber
    }

    if(empty($pages[$pageNumber])){
        $pageNumber = 1;
    }

    return $pages[$pageNumber];
}

?>