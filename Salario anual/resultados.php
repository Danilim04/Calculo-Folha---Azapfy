<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" type="text/css" href="style_resultados.css">
</head>

<body>
    <?php
    //Pegar os dados
    $nome = $_POST["name"];
    $cargo = $_POST["cargo"];
    $clt = $_POST["clt"];
    $salario = $_POST["salario"];
    $diastrabalhados = $_POST["diastrabalhados"];
    $ano = $_POST["ano"];
    $cargahoraria = $_POST["cargahoraria"];
    $periculosidade = $_POST["periculosidade"];
    $insalubridade = $_POST["insalubridade"];
    $nivelinsalubridade = $_POST["nivelinsalubridade"];
    $valetransporte = $_POST["valetransporte"];
    $valordatarifa = $_POST["valordatarifa"];
    $descontotransporte = $_POST["descontotransporte"];
    $valordescontotrasnporte = $_POST["valordescontotrasnporte"];
    $valealimentacao = $_POST["valealimentacao"];
    $valorconsumido = $_POST["valorconsumido"];
    $desconto = $_POST["desconto"];
    $valordesconto = $_POST["valordesconto"];
    

    //clt
    if($clt=="sim"){
        $cltresposta = "O trabalhador é CLT";
    }
    else{
        $cltresposta =  "O trabalhador não é CLT";
    }
    
    //calcular jordana de tempo
    $jornadasemanal = $cargahoraria * 5;
    $jornadaanual = $cargahoraria * $diastrabalhados;

    //calculo fgts
    if ($clt == "sim") {
        $fgts = $salario * 0.08;
        $fgts_anual = $fgts * 12;
    }
    else if ($clt=="nao"){
        $fgts = "Não possui, pois não é clt";
        $fgts_anual = "Não possui, pois não é clt";
    }
    
    //calculo inss
    if ($clt == "sim") {
        if ($salario <= 1302.00) {
            $inss = $salario * 0.075 ;
        } else if ($salario <= 2571.29) {
            $inss = $salario * 0.09;
        } else if ($salario <= 3856.94) {
            $inss = $salario * 0.12;
        } else if ($salario <= 7507.49) {
            $inss = $salario * 0.14;
        } else {
            $inss = 7507.49 * 0.14; // o valor máximo para o cálculo do INSS é R$ 7507,49
        }
        
        $inss_anual = $inss * 12;
              
    }
    else if ($clt=="nao"){
        $inss = "Não possui isss, pois não é clt";
        $inss_anual = "Não possui isss, pois não é clt";
    }

    //calculo irrf
   
    

    if ($clt == "sim") {

        $salarioBase = $salario  - $inss ;
        $aliquota;
        $deducao;
      
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
        $irrf_anual = $irrf * 12;

        if ($irrf <= 0) {
            $irrf = 0;
        }
        if ($irrf==0){
            $irrf = "Salário abaixo do valor mímimo";
        }
        if ($irrf_anual==0){
            $irrf_anual = "Salário abaixo do valor mímimo";
        }
    }
    if ($clt=="nao"){
    $irrf = "Não possui irrf, pois não é clt";
    $irrf_anual = "Não possui irrf, pois não é clt";
   }
    
                
        //calculo vale alimentação
        if ($valealimentacao == "sim"){
            $calculo_alimentacao = ($valorconsumido/100) * $salario;
            $valealimentacao_anual =  $calculo_alimentacao * 12;
            if ($desconto == "sim"){
                $calculo_alimentacao_desconto = ($valordesconto/100) * $salario;
                $calculo_alimentacao_desconto_anual = $calculo_alimentacao_desconto * 12;
            }
            else if ($desconto=="nao"){
                $calculo_alimentacao_desconto = "Não possui desconto no sálario";
                $calculo_alimentacao_desconto_anual = "Não possui desconto no sálario";
            }
        }
        else if ($valealimentacao =="nao"){
            $calculo_alimentacao = "Não possui vale alimentação";
            $valealimentacao_anual = "Não possui vale alimentação";
            $calculo_alimentacao_desconto = "Não possui vale alimentação";
            $calculo_alimentacao_desconto_anual = "Não possui vale alimentação";

        }
    
        //calculo vale transporte
        if ($valetransporte=="sim"){
            $calculo_transportes = ($valordatarifa*2) * $diastrabalhados;
            $calculo_transportes_mensal = ($calculo_transportes / 12)." reais (valor aproximado)"; 
            if ($descontotransporte=="sim"){
                $calculo_transportes_desconto_anual = (($valordescontotrasnporte/100) * $salario) * 12 . "reais";
                $calculo_transportes_desconto_mensal = ($valordescontotrasnporte/100) * $salario . "reais";
            }
            else if ($descontotransporte=="nao"){
                $calculo_transportes_desconto_anual = "Não possui desconto";
                $calculo_transportes_desconto_mensal = "Não possui desconto";
            }  
        }
        else if($valetransporte=="nao"){
            $calculo_transportes = "Não possui vale transporte";
            $calculo_transportes_mensal = "Não possui vale transporte";
            $calculo_transportes_desconto_anual = "Não possui vale transporte";
            $calculo_transportes_desconto_mensal = "Não possui vale transporte";
        }

    ?>




    <section class="resultados">

        <div class="headerresultados">

            <img class="logoazapfy" src="Logo Azapfy.png" alt="">
            <h1 class="titulo">Resultados</h1>
            <h4 class="texto"> Abaixo segue o relatorio</h4>

        </div>

        <span class="titulo_resultados">Nome</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $nome ?> </span></div>
        </div>

        <span class="titulo_resultados">Cargo</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $cargo?> </span></div>
        </div>

        <span class="titulo_resultados">Ano de referência</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $ano?> </span></div>
        </div>

        <span class="titulo_resultados">CLT</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $cltresposta ?> </span></div>
        </div>

        <span class="titulo_resultados">Jornada anual</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $jornadaanual ?> horas </span></div>
        </div>

        <span class="titulo_resultados">Jornada semanal</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $jornadasemanal ?> horas </span></div>
        </div>

        <span class="titulo_resultados">Valor do fgts mensal</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $fgts ?> reais </span></div>
        </div>

        <span class="titulo_resultados">Valor do fgts no ano</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $fgts_anual ?> reais </span></div>
        </div>

        <span class="titulo_resultados">Valor do inss no ano</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $inss_anual ?> reais </span></div>
        </div>

        <span class="titulo_resultados">Valor do inss mensal</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $inss ?> reais </span></div>
        </div>

        <span class="titulo_resultados">Valor do irrf no ano</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $irrf_anual ?> reais </span></div>
        </div>

        <span class="titulo_resultados">Valor do irrf mensal</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $irrf ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor do vale transporte anual </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo_transportes ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor do vale transporte mensal </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo_transportes_mensal ?> </span></div>
        </div>

        <span class="titulo_resultados">valor ser descontado no salario anual (vale transporte)</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo_transportes_desconto_anual ?>  </span></div>
        </div>

        <span class="titulo_resultados">valor ser descontado no salario mensal (vale transporte)</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo_transportes_desconto_mensal ?> </span></div>
        </div>

        <span class="titulo_resultados">valor do vale alimentação anual  </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $valealimentacao_anual ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor do vale alimentação mensal </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo_alimentacao ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor a ser descontado no salario anual (vale alimentação) </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo_alimentacao_desconto_anual ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor a ser descontado no salario mensalmente (vale alimentação) </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo_alimentacao_desconto ?> reais </span></div>
        </div>


        <a class="button" href="index.html">Realizar um novo calculo</a>
        <a href="https://incredible-donut-eb52c4.netlify.app/" class="button" type="submit"> sair </a>


    </section>
</body>

</html>