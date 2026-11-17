<?php

namespace Xefi\Faker\EnCa\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Calculators\Luhn;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\EnCa\Extensions\PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameFemale,
            $results
        );
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameMale,
            $results
        );
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstNames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstNames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing(
            $firstNames,
            $results
        );
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing(
            $this->lastName,
            $results
        );
    }

    public function testName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $gender = $this->faker->randomElement([null, PersonExtension::GENDER_MALE, PersonExtension::GENDER_FEMALE]);
            $firstNames = match ($gender) {
                PersonExtension::GENDER_MALE => $this->firstNameMale,
                PersonExtension::GENDER_FEMALE => $this->firstNameFemale,
                default => array_merge($this->firstNameMale, $this->firstNameFemale),
            };

            [$firstName, $lastName] = explode(' ', $this->faker->name($gender), 2);

            $this->assertContains($firstName, $firstNames);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing(
            $titles,
            $results
        );
    }

    public function testTitleByGender(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $this->assertContains($this->faker->title(PersonExtension::GENDER_MALE), $this->titleMale);
            $this->assertContains($this->faker->title(PersonExtension::GENDER_FEMALE), $this->titleFemale);
        }
    }

    public function testSin(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $sin = $this->faker->sin();

            $this->assertMatchesRegularExpression('/^[1-79]\d{8}$/', $sin);
            $this->assertTrue(Luhn::isValid((int) $sin), "SIN {$sin} has an invalid Luhn check digit.");
        }
    }

    public function testFormattedSin(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $sin = $this->faker->sin(true);

            $this->assertMatchesRegularExpression('/^[1-79]\d{2} \d{3} \d{3}$/', $sin);
            $this->assertTrue(Luhn::isValid((int) str_replace(' ', '', $sin)));
        }
    }

    public function testLuhnAcceptsKnownSin(): void
    {
        $this->assertTrue(Luhn::isValid(46454286));
        $this->assertTrue(Luhn::isValid(130692544));
        $this->assertFalse(Luhn::isValid(130692545));
    }
}
