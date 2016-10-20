# Political Match Maker
Site using they work for you API to make a mock dating app to find your perfect politician. Still in early stages of development. It will run on a Laravel Homestead install. 

## Notes on site
 - Base view and one or two pages created in `resources/views`
 - Migrations for creating some of the tables in `database/migrations`
 - Classes in `/app` a mixture of eloquent models and other classes - needs seperating out
 - `app/Console/Commands/GetData.php` runs a command to pull data from They Work For You - an API key needs to be present in config for it to run
 - `app/HTTP/Controllers` contains controllers - CollectController commented out as it can trigger a lot of API calls


## Laravel License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
