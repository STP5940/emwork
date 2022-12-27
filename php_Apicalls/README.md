## Installation

How to install project

```bash
cd web
composer install -o
cp .env.example .env
```
## Set Environment

Edit file .env

```bash
CONFIG_IMEZONE=Asia/Bangkok
DISPLAY_ERROR=True

DB_DRIVER=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=drivertesting
DB_USERNAME=root
DB_PASSWORD=123456789

KEY_CAPTCHA_PUBLIC=
KEY_CAPTCHA_PRIVATE=

KEY_LINENOTIFY_DEPOSIT=
KEY_LINENOTIFY_WITHDRAW=
KEY_LINENOTIFY_BANK=

KEY_CLIENTID=
KEY_CLIENTSECRET=
KEY_REDIRECTURI= "http://localhost:8888/google/callback"

```

## Start webserver

How to start project
```bash
php start --port 8888
```