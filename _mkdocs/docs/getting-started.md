# Setup
## Installing IXOCREATE
To create a new IXOCREATE application make sure you have Composer installed on your machine and you are using 
PHP 7.1 or newer.

Create a new project by running this command in your terminal:

```bash
$ composer create-project ixocreate/ixocreate <project_name>
$ cd <project_name>
```

## Configuration

### Directory permissions
The directory `data` should be writable by your web server.

### Database
Before you continue with the setup instruction publish all available migrations by running following in your terminal:
```bash
php ixocreate publish:run migration
```
Create a new database on your mysql server - you will need the database name and credentials later.

### Web server configuration
You should configure your web server's `document_root` to be the `public` directory. 
The index.php in this directory serves as entering point for all HTTP requests.

#### PHP's internal web server
One way to develop your IXOCREATE application is to use PHP's internal web server. 
```bash
cd public
php -S localhost:8000
```

#### Apache
The minimum configuration to get your application running under Apache is:
```
Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]

```

#### Nginx
The minimum configuration to get your application running under Nginx is:
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### Project setup
```bash
$ php ixocreate setup
```
The setup console command will guide you through the basic settings needed to run the application.

```bash
$ php ixocreate admin:create-user <your_email> admin
```

Afterwards you can surf to the administration interface by surfing to `<project_url>/admin`

# Creating PageType

## HomePageType
```php
declare(strict_types=1);
namespace App\PageType;

use Ixocreate\Cms\PageType\PageTypeInterface;
use Ixocreate\Cms\PageType\HandlePageTypeInterface;
use Ixocreate\Cms\PageType\RootPageTypeInterface;
use Ixocreate\Schema\Schema;
use Ixocreate\Contract\Schema\BuilderInterface;
use Ixocreate\Contract\Schema\SchemaInterface;

final class HomePageType implements RootPageTypeInterface, HandlePageTypeInterface, PageTypeInterface
{
    public static function serviceName(): string 
    {
        return 'home';
    }

    public function label(): string
    {
        return 'Home';
    }
    
    public function template(): string
    {
        return "page::home";
    }
    
    public function allowedChildren(): ?array
    {
        return ['default'];
    }
    
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface
    {
        return new Schema();
    }
}

```

## DefaultPageType
```php
declare(strict_types=1);
namespace App\PageType;

use Ixocreate\Cms\PageType\PageTypeInterface;
use Ixocreate\Cms\PageType\HandlePageTypeInterface;
use Ixocreate\Cms\PageType\RootPageTypeInterface;
use Ixocreate\Schema\Schema;
use Ixocreate\Contract\Schema\BuilderInterface;
use Ixocreate\Contract\Schema\SchemaInterface;

final class DefaultPageType implements RootPageTypeInterface, PageTypeInterface
{
    public static function serviceName(): string 
    {
        return 'default';
    }

    public function label(): string
    {
        return 'Default';
    }
    
    public function template(): string
    {
        return "page::default";
    }
    
    public function allowedChildren(): ?array
    {
        return ['default'];
    }
    
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface
    {
        return new Schema();
    }
}

```

# Creating Block

# Templates



