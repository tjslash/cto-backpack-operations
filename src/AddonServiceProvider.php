<?php

namespace Tjslash\CtoBackpackOperations;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    use AutomaticServiceProvider;

    protected $vendorName = 'tjslash';
    protected $packageName = 'cto-backpack-operations';
    protected $commands = [];
}
