# CNPJ Validator

![CI](https://github.com/phaelfp/cnpj-validator-php/actions/workflows/ci.yml/badge.svg)
![Release](https://github.com/phaelfp/cnpj-validator-php/actions/workflows/release.yml/badge.svg)
![PHP](https://img.shields.io/badge/php-8.0%2B-blue)
![License](https://img.shields.io/badge/license-MIT-green)

Validador de CNPJ numérico e alfanumérico (novo padrão da Receita Federal).

Compatível com:

- CNPJ tradicional (somente números)
- Novo CNPJ alfanumérico (2026+)

---

## 📦 Instalação

```bash
composer require phaelfp/cnpj-validator
```

---

## 🚀 Uso

```php
use PhaelFP\CnpjValidator\Cnpj;

// Validar
Cnpj::validate('11444777000161');

// Gerar dígitos verificadores
Cnpj::calculate('114447770001');

// Formatar
Cnpj::format('11444777000161');
```

---

## 🧪 Rodando os testes

```bash
composer install
vendor/bin/phpunit
```

---

## 📜 Regras aplicadas

O cálculo segue o algoritmo oficial da Receita Federal:

- Módulo 11
- Pesos progressivos
- Conversão alfanumérica via `ord(char) - 48`

---

## 📄 Licença

MIT
