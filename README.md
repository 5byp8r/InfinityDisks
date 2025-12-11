# 🎵 Infinity Disks - Loja Virtual de CDs e Vinis

Bem-vindo ao **Infinity Disks**, uma loja virtual desenvolvida para venda de CDs e vinis. Este projeto foi construído utilizando PHP puro, MySQL e CSS, seguindo o padrão MVC (Model-View-Controller).

## 📋 Sobre o Projeto

O Infinity Disks é um sistema completo de e-commerce para comercialização de produtos musicais (CDs e vinis) que oferece:

- 🛒 **Catálogo de Produtos**: Navegação e busca de CDs e vinis
- 👤 **Sistema de Autenticação**: Cadastro e login de usuários
- 🛍️ **Carrinho de Compras**: Adicionar e gerenciar itens no carrinho
- 💳 **Finalização de Compras**: Sistema de vendas completo
- 📦 **Histórico de Compras**: Visualização de compras anteriores
- 🔐 **Painel Administrativo**: Gerenciamento de produtos e vendas (acesso restrito)

## 🛠️ Tecnologias Utilizadas

- **PHP**: Linguagem de programação server-side
- **MySQL**: Banco de dados relacional
- **HTML5/CSS3**: Estrutura e estilização do frontend
- **PDO**: Conexão segura com o banco de dados
- **Session**: Gerenciamento de sessões de usuário

## 📁 Estrutura do Projeto

```
LojaCDsSiteWEB2/
├── Controller/
│   └── controller.php          # Controlador principal da aplicação
├── model/
│   ├── CD.php                  # Modelo de produtos (CDs/Vinis)
│   ├── ConexaoBD.php           # Conexão com banco de dados
│   ├── ItemVenda.php           # Modelo de itens de venda
│   ├── Usuario.php             # Modelo de usuários
│   └── Venda.php               # Modelo de vendas
├── view/
│   ├── admin_cadastro_produto.php  # Cadastro de produtos (admin)
│   ├── admin_produtos.php          # Listagem de produtos (admin)
│   ├── admin_vendas.php            # Gerenciamento de vendas (admin)
│   ├── carrinho.php                # Página do carrinho de compras
│   ├── catalogo.php                # Catálogo de produtos
│   ├── home.php                    # Página inicial
│   ├── login.php                   # Página de login
│   ├── minhas_compras.php          # Histórico de compras do usuário
│   ├── register.php                # Página de cadastro
│   ├── sobre.php                   # Página sobre a loja
│   └── style.css                   # Estilos CSS
├── Main.php                    # Arquivo principal de entrada
└── schema.sql                  # Script de criação do banco de dados
```

## ⚙️ Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **XAMPP** (versão 7.4 ou superior) - [Download aqui](https://www.apachefriends.org/pt_br/index.html)
  - Apache
  - MySQL
  - PHP

## 🚀 Configuração do Ambiente com XAMPP

### Passo 1: Instalar o XAMPP

1. Faça o download do XAMPP no site oficial: https://www.apachefriends.org/pt_br/index.html
2. Execute o instalador e siga as instruções
3. Escolha os componentes: **Apache**, **MySQL** e **PHP** (necessários)
4. Defina o diretório de instalação (padrão: `C:\xampp` no Windows)
5. Conclua a instalação

### Passo 2: Clonar o Projeto

1. Abra o diretório `htdocs` do XAMPP:
   - **Windows**: `C:\xampp\htdocs\`
   - **Linux**: `/opt/lampp/htdocs/`
   - **macOS**: `/Applications/XAMPP/htdocs/`

2. Clone o repositório ou copie os arquivos do projeto para dentro de `htdocs`:
   ```bash
   cd C:\xampp\htdocs\
   git clone https://github.com/5byp8r/LojaCDsSiteWEB2.git
   ```
   
   Ou crie uma pasta manualmente:
   ```bash
   cd C:\xampp\htdocs\
   mkdir LojaCDsSiteWEB2
   ```
   E copie todos os arquivos do projeto para esta pasta.

### Passo 3: Iniciar os Serviços do XAMPP

1. Abra o **XAMPP Control Panel**
2. Inicie os seguintes módulos:
   - ✅ **Apache** (clique em "Start")
   - ✅ **MySQL** (clique em "Start")
3. Verifique se os status estão em verde, indicando que os serviços estão rodando

### Passo 4: Configurar o Banco de Dados

1. Acesse o **phpMyAdmin** pelo navegador:
   ```
   http://localhost/phpmyadmin
   ```

2. Crie o banco de dados:
   - Clique em "**Novo**" (ou "New") no menu lateral
   - Nome do banco: `db_web_loja`
   - Collation: `utf8mb4_unicode_ci`
   - Clique em "**Criar**"

3. Importe o schema:
   - Selecione o banco `db_web_loja` criado
   - Clique na aba "**SQL**"
   - Abra o arquivo `schema.sql` do projeto em um editor de texto
   - Copie todo o conteúdo do arquivo
   - Cole no campo de texto do phpMyAdmin
   - Clique em "**Executar**" (ou "Go")

   **Alternativa**: Use a aba "Importar" para importar o arquivo `schema.sql` diretamente.

4. Verifique se as tabelas foram criadas:
   - `cds` - produtos (CDs e vinis)
   - `usuarios` - usuários do sistema
   - `vendas` - registro de vendas
   - `itensVenda` - itens de cada venda

### Passo 5: Configurar a Conexão com o Banco de Dados

1. Abra o arquivo `model/ConexaoBD.php`
2. Verifique as configurações de conexão (valores padrão do XAMPP):
   ```php
   private $host = 'localhost';
   private $dbname = 'db_web_loja';
   private $username = 'root';
   private $password = '';
   ```
3. Se você alterou a senha do MySQL no XAMPP, atualize o campo `$password`

### Passo 6: Acessar a Aplicação

1. Abra seu navegador (Chrome, Firefox, Edge, etc.)
2. Acesse o endereço:
   ```
   http://localhost/LojaCDsSiteWEB2/Main.php
   ```
   
   Ou, se você colocou em uma subpasta diferente:
   ```
   http://localhost/[nome-da-pasta]/Main.php
   ```

3. A página inicial do Infinity Disks deverá ser exibida! 🎉

## 👥 Usuários do Sistema

O sistema possui dois tipos de usuários:

1. **Usuário Comum (user)**:
   - Pode navegar pelo catálogo
   - Pode adicionar produtos ao carrinho
   - Pode finalizar compras
   - Pode visualizar histórico de compras

2. **Administrador (admin)**:
   - Todas as permissões de usuário comum
   - Pode cadastrar novos produtos
   - Pode gerenciar produtos existentes
   - Pode visualizar todas as vendas

### Criando um Usuário Administrador

Para criar um usuário administrador, você precisa inserir manualmente no banco de dados:

1. Acesse o phpMyAdmin: `http://localhost/phpmyadmin`
2. Selecione o banco `db_web_loja`
3. Clique na tabela `usuarios`
4. Clique em "Inserir" (Insert)
5. Preencha os campos:
   - **tipo**: `admin`
   - **nome**: seu nome
   - **email**: seu email
   - **senha**: hash da senha (use password_hash no PHP ou crie via página de registro e depois altere o tipo para 'admin')

## 🎯 Funcionalidades Principais

### Para Usuários
- ✨ Visualização do catálogo completo de produtos
- 🔍 Sistema de busca de produtos
- 🛒 Adicionar produtos ao carrinho
- 💰 Visualizar valor total do carrinho
- ✅ Finalizar compra
- 📜 Consultar histórico de compras

### Para Administradores
- ➕ Cadastrar novos produtos (CDs e vinis)
- ✏️ Editar informações de produtos
- 🗑️ Remover produtos do catálogo
- 📊 Visualizar relatório de vendas
- 👥 Gerenciar estoque

## 🔧 Solução de Problemas Comuns

### Apache não inicia
- Verifique se a porta 80 não está sendo usada por outro programa
- Altere a porta do Apache no XAMPP (Config > httpd.conf)
- Desative o Skype ou IIS que podem usar a porta 80

### MySQL não inicia
- Verifique se a porta 3306 não está em uso
- Verifique se não há outra instância do MySQL rodando

### Erro de conexão com banco de dados
- Verifique se o MySQL está rodando no XAMPP
- Confirme as credenciais em `model/ConexaoBD.php`
- Certifique-se de que o banco `db_web_loja` foi criado

### Página em branco ou erro 404
- Verifique se os arquivos estão na pasta `htdocs`
- Confirme se o Apache está rodando
- Verifique se a URL está correta: `http://localhost/LojaCDsSiteWEB2/Main.php`

### Erro de sessão
- Verifique as permissões da pasta `C:\xampp\tmp` (Windows)
- Certifique-se de que o PHP tem permissão para criar arquivos de sessão

## 📝 Observações

- O projeto utiliza sessões PHP para manter o estado do usuário logado e do carrinho de compras
- As senhas são armazenadas com hash usando `password_hash()` do PHP
- O banco de dados usa charset `utf8mb4` para suportar caracteres especiais
- Produtos de exemplo são inseridos automaticamente ao executar o `schema.sql`

## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para:

1. Fazer um fork do projeto
2. Criar uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abrir um Pull Request

## 📄 Licença

Este projeto é de código aberto e está disponível para fins educacionais.

## 📧 Contato

Para dúvidas ou sugestões sobre o projeto, abra uma issue no repositório.

---

**Desenvolvido com ❤️ para amantes de música física!** 🎵🎸

