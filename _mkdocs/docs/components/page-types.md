# Introduction
A PageType describes what kind of information an editor has or can provide and displays them on a corresponding template. 
Moreover a PageTypes defines where a page can be located inside the sitemap tree. 

```php
namespace Ixocreate\Cms\PageType;

use Ixocreate\Schema\SchemaProviderInterface;
use Ixocreate\ServiceManager\NamedServiceInterface;

interface PageTypeInterface extends NamedServiceInterface, SchemaProviderInterface
{
    public function label(): string;

    public function allowedChildren(): ?array;

    public function template(): string;
    
    /**
     * inherited from NamedServiceInterface
     */
    public static function serviceName(): string;
    
    /**
     * inherited from SchemaProviderInterface
     */
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface;
}
```

With the following interfaces you can change the default behaviour of a PageType or add extra functionality into them. 

## HandlePageTypeInterface
Through `HandlePageTypeInterface` two things are achieved. First, the certain PageType can be used only once by the editor. 
Second, you can access/find the corresponding `Page`, `Sitemap` and `PageContent` by using the unique `serviceName` from
the PageType.  

```php
namespace Ixocreate\Cms\PageType;

interface HandlePageTypeInterface
{
}
```

## MiddlewarePageTypeInterface
In some situations it is needed to add some extra middleware layers before the requested page will be rendered.
Through `MiddlewarePageTypeInterface` its possible to add a list of PSR15 Middlewares to be processed. For example a
`AuthenticationMiddleware` could be added to check if the user is allowed to view the requested page.

```php
namespace Ixocreate\Cms\PageType;

interface MiddlewarePageTypeInterface
{
    public function middleware(): array;
}
```

## RootPageTypeInterface
Some pages should be only be used as root of the sitemap. This restriction is especially useful in combination with other 
PageType features like `RoutingAwareInterface`.

```php
namespace Ixocreate\Cms\PageType;

interface RootPageTypeInterface extends PageTypeInterface
{
}
```

## RoutingAwareInterface

At some point the default routing behaviour isn't sufficient. With the `RoutingAwareInterface` its possible to alter the
default behaviour. In background the Symfony Router is used (See the corresponding symfony documentation for more details 
about the syntax). Next to the Symfony placeholder options for routing, IXOCREATE also offers some placeholders:

 - `${LANG}`
 - `${LANG:no-default}`
 - `${LANG:no-root-default}`
 - `${REGION}`
 - `${PARENT}`
 - `${SLUG}`
 - `${URI:<applicationUriName>}`

The default routing of `RootPageTypeInterface` is `/`, all other page types `${PARENT}/${SLUG}`
 
 
```php
namespace Ixocreate\Cms\PageType;

interface RoutingAwareInterface
{
    public function routing(): string;
}
```

## TerminalPageTypeInterface

Implementing the `TerminalPageTypeInterface` excludes all children pages from the sitemap overview inside the administration
interface.

```php
namespace Ixocreate\Cms\PageType;

interface TerminalPageTypeInterface
{
}
```
