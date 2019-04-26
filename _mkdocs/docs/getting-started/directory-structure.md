#Root directory
## The <i>bootstrap</i> directory
This directory houses all bootstrap relevant information and configurations for your application. 
For environment specific configurations you can use the `local` directory.

## The <i>data</i> directory
The `data` directory contains your file based cached as well as any editorial file. This directory will be created
by the application (if not yet created) and isn't commited to git. Therefor you might need to create this directory 
manually (in case of permission problems) and ensure it is writable by your web server. 

## The <i>public</i> directory
The public directory contains the index.php file, which is the HTTP entry point for your application. You might want 
to symlink your assets such as images, JavaScript, and CSS as well as your editorial media. 

## The <i>resources</i> directory
The `resource` directory contains some varying files which are needed by the application like migration files, raw 
 assets (SASS, LESS, TypeScript etc.). Moreover it is the default location for generated php files for performance 
 optimization such as generated factories and proxy classes.

## The <i>src</i> directory
The `src` directory contains the source code of your application. See the section below for more detailed information.

## The <i>templates</i> directory
This directory contains all your template files.

## The <i>tests</i> directory
The `tests` directory contains your phpunit tests. 

## The <i>vendor</i> directory
The `vendor` directory contains all installed composer dependencies.

#Source (src) directory
This directory contains by default two directories: `App` and `Admin`. 

In most cases you will only work with `App` but in some cases you might want to add only Admin-relevant classes into
the `Admin` directory.

Every class inside the following directories is added automatically into the servicemanager as long the respectively 
interface is implemented.

## The <i>Action</i> directory
Available for `App` and `Admin`. Classes need to implement `\Psr\Http\Server\MiddlewareInterface`

## The <i>Block</i> directory
Available for `App`. Classes need to implement `\Ixocreate\Cms\Block\BlockInterface`

## The <i>Console</i> directory
Available for `App` and `Admin`. Classes need to implement `\Ixocreate\Application\Console\CommandInterface`

## The <i>Image</i> directory
Available for `App`. Classes need to implement `\Ixocreate\Media\ImageDefinitionInterface`

## The <i>Media</i> directory
Available for `App`. Classes need to implement `\Ixocreate\Media\Handler\HandlerInterface`

## The <i>Middleware</i> directory
Available for `App` and `Admin`. Classes need to implement `\Psr\Http\Server\MiddlewareInterface`

## The <i>PageType</i> directory
Available for `App`. Classes need to implement `\Ixocreate\Cms\PageType\PageTypeInterface`

## The <i>Registry</i> directory
Available for `Admin`. Classes need to implement `\Ixocreate\Registry\RegistryEntryInterface`

## The <i>Repository</i> directory
Available for `App` and `Admin`. Classes need to implement `\Ixocreate\Database\Repository\RepositoryInterface`

## The <i>Resource</i> directory
Available for `App` and `Admin`. Classes need to implement `\Ixocreate\Resource\ResourceInterface`

## The <i>Subscriber</i> directory
Available for `App`. Classes need to implement `\Ixocreate\Event\Subscriber\SubscriberInterface`

## The <i>Type</i> directory
Available for `App` and `Admin`. Classes need to implement `\Ixocreate\Type\TypeInterface`

