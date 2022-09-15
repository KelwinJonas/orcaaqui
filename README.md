## OrçaAqui

Sistema Demo para seleção da OrçaAqui

## Instalação

1.  Clone o projeto

```shell
git clone https://gitfront.io/r/user-9772693/6Eu1c2AKtc6X/orcaaqui.git
```

2.  Gere os arquivos de dependências

```shell
composer install
npm install
```

3.  Configure o .env com os dados para o banco PostgreSQL

4.  Crie as tabelas do banco de dados

```
php artisan migrate
```

5. Popule o banco de dados

```
php artisan db:seed
```

6. Inicie o sistema

```
npm run dev
php artisan serve
```

7. Entre no sistema com:

email: fornecedor@fornecedor.com
senha: 12345678

email: comprador@comprador.com
senha: 12345678
