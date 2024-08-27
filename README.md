# Pomodoro Timer

## Descrição

O Pomodoro Timer é uma aplicação web baseada na técnica Pomodoro, que ajuda a gerenciar o tempo de trabalho e descanso de forma eficiente. A aplicação permite que os usuários configurem timers personalizados para períodos de trabalho (foco) e descanso, e armazene as informações em um banco de dados.

## Tecnologias Utilizadas

- **Laravel**: Framework PHP para o backend.
- **MySQL**: Sistema de gerenciamento de banco de dados.
- **Blade**: Motor de templates para renderização de views.
- **JavaScript**: Para funcionalidades dinâmicas no frontend.
- **CSS**: Para estilização da aplicação.

## Funcionalidades

- **Cadastro e Login de Usuários**: Permite que os usuários se registrem e façam login para acessar suas configurações de timers.
- **Configuração de Timers**: Os usuários podem configurar timers para períodos de foco e descanso.
- **Armazenamento de Dados**: Dados dos timers são armazenados em um banco de dados MySQL.
- **Visualização dos Timers**: Exibe os timers configurados e permite a interação com eles.

-  ### Pré-requisitos
- Composer para gerenciar dependências PHP.
- Php 8.3.10
- Laravel 10.46.0
### Instalação

1. Clone o repositório:
    ```bash
    git clone https://github.com/seu-usuario/seu-repositorio.git
    cd seu-repositorio
    ```

2. Configure o ambiente:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. Instale as dependências:
    ```bash
    composer install
    npm install
    ```

4. Rode as migrações do banco de dados:
    ```bash
    php artisan migrate
    ```

5. Suba o servidor web:
    ```bash
    php artisan serve
    ```
