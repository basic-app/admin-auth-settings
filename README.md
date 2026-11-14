# Basic App

##Admin Auth Settings

### Install

1. Run

```
composer require basic-app/admin-auth-settings

```
2. Add to "Config/Routes.php"

```
helper(['admin_auth_settings']);

admin_auth_settings_routes($routes);
```

3. Add to ".env"

```
AdminAuth.credentialClass="BasicApp\AdminAuthSettings\Services\AdminAuth"
```

4. Add to "Config/Filters.php"

```
    public array $aliases = [
        /* other aliases */
        'admin'         => \BasicApp\AdminAuthSettings\Filters\AdminFilter::class
    ];
    
    public array $filters = [
        /* other filters */
        'admin' => [
            'before' => ['admin', 'admin/*']
        ]
    ];

```

5. Run

```
php spark db:seed "BasicApp\AdminAuthSettings\Database\Seeds\DemoSeeder"
```

Access backend by opening `http://localhost:8080/index.php/admin` in a browser.
```
login: admin
password: admin
```

You need to restart the Spark server so the new settings take effect.