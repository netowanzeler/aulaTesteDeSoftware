<?php
require __DIR__ . '/vendor/autoload.php';

use MinhaApp\matematica\operacoes;

class StressTest {
    private $results = [];
    private $startTime;
    private $maxMemory = 0;
    
    public function runStressTest($maxRequests = 10000, $concurrent = 100) {
        echo "🔥 INICIANDO STRESS TEST 🔥\n";
        echo "==========================\n";
        echo "Requisições totais: $maxRequests\n";
        echo "Conexões concorrentes: $concurrent\n";
        echo "Memória inicial: " . round(memory_get_usage() / 1024 / 1024, 2) . " MB\n\n";
        
        $this->startTime = microtime(true);
        $this->results = [
            'total' => 0,
            'success' => 0,
            'errors' => 0,
            'operations' => []
        ];
        
        // Teste em lotes para simular concorrência
        $batches = ceil($maxRequests / $concurrent);
        
        for ($batch = 1; $batch <= $batches; $batch++) {
            $this->runBatch($concurrent, $batch);
            
            // Monitoramento em tempo real
            if ($batch % 10 === 0) {
                $this->printProgress($batch, $batches);
            }
        }
        
        $this->printFinalResults();
    }
    
    private function runBatch($concurrent, $batchNumber) {
        $promises = [];
        
        for ($i = 0; $i < $concurrent; $i++) {
            $this->results['total']++;
            
            try {
                $op = new operacoes();
                $operation = $this->getRandomOperation();
                $a = rand(1, 1000);
                $b = rand(1, 1000);
                
                $startOp = microtime(true);
                
                // Operação pesada proposital
                $result = $this->executeStressOperation($op, $operation, $a, $b);
                
                $time = microtime(true) - $startOp;
                
                $this->results['operations'][] = $time;
                $this->results['success']++;
                
            } catch (Exception $e) {
                $this->results['errors']++;
                $this->results['operations'][] = 0;
            }
            
            // Monitorar pico de memória
            $currentMemory = memory_get_peak_usage(true);
            if ($currentMemory > $this->maxMemory) {
                $this->maxMemory = $currentMemory;
            }
        }
    }
    
    private function executeStressOperation($op, $operation, $a, $b) {
        // Operações mais intensivas para stress test
        switch ($operation) {
            case 'somar':
                // Soma múltipla para aumentar carga
                $result = $op->somar($a, $b);
                $result = $op->somar($result, $a);
                return $op->somar($result, $b);
                
            case 'subtrair':
                // Cadeia de subtrações
                $result = $op->subtrair($a, $b);
                $result = $op->subtrair($result, $a);
                return $op->subtrair($result, $b);
                
            case 'multiplicar':
                // Multiplicação intensiva
                $result = $op->multiplicar($a, $b);
                $result = $op->multiplicar($result, 2);
                return $op->multiplicar($result, 3);
                
            case 'dividir':
                // Divisão com verificação
                if ($b == 0) $b = 1;
                $result = $op->dividir($a, $b);
                $result = $op->dividir($result, 2);
                return $result;
                
            case 'complexa':
                // Operação complexa para máximo stress
                $result = $op->somar($a, $b);
                $result = $op->multiplicar($result, $a);
                $result = $op->subtrair($result, $b);
                return $op->dividir($result, 2);
        }
    }
    
    private function getRandomOperation() {
        $operations = ['somar', 'subtrair', 'multiplicar', 'dividir', 'complexa'];
        return $operations[array_rand($operations)];
    }
    
    private function printProgress($currentBatch, $totalBatches) {
        $elapsed = microtime(true) - $this->startTime;
        $progress = ($currentBatch / $totalBatches) * 100;
        $rps = round($this->results['total'] / $elapsed, 2);
        
        echo sprintf(
            "📊 Progresso: %.1f%% | Req/s: %d | Sucesso: %d | Erros: %d | Mem: %.2f MB\n",
            $progress,
            $rps,
            $this->results['success'],
            $this->results['errors'],
            memory_get_usage() / 1024 / 1024
        );
    }
    
    private function printFinalResults() {
        $totalTime = microtime(true) - $this->startTime;
        
        // Calcular estatísticas
        $operations = array_filter($this->results['operations']);
        $avgTime = $operations ? array_sum($operations) / count($operations) : 0;
        $maxTime = $operations ? max($operations) : 0;
        $minTime = $operations ? min($operations) : 0;
        
        sort($operations);
        $p95 = $this->calculatePercentile($operations, 95);
        $p99 = $this->calculatePercentile($operations, 99);
        
        echo "\n🎯 RESULTADOS DO STRESS TEST 🎯\n";
        echo "===============================\n";
        echo sprintf("⏰ Tempo total: %.2f segundos\n", $totalTime);
        echo sprintf("🚀 Requests por segundo: %.2f\n", $this->results['total'] / $totalTime);
        echo sprintf("✅ Sucessos: %d (%.1f%%)\n", $this->results['success'], ($this->results['success'] / $this->results['total']) * 100);
        echo sprintf("❌ Erros: %d (%.1f%%)\n", $this->results['errors'], ($this->results['errors'] / $this->results['total']) * 100);
        echo sprintf("💾 Pico de memória: %.2f MB\n", $this->maxMemory / 1024 / 1024);
        echo sprintf("📊 Tempo médio por operação: %.4f ms\n", $avgTime * 1000);
        echo sprintf("⚡ Tempo mínimo: %.4f ms\n", $minTime * 1000);
        echo sprintf("🐢 Tempo máximo: %.4f ms\n", $maxTime * 1000);
        echo sprintf("📈 95th percentile: %.4f ms\n", $p95 * 1000);
        echo sprintf("📈 99th percentile: %.4f ms\n", $p99 * 1000);
        
        // Análise de performance
        echo "\n📋 ANÁLISE DE PERFORMANCE:\n";
        if ($this->results['errors'] > 0) {
            echo "⚠️  Sistema apresentou erros sob stress\n";
        }
        if ($p95 > 0.1) { // 100ms
            echo "⚠️  95% das operações acima de 100ms - Possível gargalo\n";
        }
        if ($this->maxMemory > 50 * 1024 * 1024) { // 50MB
            echo "⚠️  Alto consumo de memória: " . round($this->maxMemory / 1024 / 1024, 2) . "MB\n";
        }
        
        echo "✅ Stress test concluído!\n";
    }
    
    private function calculatePercentile($data, $percentile) {
        if (empty($data)) return 0;
        
        $index = ceil(($percentile / 100) * count($data)) - 1;
        $index = max(0, min($index, count($data) - 1));
        
        return $data[$index];
    }
}

// Configuração do teste
echo "🔧 Configurando stress test...\n";

$test = new StressTest();

// Testes com diferentes níveis de stress
//$test->runStressTest(5000, 50);  // Teste moderado
// $test->runStressTest(10000, 100); // Teste pesado
$test->runStressTest(20000, 200); // Teste extremo  