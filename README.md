# Site.Set

Sistema de cadastro de produtos desenvolvido em PHP com MySQL.

## O que você precisa

- [XAMPP](https://www.apachefriends.org/) instalado (Apache + PHP + MySQL)
- Git (opcional, para baixar o projeto)

## Como instalar

### 1. Baixar o projeto

Baixe ou clone o repositório e coloque a pasta dentro do `htdocs` do XAMPP:

```
C:\xampp\htdocs\dashboard\Site.Set
```

### 2. Ligar o XAMPP

Abra o XAMPP e clique em **Start** nos serviços **Apache** e **MySQL**.

### 3. Criar o banco de dados pelo phpMyAdmin

1. Abra o navegador e acesse: `http://localhost/phpmyadmin`
2. No menu lateral esquerdo, clique em **Importar**
3. Clique em **Escolher arquivo** e selecione o arquivo `database.sql` que está dentro da pasta `backend` do projeto
4. Role a página até o final e clique em **Executar**
5. Pronto! O banco `blog-crud` e a tabela `produtos` serão criados automaticamente

### 4. Conexão com o banco (só se necessário)

Por padrão, o XAMPP já funciona sem senha. Se o seu MySQL tiver senha, edite o arquivo `backend/db.php` e coloque seus dados de acesso.

## Como acessar o site

| Página | Link |
|---|---|
| Página inicial | `http://localhost/dashboard/Site.Set/frontend/index.php` |
| Cadastrar produto | `http://localhost/dashboard/Site.Set/backend/create.php` |
| Listar produtos | `http://localhost/dashboard/Site.Set/backend/listar.php` |

> Se você colocou o projeto em outra pasta dentro do `htdocs`, ajuste o link de acordo.

## O que o sistema faz

- Cadastrar produtos (nome, descrição e preço)
- Ver todos os produtos cadastrados
- Remover produtos

## Desenvolvedor

Samuel de Sousa Carneiro
