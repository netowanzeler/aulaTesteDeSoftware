<?php
require __DIR__ . '/vendor/autoload.php';

use MinhaApp\matematica\operacoes;

// Simula um endpoint HTTP simples
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $a = $input['a'] ?? 0;
    $b = $input['b'] ?? 0;
    $operacao = $input['operacao'] ?? 'somar';
    
    $op = new operacoes();
    
    try {
        switch ($operacao) {
            case 'somar':
                $resultado = $op->somar($a, $b);
                break;
            case 'subtrair':
                $resultado = $op->subtrair($a, $b);
                break;
            case 'multiplicar':
                $resultado = $op->multiplicar($a, $b);
                break;
            case 'dividir':
                $resultado = $op->dividir($a, $b);
                break;
            default:
                throw new Exception("Operação inválida");
        }
        
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'resultado' => $resultado,
            'operacao' => "$a $operacao $b"
        ]);
        
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido']);
}