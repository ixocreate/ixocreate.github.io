#Introduction
A PageType describes what kind of information an editor has or can provide and displays them on a corresponding template. 
Moreover a PageTypes defines where a page can be located inside the sitemap tree. Some page types can be used only as root 
tree, others must be below a specific other page type. 

A basic PageType (for a Root Page) can look like this:

```php
declare(strict_types=1);
namespace App\PageType;

use Ixocreate\Cms\PageType\PageTypeInterface;
use Ixocreate\Cms\PageType\HandlePageTypeInterface;
use Ixocreate\Cms\PageType\RootPageTypeInterface;
use Ixocreate\Schema\Schema;
use Ixocreate\Contract\Schema\BuilderInterface;
use Ixocreate\Contract\Schema\SchemaInterface;

final class HomePageType implements PageTypeInterface, RootPageTypeInterface, HandlePageTypeInterface
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
        return [];
    }
    
    public function provideSchema($name, BuilderInterface $builder, $options = []): SchemaInterface
    {
        return (new Schema())->withElements([
            $builder->create(TabbedGroupElement::class, 'tabs')
                ->withElements([
                    $builder->create(GroupElement::class, 'content')
                        ->withLabel("Content")
                        ->withElements([
                            $builder->create(BlockContainerElement::class, 'content')
                                ->withBlocks(['text'])
                        ])
                ])       
        ]);
    }
}
```
