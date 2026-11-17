<?php

namespace Xefi\Faker\EnCa\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Calculators\Luhn;
use Xefi\Faker\EnCa\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testBusinessNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $bn = $this->faker->businessNumber();

            $this->assertMatchesRegularExpression('/^[1-9]\d{8}$/', $bn);
            $this->assertTrue(Luhn::isValid((int) $bn), "BN {$bn} has an invalid Luhn check digit.");
        }
    }
}
