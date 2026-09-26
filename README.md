# Athive

1 . Suba os containers:

```bash
docker compose up -d
```

2. Copie o arquivo de ambiente padrão para `.env`:

   ```bash
   cp .env.example .env
   ```

3. Acesse o container da aplicação:

   ```bash
   docker compose exec app bash
   ```

4. Instale as dependências PHP com Composer:

   ```bash
   composer install
   ```

5. Gere a chave da aplicação Laravel:

   ```bash
   php artisan key:generate
   ```

6. Instale as dependências JavaScript com npm:

   ```bash
   npm install
   ```

7. Compile os assets do front-end:

   ```bash
   npm run build
   ```

---

## Comandos úteis

* Rodar migrações do banco de dados:

  ```bash
  php artisan migrate
  ```

* Popular banco com seeds:

  ```bash
  php artisan db:seed
  ```

* Parar os containers Docker:

  ```bash
  docker compose down
  ```
