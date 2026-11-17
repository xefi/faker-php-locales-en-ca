<?php

namespace Xefi\Faker\EnCa\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\EnCa\Extensions\PhoneExtension;

final class PhoneExtensionTest extends TestCase
{
    protected array $areaCodes = [];

    protected function setUp(): void
    {
        parent::setUp();

        $phoneExtension = new PhoneExtension(new Randomizer());
        $this->areaCodes = (new ReflectionClass($phoneExtension))->getProperty('areaCodes')->getValue($phoneExtension);
    }

    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $number = $this->faker->dashedPhoneNumber();

            $this->assertMatchesRegularExpression('/^(\d{3}-|\(\d{3}\) )[2-9]\d{2}-\d{4}$/', $number);
            $this->assertContains(substr(preg_replace('/\D/', '', $number), 0, 3), $this->areaCodes);
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^(\d{3}|\(\d{3}\) )[2-9]\d{6}$/', $this->faker->cellPhoneNumber());
        }
    }

    public function testLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^(\d{3} |\(\d{3}\) )[2-9]\d{2} \d{4}$/', $this->faker->spacedLandlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+1-(\d{3}-|\(\d{3}\) )[2-9]\d{2}-\d{4}$/', $this->faker->dashedIndicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+1 (\d{3} |\(\d{3}\) )[2-9]\d{2} \d{4}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
        }
    }
}
