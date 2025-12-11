# 🎵 Infinity Disks - Loja Virtual de CDs e Vinis

Bem-vindo ao **Infinity Disks**, uma loja virtual focada na venda de CDs e vinis. Este projeto foi desenvolvido como parte do Projeto e-commerce da matéria de Aplicações para WEB II do 3ª ano do curso técnico de Informática do CEFET-MG Campus Contagem. 

## 🛠️ Tecnologias Utilizadas

- **PHP**: Linguagem de programação server-side
- **MySQL**: Banco de dados relacional
- **HTML5/CSS3**: Estrutura e estilização do frontend
- **PDO**: Conexão segura com o banco de dados
- **Session**: Gerenciamento de sessões de usuário


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
   - Abra o arquivo `db_web_loja.sql` do projeto em um editor de texto
   - Copie todo o conteúdo do arquivo
   - Cole no campo de texto do phpMyAdmin
   - Clique em "**Executar**" (ou "Go")

   **Alternativa**: Use a aba "Importar" para importar o arquivo `db_web_loja.sql` diretamente.

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

---