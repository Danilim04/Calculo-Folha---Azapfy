<?php 
 function CalcularFgts ($clt,$salario){
    
    if ($clt == "sim") {
        $fgts = $salario * 0.8;
    }
    return $fgts;
 }
?>