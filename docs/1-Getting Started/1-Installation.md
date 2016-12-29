# Installation

## Introduction
There are two ways to install the user package.  First is with the JumpGate installer.  By default, the installer creates
a full suite of JumpGate packages, which includes users.  If you are starting from a fresh Laravel install or you used 
the installer with the `--slim` option then you will need to use the following steps to get users working.

## Composer
`composer require jumpgate/users:^2.0`

## Service Providers
Add the following service providers to ``configs/app.php``.

```
    'providers' => [
        ...
        'JumpGate\Users\Providers\UsersServiceProvider',
        ...
    ],
```

## Configs
Once that is done, you can publish the configs.

`php artisan vendor:publish --provider="JumpGate\Users\Providers\UsersServiceProvider"`

This will create a users.php in your `config/jumpgate` folder.

> Make sure to make any changes you need to the config before continuing.  It will determine what roles are
generated when you run the AclSeeder.  If you do not, you will get an error when registering.

## Migrations
The migration files for users are easily loadable once you have added the service provider.

`php artisan migrate`

This will create the users table and all of the acl tables needed for permissions.

## Seeds
Before you do anything, make sure you update `config/jumpgate/users.php` and set your required permissions, roles and 
default users.

```
php artisan db:seed --class=AclSeeder
php artisan db:seed --class=UserStatusSeeder
php artisan db:seed --class=UserSeeder
```

## Model
Make sure you add a model for your `User` model.  It can be empty but should extend `JumpGate\Users\Models\User`.

> Make sure that you have declared your user model in `config/auth.php` in the `providers` array.

## Routes
If you would like to use the included routes, add the following to your `app/Providers/RouteServiceProvider.php` file.

```php
    $providers = [
        ...
        \JumpGate\Users\Http\Routes\Guest::class,
        \JumpGate\Users\Http\Routes\Auth::class,
    ];
```

## Middleware
Included is a middleware for helping with route protection.  You will need to add them to your ``app/Http/Kernel.php``
file.

```php
    protected $routeMiddleware = [
        ...
        'acl'        => \App\Http\Middleware\CheckPermission::class,
    ];
```

To use it in your routes, you would set the parameter as the permission the route requires.

```php
    // You can use it in route groups...
    Route::group(['middleware' => ['acl:administrate-users']], function () {
        ...
    });
    
    // or in a single route...    
    Route::get('/admin/users', [
        'as'         => 'admin.user.index',
        'uses'       => 'Admin\UserController@index',
        'middleware' => 'acl:administrate-users',
    ]);
```

## Menu
This step is completely optional.  But here are some common additions to the menu located in `app/Http/Composers/MenuComposer.php`

```php
    private function generateRightMenu()
    {
        $rightMenu = \Menu::getMenu('rightMenu');
        
        ...
        
        if (auth()->guest()) {
            $rightMenu->link('login', function (Link $link) {
                $link->name = 'Login';
                $link->url = route('auth.login');
            });
            $rightMenu->link('register', function (Link $link) {
                $link->name = 'Register';
                $link->url = route('auth.register');
            });
        } else {
            $rightMenu->dropdown('user', auth()->user()->username, function (DropDown $dropDown) {
                $dropDown->link('user_logout', function (Link $link) {
                    $link->name = 'Logout';
                    $link->url = route('auth.logout');
                });
            });
        }
    }
```
