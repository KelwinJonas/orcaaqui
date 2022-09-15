## OrçaAqui

Sistema Demo para seleção da OrçaAqui

## Instalação

1.  Clone o projeto

```shell
git clone https://github.com/KelwinJonas/orcaaqui.git
```

2.  Gere os arquivos de dependências

```shell
composer install
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

6. Entre no sistema com:

email: fornecedor@fornecedor.com
senha: 12345678

email: comprador@comprador.composer
senha: 12345678
