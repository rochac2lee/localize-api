# Localize API

Essa é uma API desenvolvida para busca de endereços.

## Tecnologias

<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />&nbsp;&nbsp;
<img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white" />&nbsp;&nbsp;

## Features

- Listagem, cadastro, atualização e exclusão de endereços
- Lista o endereço baseado no id local
- Busca de endereço com base no cep informado
- Busca de endereço pelo logradouro

## Pré Requisitos

- Laravel
- Composer
- Git
- Mysql 

## Instalação

### Clonando o diretório

```
git clone https://github.com/rochac2lee/localize-api.git
cd localize-api
composer install
```

### Conexão com banco de dados

- Crie um banco de dados para o sistema
- Copie o conteúde de .env.example para .env e altere as informações de conexão da sua base de dados

### Gerar chave de criptografia

```
php artisan key:generate
```
### Execute as migrations com seed

```
php artisan migrate --seed
```

### Documentação da API

Na documentação será possível identificar os métodos, requisições e respostas dos endpoints.
Link da documentação: https://documenter.getpostman.com/view/13084905/TzRYdjio

## Author

Cleber Lee da Rocha [@rochac2lee](https://github.com/rochac2lee)
