<?php

namespace Xefi\Faker\EnCa\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\EnCa\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    private const POSTCODE_PATTERN = '[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z] \d[ABCEGHJ-NPRSTV-Z]\d';

    protected array $provinces = [];
    protected array $postcodeFirstLetters = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $addressExtension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($addressExtension);

        $this->provinces = $reflection->getProperty('provinces')->getValue($addressExtension);
        $this->postcodeFirstLetters = $reflection->getProperty('postcodeFirstLetters')->getValue($addressExtension);
        $this->cities = $reflection->getProperty('cities')->getValue($addressExtension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($addressExtension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($addressExtension);
    }

    public function testProvince(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->provinces); $i++) {
            $results[] = $this->faker->unique()->province();
        }

        $this->assertEqualsCanonicalizing(
            array_keys($this->provinces),
            $results
        );
    }

    public function testProvinceCode(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->provinces); $i++) {
            $results[] = $this->faker->unique()->provinceCode();
        }

        $this->assertEqualsCanonicalizing(
            array_values($this->provinces),
            $results
        );

        foreach ($results as $code) {
            $this->assertMatchesRegularExpression('/^[A-Z]{2}$/', $code);
        }
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(
            array_keys($this->cities),
            $results
        );
    }

    public function testCitiesBelongToAProvince(): void
    {
        foreach ($this->cities as $provinceCode) {
            $this->assertContains($provinceCode, $this->provinces);
        }

        $this->assertEqualsCanonicalizing(array_values($this->provinces), array_keys($this->postcodeFirstLetters));
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 200; $i++) {
            $this->assertMatchesRegularExpression('/^'.self::POSTCODE_PATTERN.'$/', $this->faker->postcode());
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $houseNumber = $this->faker->houseNumber();

            $this->assertGreaterThanOrEqual(1, $houseNumber);
            $this->assertLessThanOrEqual(9999, $houseNumber);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $streetName = $this->faker->streetName();
            $separator = strrpos($streetName, ' ');

            $this->assertContains(substr($streetName, 0, $separator), $this->streetNames);
            $this->assertContains(substr($streetName, $separator + 1), $this->streetTypes);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\d{1,4} [A-Za-z ]+$/', $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $fullAddress = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression('/^\d{1,4} [A-Za-z ]+, (.+) ([A-Z]{2}) ('.self::POSTCODE_PATTERN.')$/', $fullAddress);

            preg_match('/, (.+) ([A-Z]{2}) ('.self::POSTCODE_PATTERN.')$/', $fullAddress, $matches);
            [, $city, $provinceCode, $postcode] = $matches;

            $this->assertSame($this->cities[$city], $provinceCode);
            $this->assertContains($postcode[0], $this->postcodeFirstLetters[$provinceCode]);
        }
    }
}
