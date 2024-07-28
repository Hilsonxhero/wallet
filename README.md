# WALLET APP

### Installation With Docker

```sh
git clone https://github.com/Hilsonxhero/wallet.git

# set environment
copy .env.example .env

# install composer
composer install

# Start docker in os
./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan storage:link

./vendor/bin/sail artisan migrate

./vendor/bin/sail artisan passport:keys

./vendor/bin/sail php artisan passport:client --personal

./vendor/bin/sail npm i

```

```
After creating your personal access client, place the client's ID and plain-text secret value in your application's .env file:
```

### ENV DATA

```sh
# passport personal type

PASSPORT_CLIENT_ID=1
PASSPORT_CLIENT_SECRET=""

VITE_APP_API_URL="http://127.0.0.1/api/"

PAYPAL_PURCHASE="http://127.0.0.1/purchase/paypal/"
PAYPAL_CALLBACK="http://127.0.0.1/api/application/purchase/paypal/callback"
PAYPAL_ID=""

PERFECT_PURCHASE="http://127.0.0.1/purchase/perfect/"
PERFECT_CALLBACK="http://127.0.0.1/api/application/purchase/perfect/callback"
PERFECT_ID=""

WEBMONEY_PURCHASE="http://127.0.0.1/purchase/webmoney/"
WEBMONEY_CALLBACK="http://127.0.0.1/api/application/purchase/webmoney/callback"
WEBMONEY_ID=""

FRONT_ENDPOINT=http://127.0.0.1/
FRONT_CHECKOUT_CALLBACK=checkout/confirmation/payment/

```

## ADMIN PANEL ROUTE FOR CREATE WALLETS

```sh
http://127.0.0.1/panel/management/wallets
```
