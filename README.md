# 📋 DOCUMENTAÇÃO COMPLETA DE TESTES DE SOFTWARE

## 🎯 Visão Geral

Documentação completa do projeto de testes de software implementando testes funcionais e não-funcionais para uma aplicação **PHP** de calculadora.

## 📊 Sumário de Testes Implementados
1. ✅ Testes Unitários (Unit Testing)  
2. 🔗 Testes de Integração (Integration Testing)  
3. 🚀 Testes de Carga (Load Testing)  
4. 🔥 Testes de Estresse (Stress Testing)  

---

## 🛠️ Ferramentas e Tecnologias

| Tipo de Teste       | Ferramenta      | Versão | Documentação                  |
|----------------------|----------------|--------|--------------------------------|
| Todos               | PHP            | 8.4+   | [php.net](https://www.php.net) |
| Unit & Integration  | PHPUnit        | 12.3+  | [phpunit.de](https://phpunit.de) |
| Load & Stress       | Apache Bench   | 2.3+   | [Apache AB](https://httpd.apache.org/) |
| Gerenciamento       | Composer       | 2.0+   | [getcomposer.org](https://getcomposer.org) |
| Servidor            | Apache/NGINX   | 2.4+   | [Apache Docs](https://httpd.apache.org/docs/) |

---

## 📁 Estrutura do Projeto

```text
aulaTesteDeSoftware/
├── src/                          # Código fonte
│   ├── matematica/
│   │   └── operacoes.php         # Classe de operações matemáticas
│   └── CalculadoraFacil.php      # Serviço de calculadora
├── tests/                        # Testes
│   ├── Unit/                     # Testes unitários
│   ├── Integration/              # Testes de integração
│   └── Stress/                   # Testes de stress
├── vendor/                       # Dependências
├── load_test.php                 # Endpoint para load testing
├── post_data.json                # Dados de teste
├── composer.json                 # Configuração do Composer
└── index.php                     # Arquivo principal
```

## 🚀 Instalação e Configuração

### Pré-requisitos
```bash
# Verificar instalações
php --version      # PHP 8.4+
composer --version # Composer 2.0+
ab -V             # Apache Bench
```
# instalação do Laragon

*O Laragon é um ambiente de desenvolvimento local gratuito e portátil para Windows, que inclui as ferramentas essenciais como Apache, MySQL, PHP e outras, simplificando a criação e gestão de aplicações web. Ele se destaca por ser rápido, leve, fácil de instalar e configurar, oferecendo recursos integrados como Node.js, Git, Composer e uma gestão automatizada de Virtualhosts.*

|FERRAMENTA     | LINK PARA DOWNLOAD|
|---------------|-------------------|
|LARAGON        |(https://github.com/leokhoa/laragon/releases/tag/6.0.0)|


1. Clone e Instalação

```bash
git clone <repositorio>
cd aulaTesteDeSoftware
```

# Instalar dependências

composer require --dev phpunit/phpunit


# 🧪 1. TESTES UNITÁRIOS (Unit Testing)

## Objetivo

Validar unidades individuais de código (métodos, funções).


### Ferramenta utilizada: PHP: puro // Framwork:PHPUnit

Comando para rodar teste unitário: 

```bash 
phpunit calculadoraIntegrationTesting.php

```

# 🔗 2. TESTES DE INTEGRAÇÃO (Integration Testing)

## Objetivo

Testar a integração entre diferentes componentes do sistema.

Comando para rodar testE unitário:

````bash
phpunit calculadoraIntegrationTesting.php

````

# 🚀 3. TESTES DE CARGA (Load Testing)

## Objetivo

Avaliar o desempenho do sistema sob carga específica. dentro da normalidade do sistema.

## Arquivo de Configuração (post_data.json)

json
Copiar código
````bash
{
    "a": 100,
    "b": 25,
    "operacao": "somar"
}
````
## Comandos de Execução

````bash
# Teste com 1000 requisições, 50 concorrentes
ab -n 1000 -c 50 -T "application/json" -p post_data.json http://localhost/aulaTesteDeSoftware/load_test.php

# Teste básico (1000 requisições, 50 concorrentes)
ab -n 1000 -c 50 -T "application/json" -p post_data.json http://localhost/aulaTesteDeSoftware/load_test.php

# Teste avançado (5000 requisições, 100 concorrentes)
ab -n 5000 -c 100 -T "application/json" -p post_data.json http://localhost/aulaTesteDeSoftware/load_test.php

# Com saída detalhada
ab -n 1000 -c 50 -v 2 -T "application/json" -p post_data.json http://localhost/aulaTesteDeSoftware/load_test.php

````
# Métricas Analisadas

✅ Requests por segundo

✅ Tempo médio de resposta

✅ Taxa de erro

✅ Percentis (50%, 90%, 95%, 99%)


# 🔥 4. TESTES DE ESTRESSE (Stress Testing)

## Objetivo
Avaliar os limites máximos do sistema sob carga extrema.

Comandos de Execução

````bash
# Com Apache Bench (Recomendado)
ab -n 10000 -c 200 -T "application/json" -p post_data.json http://localhost/aulaTesteDeSoftware/load_test.php

# Com script PHP
php tests/Stress/StressTest.php

# Teste de longa duração (5 minutos)
ab -t 300 -c 100 -T "application/json" -p post_data.json http://localhost/aulaTesteDeSoftware/load_test.php
````

## 🔄 WORKFLOW DE DESENVOLVIMENTO
Desenvolvimento: Implementar funcionalidades

Testes Unitários: Validar unidades de código

Testes Integração: Validar componentes integrados

Testes Carga: Validar performance

Testes Stress: Validar limites do sistema
