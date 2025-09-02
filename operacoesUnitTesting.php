<?php
require __DIR__ . '/vendor/autoload.php';

// arquivo: calculadoraTest.php
use PHPUnit\Framework\TestCase;
use MinhaApp\matematica\operacoes;

class operacoesUnitTesting extends TestCase {
    public function testSomar() {
        $this->assertEquals(15, (new operacoes())->somar(10, 5));
        $this->assertEquals(12, (new operacoes())->somar(10, 2));    
        $this->assertEquals(0, (new operacoes())->somar(0, 0));
        $this->assertEquals(-5, (new operacoes())->somar(-10, 5));
        $this->assertEquals(-15, (new operacoes())->somar(-10, -5));
    }

    public function testSubtrair() {
        $this->assertEquals(5, (new operacoes())->subtrair(10, 5));
        $this->assertEquals(8, (new operacoes())->subtrair(10, 2));    
        $this->assertEquals(0, (new operacoes())->subtrair(0, 0));
        $this->assertEquals(-15, (new operacoes())->subtrair(-10, 5));
        $this->assertEquals(-5, (new operacoes())->subtrair(-10, -5));
    }

    public function testMultiplicar() {
        $this->assertEquals(50, (new operacoes())->multiplicar(10, 5));
        $this->assertEquals(20, (new operacoes())->multiplicar(10, 2));    
        $this->assertEquals(0, (new operacoes())->multiplicar(0, 0));
        $this->assertEquals(-50, (new operacoes())->multiplicar(-10, 5));
        $this->assertEquals(50, (new operacoes())->multiplicar(-10, -5));
    }

    public function testDividir() {
        $this->assertEquals(2, (new operacoes())->dividir(10, 5));
        $this->assertEquals(5, (new operacoes())->dividir(10, 2));    
        $this->assertEquals(0, (new operacoes())->dividir(0, 5));
        $this->assertEquals(-2, (new operacoes())->dividir(-10, 5));
        $this->assertEquals(2, (new operacoes())->dividir(-10, -5));
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Divisão por zero não é permitida.");
        (new operacoes())->dividir(10, 0);
    }

}
