<?php
require __DIR__ . '/vendor/autoload.php';

use MinhaApp\matematica\operacoes;

$op = new operacoes();

echo "Resultado da soma: " . $op->somar(10, 5)."\n";
echo "Resultado da subtração: " . $op->subtrair(10, 5)."\n";
echo "Resultado da multiplicação: " . $op->multiplicar(10, 5)."\n";
echo "Resultado da divisão: " . $op->dividir(10, 5)."\n";

