# 📋 DOCUMENTAÇÃO COMPLETA DE TESTES DE SOFTWARE

## 🎯 Visão Geral

Documentação completa do projeto de testes de software implementando testes funcionais e não-funcionais para uma aplicação **PHP** de calculadora.

## 📊 Sumário de Testes Implementados
1. ✅ Testes Unitários (Unit Testing)  
2. 🔗 Testes de Integração (Integration Testing)  
3. 🚀 Testes de Carga (Load Testing)  
4. 🔥 Testes de Estresse (Stress Testing)  
5. 📋 Testes Funcionais  
6. ⚡ Testes de Performance  

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
