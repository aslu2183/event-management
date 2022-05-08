
# Event Management

A brief description of what this project does and who it's for


## Demo

Insert gif or link to demo


## Deployment

To deploy this project download the code or using clone the repository to your web server.

Rename .env.example to .env

Then run composer to install the dependencies
```bash
  composer install
```

After installing dependencies , if Application Key is not generated then run this command to generate Key

```bash
  php artisan key:generate
```

Now Application will start to run. Next step need to create database in server and migrate our tables.

For this .env file need to modify database params

```bash
  DB_HOST
  DB_PORT
  DB_DATABASE
  DB_USERNAME
  DB_PASSWORD

```

After that run this command

```bash
  php artisan migrate
```

Now need to seed default user data for testing our code. For this run below command

```bash
  php artisan db:seed --class=UsersSeeder
```

For API Security we need to generate keys. Run Below command for this

```bash
  php artisan passport:install
```

Now our API is ready for testing.
## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_KEY`

`DB_HOST`

`DB_PORT`

`DB_DATABASE`

`DB_USERNAME`

`DB_PASSWORD`
