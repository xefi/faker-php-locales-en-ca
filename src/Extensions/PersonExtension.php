<?php

namespace Xefi\Faker\EnCa\Extensions;

use Xefi\Faker\Calculators\Luhn;
use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
{
    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_CA';
    }

    protected $firstNameMale = [
        'Liam', 'Noah', 'William', 'Lucas', 'Benjamin', 'Oliver', 'Ethan', 'Jacob', 'Logan', 'Owen',
        'Nathan', 'Samuel', 'Alexander', 'Thomas', 'Jack', 'Mason', 'Hunter', 'Carter', 'Connor', 'Tyler',
        'Dylan', 'Brandon', 'Ryan', 'Matthew', 'Justin', 'Kyle', 'Cole', 'Wyatt', 'Gavin', 'Brett',
        'Wayne', 'Gordon', 'Bryce', 'Darren', 'Kevin', 'Marc', 'Luc', 'Gabriel', 'Mathieu', 'Sidney',
    ];

    protected $firstNameFemale = [
        'Olivia', 'Emma', 'Charlotte', 'Amelia', 'Sophia', 'Ava', 'Chloe', 'Emily', 'Abigail', 'Hannah',
        'Madison', 'Avery', 'Brooklyn', 'Hailey', 'Megan', 'Brittany', 'Ashley', 'Jennifer', 'Stephanie', 'Kayla',
        'Paige', 'Taylor', 'Morgan', 'Courtney', 'Jessica', 'Sarah', 'Lauren', 'Rachel', 'Heather', 'Shannon',
        'Natalie', 'Victoria', 'Claire', 'Evelyn', 'Nora', 'Brianna', 'Julie', 'Isabelle', 'Nathalie', 'Geneviève',
    ];

    protected $lastName = [
        'Smith', 'Brown', 'Tremblay', 'Martin', 'Roy', 'Wilson', 'MacDonald', 'Gagnon', 'Johnson', 'Taylor',
        'Côté', 'Campbell', 'Anderson', 'Leblanc', 'Lee', 'Jones', 'White', 'Williams', 'Miller', 'Thompson',
        'Gauthier', 'Young', 'Morin', 'Bouchard', 'Scott', 'Stewart', 'Murray', 'Wong', 'Robinson', 'Clark',
        'Reid', 'Ross', 'Fraser', 'MacLeod', 'Chan', 'Singh', 'Patel', 'Bélanger', 'Thomson', 'Henderson',
    ];

    protected $titleMale = ['Mr.', 'Dr.', 'Prof.', 'Rev.', 'Hon.'];

    protected $titleFemale = ['Ms.', 'Mrs.', 'Miss', 'Dr.', 'Prof.', 'Rev.', 'Hon.'];

    /**
     * Generate a Social Insurance Number (SIN) with a valid Luhn check digit.
     *
     * @param bool $formatted Whether to group the digits as "NNN NNN NNN".
     *
     * @return string
     */
    public function sin(bool $formatted = false): string
    {
        $base = $this->pickArrayRandomElement(['1', '2', '3', '4', '5', '6', '7', '9'])
            .$this->randomizer->getBytesFromString('0123456789', 7);

        $sin = (string) Luhn::create((int) $base);

        return $formatted ? implode(' ', str_split($sin, 3)) : $sin;
    }
}
