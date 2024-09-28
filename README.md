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
	git clone https://github.com/arthurbritosouza/Pomodoro.git
	cd Pomodoro
    ```

2. Arquivo .env:
    ```bash
	APP_NAME=Laravel
	APP_ENV=local
	APP_KEY=base64:V5QPj5T7pIpn/eL9B9+kvMD8UziPRqIpVV+CClUg+GY=
	APP_DEBUG=true
	APP_URL=http://localhost

	LOG_CHANNEL=stack
	LOG_DEPRECATIONS_CHANNEL=null
	LOG_LEVEL=debug

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=
	DB_USERNAME=root
	DB_PASSWORD=

	BROADCAST_DRIVER=log
	CACHE_DRIVER=file
	FILESYSTEM_DRIVER=local
	QUEUE_CONNECTION=sync
	SESSION_DRIVER=file
	SESSION_LIFETIME=120

	MEMCACHED_HOST=127.0.0.1

	REDIS_HOST=127.0.0.1
	REDIS_PASSWORD=null
	REDIS_PORT=6379

	MAIL_MAILER=smtp
	MAIL_HOST=mailhog
	MAIL_PORT=1025
	MAIL_USERNAME=null
	MAIL_PASSWORD=null
	MAIL_ENCRYPTION=null
	MAIL_FROM_ADDRESS=null
	MAIL_FROM_NAME="${APP_NAME}"

	AWS_ACCESS_KEY_ID=
	AWS_SECRET_ACCESS_KEY=
	AWS_DEFAULT_REGION=us-east-1
	AWS_BUCKET=
	AWS_USE_PATH_STYLE_ENDPOINT=false

	PUSHER_APP_ID=
	PUSHER_APP_KEY=
	PUSHER_APP_SECRET=
	PUSHER_APP_CLUSTER=mt1

	MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
	MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
   ```

3. Instale as dependências:
    ```bash
	composer install
	npm install
    ```
    
3. Configure o ambiente:
    ```bash
	cp .env.example .env
	php artisan key:generate
    ```

4. Rode as migrações do banco de dados:
    ```bash
	php artisan migrate
    ```

5. Suba o servidor web:
    ```bash
	php artisan serve
    ```
