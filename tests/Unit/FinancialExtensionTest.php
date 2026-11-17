<?php

namespace Xefi\Faker\EnCa\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\EnCa\Extensions\FinancialExtension;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        $financialExtension = new FinancialExtension(new Randomizer());
        $institutionNumbers = (new ReflectionClass($financialExtension))->getProperty('institutionNumbers')->getValue($financialExtension);

        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertMatchesRegularExpression('/^CA\d{2}\d{5}\d{3}\d{7}$/', $iban);
            $this->assertContains(substr($iban, 9, 3), $institutionNumbers);
            $this->assertTrue(Iban::isValid($iban));
        }
    }
}
