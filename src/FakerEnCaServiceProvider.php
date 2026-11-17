<?php

namespace Xefi\Faker\EnCa;

use Xefi\Faker\EnCa\Extensions\AddressExtension;
use Xefi\Faker\EnCa\Extensions\ColorsExtension;
use Xefi\Faker\EnCa\Extensions\CompanyExtension;
use Xefi\Faker\EnCa\Extensions\FinancialExtension;
use Xefi\Faker\EnCa\Extensions\PersonExtension;
use Xefi\Faker\EnCa\Extensions\PhoneExtension;
use Xefi\Faker\EnCa\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerEnCaServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
