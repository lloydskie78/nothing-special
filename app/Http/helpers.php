<?php

function selectArray($model,$name,$value){
    $select = [];
    foreach($model as $data){
        $select[$data->$value] = $data->$name;
    }

 return $select;
}

if (!function_exists (  'GenerateUlMarkUp' )){
    function GenerateUlMarkUp(string $data){
        $cleanDesc = preg_replace('/\s+/', ' ',$data);
        $noBullets = explode('•',$cleanDesc);
        $noNull = array_filter($noBullets,function($var){
            return $var != "";
        });
        $liTag = array_map(function($el){
            $removedSpaces = rtrim(ltrim($el));
            $liTag = "<li class='career__qual-item'>$removedSpaces</li>";
            return $liTag;
        },$noNull);

        $implodedLi = implode('',$liTag);

//        $ulMarkup = "<ul class='careers__qual'>$implodedLi</ul>";

        return $implodedLi;
    }
}
?>