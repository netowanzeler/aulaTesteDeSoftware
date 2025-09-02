<?php
require __DIR__ . '/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use MinhaApp\CalculadoraFacil;

class calculadoraIntegrationTesting extends TestCase {
    
    public function testCalculadoraComSoma() {
        $calc = new CalculadoraFacil();
        $resultado = $calc->calcular(10, 5, 'somar');
        $this->assertEquals(15, $resultado);
    }
    
    public function testCalculadoraComSubtracao() {
        $calc = new CalculadoraFacil();
        $resultado = $calc->calcular(10, 5, 'subtrair');
        $this->assertEquals(5, $resultado);
    }
    
    public function testCalculadoraComMultiplicacao() {
        $calc = new CalculadoraFacil();
        $resultado = $calc->calcular(10, 5, 'multiplicar');
        $this->assertEquals(50, $resultado);
    }
    
    public function testCalculadoraComDivisao() {
        $calc = new CalculadoraFacil();
        $resultado = $calc->calcular(10, 5, 'dividir');
        $this->assertEquals(2, $resultado);
    }
    
    public function testCalculadoraComDivisaoPorZero() {
        $this->expectException(Exception::class);
        
        $calc = new CalculadoraFacil();
        $calc->calcular(10, 0, 'dividir');
    }
}