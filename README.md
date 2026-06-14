# Site.Set

Sistema de cadastro de produtos desenvolvido em PHP com MySQL (PDO).

## Requisitos

- [XAMPP](https://www.apachefriends.org/) (Apache + PHP + MySQL)
- Git (opcional, para clonar o repositório)

## Instalação

### 1. Clonar o repositório

```bash
git clone https://github.com/samuelsousavs/Site.Set.git
```

Coloque a pasta dentro do diretório `htdocs` do XAMPP:

```
C:\xampp\htdocs\dashboard\Site.Set
```

### 2. Iniciar o XAMPP

Abra o painel do XAMPP e inicie os serviços **Apache** e **MySQL**.

### 3. Criar o banco de dados

Escolha uma das opções abaixo:

#### Opção A — Terminal (Windows / XAMPP)

```bash
C:\xampp\mysql\bin\mysql.exe -u root < backend\database.sql
```

#### Opção B — Terminal (Linux / macOS)

```bash
mysql -u root -p < backend/database.sql
```

#### Opção C — phpMyAdmin

1. Acesse `http://localhost/phpmyadmin`
2. Vá em **Importar**
3. Selecione o arquivo `backend/database.sql`
4. Clique em **Executar**

#### Opção D — SQL manual

Execute no phpMyAdmin ou no terminal MySQL:

```sql
CREATE DATABASE IF NOT EXISTS `blog-crud` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `blog-crud`;

CREATE TABLE IF NOT EXISTS `produtos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `descricao` TEXT,
    `preco` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4. Configurar a conexão (se necessário)

As credenciais padrão do XAMPP já estão configuradas em `backend/db.php`:

| Configuração | Valor padrão |
|---|---|
| Host | `localhost` |
| Banco | `blog-crud` |
| Usuário | `root` |
| Senha | *(vazio)* |

Se o seu MySQL usa senha, edite o arquivo `backend/db.php`.

## Acessar o sistema

| Página | URL |
|---|---|
| Início | `http://localhost/dashboard/Site.Set/frontend/index.php` |
| Cadastrar produto | `http://localhost/dashboard/Site.Set/backend/create.php` |
| Listar produtos | `http://localhost/dashboard/Site.Set/backend/listar.php` |

> Ajuste o caminho conforme a pasta onde o projeto foi instalado dentro do `htdocs`.

## Funcionalidades

- Cadastrar produtos (nome, descrição e preço)
- Listar produtos cadastrados
- Remover produtos

## Estrutura do projeto

```
Site.Set/
├── backend/
│   ├── db.php           # Conexão com o banco de dados
│   ├── database.sql     # Script de criação do banco e tabela
│   ├── create.php       # Cadastro de produtos
│   ├── listar.php       # Listagem de produtos
│   └── delete.php       # Remoção de produtos
└── frontend/
    ├── index.php        # Página inicial
    └── style/           # Estilos CSS
```

## Desenvolvedor

Samuel de Sousa Carneiro
