<?php function calcularFolha($clt, $salario) {
    if ($clt == "sim") {
        if ($salario <= 1302.00) {
            $inss = $salario * 0.075;
        } else if ($salario <= 2571.29) {
            $inss = $salario * 0.09;
        } else if ($salario <= 3856.94) {
            $inss = $salario * 0.12;
        } else if ($salario <= 7507.49) {
            $inss = $salario * 0.14;
        } else {
            $inss = 7507.49 * 0.14; // o valor máximo para o cálculo do INSS é R$ 7507,49
        }
        
    }
    return $inss;
}?>
