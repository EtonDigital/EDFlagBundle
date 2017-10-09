## Install
#### Add composer dependency
    composer require ed/flag-bundle
    
#### Register bundle
The bundle must be added to your 'AppKernel'

```php
# app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...
        new ED\FlagBundle\EDFlagBundle(),
        // ...
    );
}
```

#### Import routing (Optional)

Add EDFlagBundle's routing to your application with an optional routing prefix.
```yaml
# app/config/routing.yml

# ...
ed_flag:
    resource: "@EDFlagBundle/Resources/config/routing.xml"
    prefix: /optional_routing_prefix
# ...
```