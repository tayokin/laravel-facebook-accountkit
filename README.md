# Laravel Facebook Account Kit
[![License](http://img.shields.io/:license-mit-blue.svg)](https://github.com/andela-sakande/PotatoORM/blob/master/LICENSE)

A simple package to make Password-less Login possible in Laravel using [Facebook's Account Kit](https://developers.facebook.com/docs/accountkit).

## Requirements
>php 7.1+

>Composer

>Laravel 5.x

## Installation
To use this package in a Laravel Project, install via [Composer](https://getcomposer.org/)
```bash
$ composer require tayokin/laravel-facebook-accountkit
```
Register the package to the [Service Provider](https://laravel.com/docs/master/providers) in the `config/app.php` file:
```php
'providers' => [
    ...
    Tayokin\FacebookAccountKit\FacebookAccountKitServiceProvider::class,
],

'aliases' => [
    ...
    'FacebookAccountKit' => Tayokin\FacebookAccountKit\Facades\FacebookAccountKitFacade::class,
],
```
You can make of some assets provided in this package to speed up your implementation:
run
```bash
$ php artisan vendor:publish
```

## Usage
Create your app on Facebook following guidelines [here](https://developers.facebook.com/docs/accountkit).

You can view example [here](https://m.dotdev.co/implementing-account-kit-in-laravel-a40fbce516ad).

Update `.env` file with credentials from Facebook:
```env
ACCOUNTKIT_APP_ID=XXXXXXXXXXXX
ACCOUNTKIT_APP_SECRET=XXXXXXXXXXXXXXXXXXXXXXXX
ACCOUNTKIT_REDIRECT_URL=<path/to/endpoint>
```

Define your route in `routes/web.php`. E.g:
```php
Route::get('/<path/to/endpoint>', 'FacebookAccountKitController@endpoint');
```

Import the package in your Controller and use it therein. E.g:
```php
use FacebookAccountKit;
use Illuminate\Http\Request;

class FacebookAccountKitController extends Controller
{
    ...
    public function endpoint(Request $request)
    {
        $accountData = FacebookAccountKit::getAccountDataByCode($request->get('code'));
        ...
    }
}
```
The above return an array similar to this:
```php
[▼
  "id" => "1802782826673865"
  "phoneNumber" => "+38093XXXXXXX",
  "email" => ""
]
```

### Views

Ensure your form has `csrf_token`, E.g:
```html
<input type="hidden" name="state" value="{{ csrf_token() }}" />
```

You can also specify `country`. E.g:
```html
<input type="hidden" name="country_code" value="UA">
```

## Testing

``` bash
$ vendor/bin/phpunit test
```

## Credits

This package is maintained by [Tayokin Max](tayokin.max@gmail.com).

## Change log

Please check out [CHANGELOG](CHANGELOG.md) file for information on what has changed recently.

## License

This package is released under the MIT Licence. See the bundled [LICENSE](LICENSE.md) file for details.
