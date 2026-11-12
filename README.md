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

3. Add to "Config/Services.php"

```
    public static function adminAuth($getShared = true)
    {
        if ($getShared) 
        {
            return static::getSharedInstance(__FUNCTION__);
        }

        return new \BasicApp\AdminAuthSettings\Settings\AdminAuthSettings;
    }
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