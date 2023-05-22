<?php

class CalculadoraFolha
{
    private $nome;
    private $cargo;
    private $clt;
    private $salario;
    private $diastrabalhados;
    private $ano;
    private $cargahoraria;
    private $periculosidade;
    private $insalubridade;
    private $valetransporte;
    private $valealimentacao;
    private $fgts;
    private $inss;
    private $irrf;
    private $nivelinsalubridade;
    
    public function __construct($dados)
    {
        $this->nome = $dados['name'];
        $this->cargo = $dados['cargo'];
        $this->clt = $dados['clt'];
        $this->salario = $dados['salario'];
        $this->diastrabalhados = $dados['diastrabalhados'];
        $this->ano = $dados['ano'];
        $this->cargahoraria = $dados['cargahoraria'];
        $this->periculosidade = $dados['periculosidade'];
        $this->insalubridade = $dados['insalubridade'];
        $this->valetransporte = $dados['valetransporte'];
        $this->valealimentacao = $dados['valealimentacao'];
        $this->nivelinsalubridade = $dados['nivelinsalubridade'];

        $this->calcularFolha();
    }

    private function calcularFolha()
    {
        // Cálculos de tempo
        $jornadasemanal = $this->cargahoraria * 5;
        $jornadaanual = $this->cargahoraria * $this->diastrabalhados;

        // Cálculo FGTS
        if ($this->clt == "sim") {
            $this->fgts = $this->salario * 0.8;
            return $this->fgts;
        }

        // Cálculo INSS
        if ($this->clt == "sim") {
            if ($this->salario <= 1302.00) {
                $this->inss = $this->salario * 0.075;
            } else if ($this->salario <= 2571.29) {
                $this->inss = $this->salario * 0.09;
            } else if ($this->salario <= 3856.94) {
                $this->inss = $this->salario * 0.12;
            } else if ($this->salario <= 7507.49) {
                $this->inss = $this->salario * 0.14;
            } else {
                $this->inss = 7507.49 * 0.14; // o valor máximo para o cálculo do INSS é R$ 7507,49
            }
            return $this->inss;
        }

        // Cálculo IRRF
        $salarioBase = $this->salario - $this->inss;
        $aliquota = 0;
        $deducao = 0;

        if ($this->clt == "sim") {
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

            $this->irrf = ($salarioBase * $aliquota) - $deducao;

            if ($this->irrf < 0) {
                $this->irrf = 0;
            }
            return $this->irrf;
        }
 
        //Calculo de insalubridade 
        
        $conta = 0;
        if($this->insalubridade=="sim"){
            if($this->nivelinsalubridade=="alto"){
                $conta = 1380.60 * 0.4; 
            }
            if($this->nivelinsalubridade=="medio"){
                $conta = 1380.60 * 0.2;
            }
            if($this->nivelinsalubridade=="minimo"){
                $conta = 1380.60 * 0.1;
            }
            return $conta;
        }
    
    }
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calculadora = new CalculadoraFolha($_POST);
    // Você pode acessar os resultados dos cálculos utilizando as propriedades da instância $calculadora
    // Exemplo: $calculadora->fgs, $calculadora->inss, $calculadora->irrf, etc.
}

?>
