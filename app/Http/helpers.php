<?php

function selectArray($model,$name,$value){
    $select = [];
    foreach($model as $data){
        $select[$data->$value] = $data->$name;
    }

 return $select;
}

?>