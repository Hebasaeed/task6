<?php

    function Clean($input,$flag1,$flag2){
        $input =  trim($input);
        return $input;
    if($flag1==1){
   $input =  filter_var($input,FILTER_SANITIZE_STRING);  
    return $input;
    }
    elseif($flag2==2){
        $input= filter_var($input,FILTER_SANITIZE_DATE);
        return $input;
    }
}

    ?>