<?php
require __DIR__ . '/vendor/autoload.php';

use MinhaApp\matematica\operacoes;

// Teste de estresse
function runStressTest($iterations = 10000) {
    $op = new operacoes();
    $start = microtime(true);
    
    for ($i = 0; $i < $iterations; $i++) {
        // Operações intensivas
        $result1 = $op->somar($i, $i * 2);
        $result2 = $op->multiplicar($result1, 3);
        $result3 = $op->dividir($result2, 2);
    }
    
    $end = microtime(true);
    $time = round($end - $start, 4);
    
    echo "🚀 Teste de estresse: $iterations iterações em $time segundos\n";
    echo "📊 " . round($iterations / $time, 2) . " operações/segundo\n";
}

// Executar testes
echo "=== TESTE DE CARGA AVANÇADO ===\n";
runStressTest(10000);
runStressTest(50000);
runStressTest(100000);