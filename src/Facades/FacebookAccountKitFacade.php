<?php

declare(strict_types=1);

namespace Tayokin\FacebookAccountKit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class FacebookAccountKitFacade.
 */
class FacebookAccountKitFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'AccountKit';
    }
}
