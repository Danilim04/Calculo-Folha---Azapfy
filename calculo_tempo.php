<?php 
class CalcularTempo{function CalcularTempo ($cargahoraria,$diastrabalhados){
    $jornadasemanal = $cargahoraria * 5;
    $jornadaanual = $cargahoraria * $diastrabalhados;
    return $jornadaanual;
return $jornadasemanal;
}
}
?>

