# Quotes Package

Welcome to the Quotes package for Laravel ^7.2, where you can install a complete Quotation package.

This package is designed to be used with the other packages offered by DRMorris IT Services.  For more information, check out https://github.com/DRMorris-IT-Services

[![Latest Stable Version](https://poser.pugx.org/duncanrmorris/quotes/v)](//packagist.org/packages/duncanrmorris/quotes)
[![License](https://poser.pugx.org/duncanrmorris/quotes/license)](//packagist.org/packages/duncanrmorris/quotes)
[![Monthly Downloads](https://poser.pugx.org/duncanrmorris/quotes/d/monthly)](//packagist.org/packages/duncanrmorris/quotes)
[![Total Downloads](https://poser.pugx.org/duncanrmorris/quotes/downloads)](//packagist.org/packages/duncanrmorris/quotes)

## Installation
To use our package, please follow these instructions:

### Step 1
Setup your Laravel application as required.  Then run the command:
````
composer require duncanrmorris/quotes
````

### Step 2
Once the composer install has been completed.  Edit the app config file "./config/app.php" and add in the Service Provider:

````
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        ///
        Illuminate\Validation\ValidationServiceProvider::class,
        duncanrmorris\quotes\QuotesServiceProvider::class,
````

### Step 3
Run the database migrations:
````
php artisan migrate
````

### Step 4
You will now be able to route to the new package via
````
<a href="/quotes">
````

