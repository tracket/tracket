<p align="center">
    <a href="https://github.com/tracket/tracket" target="_blank">Tracket</a>
</p>

## About Tracket

Tracket is an open source framework that allows anyone to create and customize their own job board.

## Documentation

### Installation

Start a new project using composer
```
composer create-project tracket/tracket <project_name>
```

Next, install the docker compose files to run the application locally. You'll be prompted to select which database you want to use. 
```
php artisan docker:install
```

Publish the docker compose files so that you can modify them if needed
```
php artisan docker:publish
```

This will add two new directories to the project root: a `bin` directory that you can use to run scripts, and a `docker` directory where you can customize the docker images and configuration. 

Next, use the `bin/env` script to build the images. 
```
bin/env build
```

Once the images are build, you can use the `bin/env` script to start your application. 
```
bin/env up
```

Next, run the database migrations and default seeders using the `bin/artisan` command
```
bin/artisan migrate --seed
```

Create symlinks for serving the static assets
```
bin/artisan storage:link
```

And finally, compile the assets using the `bin/npm` script
```
bin/npm install
bin/npm run dev
```

Once all these steps have been completed, you should be able to access your job board at http://localhost/

## Contributing

Thank you for considering contributing to the Tracket framework! The contribution guide is coming soon

## License

The Tracket framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
