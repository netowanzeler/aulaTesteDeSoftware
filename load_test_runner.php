<?php
require __DIR__ . '/vendor/autoload.php';

use MinhaApp\matematica\operacoes;

class LoadTest {
    private $totalRequests;
    private $concurrentRequests;
    
    public function __construct($totalRequests = 1000, $concurrentRequests = 50) {
        $this->totalRequests = $totalRequests;
        $this->concurrentRequests = $concurrentRequests;
    }
    
    public function runTest() {
        echo "Iniciando teste de carga...\n";
        echo "Total de requisições: {$this->totalRequests}\n";
        echo "Requisições concorrentes: {$this->concurrentRequests}\n\n";
        
        $startTime = microtime(true);
        $results = [
            'success' => 0,
            'errors' => 0,
            'total_time' => 0,
            'requests_per_second' => 0
        ];
        
        // Simula requisições concorrentes
        $chunks = array_chunk(range(1, $this->totalRequests), $this->concurrentRequests);
        
        foreach ($chunks as $chunk) {
            $this->processChunk($chunk, $results);
        }
        
        $endTime = microtime(true);
        $results['total_time'] = round($endTime - $startTime, 4);
        $results['requests_per_second'] = round($this->totalRequests / $results['total_time'], 2);
        
        $this->printResults($results);
    }
    
    private function processChunk($chunk, &$results) {
        $op = new operacoes();
        
        foreach ($chunk as $i) {
            try {
                // Simula diferentes operações
                $operation = $this->getRandomOperation();
                $a = rand(1, 100);
                $b = rand(1, 100);
                
                switch ($operation) {
                    case 'somar':
                        $result = $op->somar($a, $b);
                        break;
                    case 'subtrair':
                        $result = $op->subtrair($a, $b);
                        break;
                    case 'multiplicar':
                        $result = $op->multiplicar($a, $b);
                        break;
                    case 'dividir':
                        $result = $op->dividir($a, $b);
                        break;
                }
                
                $results['success']++;
                
            } catch (Exception $e) {
                $results['errors']++;
            }
        }
    }
    
    private function getRandomOperation() {
        $operations = ['somar', 'subtrair', 'multiplicar', 'dividir'];
        return $operations[array_rand($operations)];
    }
    
    private function printResults($results) {
        echo "=== RESULTADOS DO TESTE DE CARGA ===\n";
        echo "Tempo total: {$results['total_time']} segundos\n";
        echo "Requisições por segundo: {$results['requests_per_second']}\n";
        echo "Sucessos: {$results['success']}\n";
        echo "Erros: {$results['errors']}\n";
        echo "Taxa de sucesso: " . round(($results['success'] / $this->totalRequests) * 100, 2) . "%\n";
    }
}

// Configuração do teste
$totalRequests = 1000;      // Total de requisições
$concurrent = 50;           // Requisições concorrentes

$test = new LoadTest($totalRequests, $concurrent);
$test->runTest();