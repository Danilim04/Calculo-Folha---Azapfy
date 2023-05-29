<?php 
function calcularInsalubridade($insalubridade,$nivelinsalubridade) {
    
    $conta = 0;
    if($insalubridade=="sim"){
        if($nivelinsalubridade=="alto"){
            $conta = 1380.60 * 0.4; 
        }
        if($nivelinsalubridade=="medio"){
            $conta = 1380.60 * 0.2;
        }
        if($nivelinsalubridade=="minimo"){
            $conta = 1380.60 * 0.1;
        }
         
    }
        return $conta;
}

?>