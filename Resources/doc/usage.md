## Usage of EDFlagBundle

### Add ability to flag content to your entity
Your class must implement FlaggableInterface interface and has to have Flaggable annotation.

````php
<?php
// src/YourBundle/Entity/Article

namespace YourBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ED\FlagBundle\Model\FlaggableInterface;
use ED\FlagBundle\Annotation as ED;

/**
 * @ORM\Entity()
 * @ED\Flaggable(alias="article")
 */
class Article implements FlaggableInterface
{
    /**
    * @var bool 
    */
    private $published;
    
    /**
    * Implement publish function from FlaggableInterface 
    */
    public function publish() {
        $this->published = true;
    }
    
    /**
    * Implement unpublish function from FlaggableInterface 
    */
    public function unpublish() {
        $this->published = false;
    }
}

````

You can use FlaggableEntityTrait that has implemented requirement from FlaggableInterface

````php
````

### Create new flag report

````php
    $flagManager = $container->get('ed_flag.report.manager');
    $report = $flagManager->flagContent('article', 1);
````
