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
    if($clt="sim"){
        $cltresposta = "O trabalhador é CLT";
    }
    else if ($clt="nao"){
        $cltresposta =  "O trabalhador não é CLT";
    }
    
    //calcular jordana de tempo
    $jornadasemanal = $cargahoraria * 5;
    $jornadaanual = $cargahoraria * $diastrabalhados;

    //calculo fgts
    if ($clt == "sim") {
        $fgts = ($salario * 0.08) * 12;
    }
    
    //calculo inss
    if ($clt == "sim") {
        if ($salario <= 1302.00) {
            $inss = ($salario * 0.075) * 12 ;
        } else if ($salario <= 2571.29) {
            $inss = ($salario * 0.09) * 12;
        } else if ($salario <= 3856.94) {
            $inss = ($salario * 0.12) * 12;
        } else if ($salario <= 7507.49) {
            $inss = ($salario * 0.14) * 12;
        } else {
            $inss = (7507.49 * 0.14) * 12; // o valor máximo para o cálculo do INSS é R$ 7507,49
        }
              
    }
    else if ($clt="nao"){
        $inss = "Não possui isss, pois não é clt";
    }

    //calculo irrf
    $salarioBase = ($salario * 12) - $inss;
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
   
        $irrf = (($salarioBase * $aliquota) - $deducao) * 12;

        if ($irrf<=0){
            $irrf = "salario abaixo do valor mínimo";
        }
    }
    else if($clt="nao"){
        $irrf = "Não possui irrf, pois não é clt";
    }
        //calculo de insalubridade 
       if ($clt="sim"){ 
        $conta;
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
            else if ($insalubridade="nao"){
                $conta = "Não possui insalubridade";
            }
             
        }
    }
    else if ($clt="nao"){
        $conta = " Não possui insalubridade, pois não é clt";
    }
       

        //calculo periculosidade
        if ($periculosidade = "sim"){
        $conta_periculosidade = ($salario * 0.4) + $salario;
        }
        else if ($periculosidade = "nao"){
            $conta_periculosidade = "Não possui periculosidade";
        }
        //calculo vale transporte 
        if ($valetransporte="sim"){
           $custo = ($valordatarifa*2) * $diastrabalhados;
           if ($descontotransporte="sim"){ 
            
        }
        else if ($descontotransporte="nao"){
            $descontotransporte1 = "Não possui desconto no salario";
        }
          
        }
        else if($valetransporte="nao") {
            $custo = "O trabrabalhador não possui Vale Transporte";
        }

        //calculo vale alimentação
        if ($valealimentacao="sim"){
            
            if ($desconto="sim"){
                
            }
            else if ($desconto="nao"){
                $calculo2 = "Não possui desconto no sálario";
            }
        }
        else if ($valealimentacao="nao"){

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

        <span class="titulo_resultados">Valor do fgts no ano</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $fgts ?> reais </span></div>
        </div>

        <span class="titulo_resultados">Valor do inss no ano</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $inss ?> reais </span></div>
        </div>

        <span class="titulo_resultados">Valor do irrf no ano</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $irrf ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor do vale transporte anual </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $custo ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor ser descontado no salario anual</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $descontotrasnporte1 ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor do vale alimentação anual </span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo1 ?> reais </span></div>
        </div>

        <span class="titulo_resultados">valor a ser descontado no salario anual</span>
        <div class="resultados_tempo">
            <div class="Resultados"><span> <?php echo $calculo2 ?> reais </span></div>
        </div>


        <a href="index.html">Realizar um novo calculo</a>
        <a href="resultados.php" class="button" type="submit"> sair </a>

    </section>
</body>

</html>