<?php 
 function Calculo_irrf ($salario,$inss,$clt) {
    $salarioBase = $salario - $inss;
    $aliquota = 0;
    $deducao = 0;
   
    if ($clt == "sim") {
        if ($salarioBase <= 1903.98) {
            $aliquota = 0;
            $deducao = 0;
        } else if ($salarioBase <= 2826.65) {
            $aliquota = 0.075;
            $deducao = 142.80;
        } else if ($salarioBase <= 3751.05) {
            $aliquota = 0.15;
            $deducao = 354.80;
        } else if ($salarioBase <= 4664.68) {
            $aliquota = 0.225;
            $deducao = 636.13;
        } else {
            $aliquota = 0.275;
            $deducao = 869.36;
        }
   
        $irrf = ($salarioBase * $aliquota) - $deducao;
   
        if ($irrf < 0) {
            $irrf = 0;
        }
        
    
    }
    return $irrf;
}
    
 
?>