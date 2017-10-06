# Classes for Doctrine ORM

Here are listed example implementations of EDFlagBundle models for the Doctrine ORM

### FlagReport class
```php
<?php
// src/AppBundle/Entity/FlagReport

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ED\FlagBundle\Entity\FlagReport as BaseFlagReport;

/**
 * @ORM\Entity
 */
class FlagReport extends BaseFlagReport
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $author;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FlagReason")
     */
    protected $reason;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBuncle\Entity\FlagAction", mappedBy="report")
     */
    protected $actions;
}
``` 

### FlagReason class
````php
<?php
// src/AppBundle/Entity/FlagReason

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ED\FlagBundle\Entity\FlagReason as BaseFlagReason;

/**
 * @ORM\Entity
 */
class FlagReason extends BaseFlagReason
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
````

### FlagAction class
```php
<?php
// src/AppBundle/Entity/FlagAction

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ED\FlagBundle\Entity\FlagAction as BaseFlagAction;

/**
 * @ORM\Entity
 */
class FlagAction extends BaseFlagAction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $author;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FlagReport", inversedBy="actions")
     */
    protected $report;
}
``` 