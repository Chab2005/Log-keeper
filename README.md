### Log-keeper



## Requirements

- PHP ^8.3
- Composer
- Node.js and npm
- SQLite support for PHP (default database driver used by this project)

## Installation

1. Clone the repository and move into it.
2. Install PHP dependencies:
   ```sh
   composer install
   ```
3. Copy the environment file and generate the application key:
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. Create the SQLite database file (the project uses `DB_CONNECTION=sqlite` by default):
   ```sh
   touch database/database.sqlite
   ```
5. Run the database migrations:
   ```sh
   php artisan migrate
   ```
6. Install JavaScript dependencies:
   ```sh
   npm install
   ```

## Running the project

Start the application (server, queue listener and Vite dev server together):

```sh
composer run dev
```

Alternatively, run the pieces separately:

```sh
php artisan serve
npm run dev
```

For a production build of the frontend assets:

```sh
npm run build
```

## Running tests

```sh
composer test
```

or directly:

```sh
php artisan test
```

## Other information

- Framework: Laravel 13
- Frontend tooling: Vite, TypeScript, Tailwind CSS 4
- Default database: SQLite (`database/database.sqlite`)
- Environment configuration lives in `.env`, based on `.env.example`
