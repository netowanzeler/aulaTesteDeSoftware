<?php
namespace MinhaApp;

use MinhaApp\matematica\operacoes;

class CalculadoraFacil {
    private $operacoes;
    
    public function __construct() {
        $this->operacoes = new operacoes();
    }
    
    public function calcular($a, $b, $operacao) {
        switch ($operacao) {
            case 'somar':
                return $this->operacoes->somar($a, $b);
            case 'subtrair':
                return $this->operacoes->subtrair($a, $b);
            case 'multiplicar':
                return $this->operacoes->multiplicar($a, $b);
            case 'dividir':
                return $this->operacoes->dividir($a, $b);
            default:
                throw new \Exception("Operação inválida: $operacao");
        }
    }
}