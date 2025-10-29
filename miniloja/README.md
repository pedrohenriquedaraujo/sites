# 🛒 MiniLoja - Sistema E-commerce PHP MVC

Sistema completo de e-commerce desenvolvido em PHP puro com arquitetura MVC, MySQL e design responsivo.

## 📋 Funcionalidades

### Para Usuários
- ✅ Sistema de cadastro e login
- ✅ Navegação e busca de produtos
- ✅ Visualização detalhada de produtos
- ✅ Sistema de avaliações (notas e comentários)
- ✅ Carrinho de compras funcional
- ✅ Finalização de pedidos
- ✅ Perfil com histórico de pedidos

### Para Administradores
- ✅ Dashboard com estatísticas e gráficos
- ✅ Gestão completa de produtos (CRUD)
- ✅ Gestão de usuários
- ✅ Gestão de pedidos com mudança de status
- ✅ Relatórios de vendas
- ✅ Produtos mais vendidos

## 🗂️ Estrutura do Projeto

```
miniloja/
├── assets/
│   ├── css/
│   │   └── style.css           # Estilos principais
│   ├── js/
│   │   └── script.js           # JavaScript e gráficos
│   └── images/                 # Imagens dos produtos
├── config/
│   ├── config.php              # Configurações gerais
│   └── database.php            # Conexão com banco
├── controller/
│   ├── AdminController.php     # Controlador admin
│   ├── AuthController.php      # Controlador de autenticação
│   ├── CartController.php      # Controlador do carrinho
│   ├── HomeController.php      # Controlador home
│   ├── ProductController.php   # Controlador de produtos
│   └── UserController.php      # Controlador de usuário
├── database/
│   └── schema.sql              # Script de criação do banco
├── model/
│   ├── Cart.php                # Model do carrinho
│   ├── Order.php               # Model de pedidos
│   ├── Product.php             # Model de produtos
│   ├── Review.php              # Model de avaliações
│   └── User.php                # Model de usuários
├── service/
│   ├── AuthService.php         # Serviço de autenticação
│   ├── CartService.php         # Serviço de carrinho
│   └── ProductService.php      # Serviço de produtos
├── view/
│   ├── admin/                  # Views administrativas
│   ├── auth/                   # Views de autenticação
│   ├── cart/                   # Views do carrinho
│   ├── home/                   # Views home
│   ├── layout/                 # Header e footer
│   ├── products/               # Views de produtos
│   └── user/                   # Views de perfil
├── index.php                   # Ponto de entrada e roteador
└── README.md                   # Este arquivo
```

## 🚀 Instalação

### 1. Requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Apache/Nginx com mod_rewrite
- XAMPP, WAMP ou similar

### 2. Configuração do Banco de Dados

1. Abra o phpMyAdmin ou MySQL Workbench
2. Execute o script `database/schema.sql`
3. O banco `miniloja` será criado automaticamente

**Credenciais padrão do admin:**
- Email: `admin@miniloja.com`
- Senha: `admin123`

### 3. Configuração do Projeto

1. Clone ou extraia o projeto na pasta do servidor:
   ```
   C:\xampp\htdocs\5 sites\sites\miniloja\
   ```

2. Edite `config/database.php` se necessário:
   ```php
   private $host = "localhost";
   private $db_name = "miniloja";
   private $username = "root";
   private $password = "";
   ```

3. Edite `config/config.php` para ajustar a URL base:
   ```php
   define('BASE_URL', 'http://localhost/5%20sites/sites/miniloja/');
   ```

### 4. Estrutura de Pastas

Crie a pasta de imagens:
```
mkdir assets/images
```

### 5. Acesso

Acesse no navegador:
```
http://localhost/5%20sites/sites/miniloja/
```

## 👥 Tipos de Usuário

### Administrador
- Acesso completo ao painel administrativo
- Gestão de produtos, usuários e pedidos
- Visualização de dashboard e estatísticas

### Usuário
- Navegação e compra de produtos
- Gerenciamento do próprio carrinho
- Visualização de histórico de pedidos
- Sistema de avaliações

## 📊 Banco de Dados

### Tabelas Principais

- **usuarios**: Dados dos usuários e admins
- **produtos**: Catálogo de produtos
- **carrinho**: Itens no carrinho de cada usuário
- **pedidos**: Pedidos realizados
- **pedido_itens**: Itens de cada pedido
- **avaliacoes**: Avaliações dos produtos

## 🎨 Design e Responsividade

O sistema utiliza:
- CSS Grid e Flexbox para layouts responsivos
- Design mobile-first
- Animações e transições suaves
- Componentes reutilizáveis

## 🔒 Segurança

- Senhas com hash bcrypt
- Proteção contra SQL Injection (PDO com prepared statements)
- Sanitização de inputs
- Validação de sessões
- Proteção de rotas administrativas

## 📈 Dashboard Admin

O dashboard inclui:
- Cards com estatísticas gerais
- Gráfico de vendas dos últimos 30 dias
- Gráfico de produtos mais vendidos
- Lista de pedidos recentes
- Sistema de gestão completo

## 🛠️ Tecnologias

- **Backend**: PHP 7.4+ (Puro, sem frameworks)
- **Banco de Dados**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Arquitetura**: MVC (Model-View-Controller)
- **Gráficos**: JavaScript Canvas (sem bibliotecas externas)

## 📝 Próximas Melhorias

- [ ] Sistema de upload de imagens
- [ ] Filtros e busca avançada de produtos
- [ ] Integração com gateway de pagamento
- [ ] Sistema de cupons de desconto
- [ ] Notificações por email
- [ ] Relatórios em PDF
- [ ] API REST

## 🐛 Resolução de Problemas

### Erro de Conexão com Banco
- Verifique se o MySQL está rodando
- Confira as credenciais em `config/database.php`
- Certifique-se que o banco `miniloja` foi criado

### Erro 404
- Verifique se a BASE_URL está correta em `config/config.php`
- Confirme que o mod_rewrite está habilitado

### Imagens não aparecem
- Crie a pasta `assets/images/`
- Verifique permissões de leitura
- Use `default.jpg` como fallback

## 📄 Licença

Projeto desenvolvido para fins educacionais.

## 👨‍💻 Autor

Desenvolvido com ❤️ para trabalho escolar

---

**Bom desenvolvimento! 🚀**
