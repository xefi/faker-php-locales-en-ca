<?php

namespace Xefi\Faker\EnCa\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    protected $provinces = [
        'Alberta' => 'AB', 'British Columbia' => 'BC', 'Manitoba' => 'MB', 'New Brunswick' => 'NB',
        'Newfoundland and Labrador' => 'NL', 'Nova Scotia' => 'NS', 'Ontario' => 'ON', 'Prince Edward Island' => 'PE',
        'Quebec' => 'QC', 'Saskatchewan' => 'SK', 'Northwest Territories' => 'NT', 'Nunavut' => 'NU', 'Yukon' => 'YT',
    ];

    protected $postcodeFirstLetters = [
        'AB' => ['T'], 'BC' => ['V'], 'MB' => ['R'], 'NB' => ['E'], 'NL' => ['A'], 'NS' => ['B'],
        'ON' => ['K', 'L', 'M', 'N', 'P'], 'PE' => ['C'], 'QC' => ['G', 'H', 'J'], 'SK' => ['S'],
        'NT' => ['X'], 'NU' => ['X'], 'YT' => ['Y'],
    ];

    protected $postcodeLetters = [
        'A', 'B', 'C', 'E', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z',
    ];

    protected $cities = [
        'Toronto' => 'ON', 'Ottawa' => 'ON', 'Mississauga' => 'ON', 'Hamilton' => 'ON', 'London' => 'ON',
        'Kitchener' => 'ON', 'Windsor' => 'ON', 'Kingston' => 'ON', 'Thunder Bay' => 'ON', 'Sudbury' => 'ON',
        'Montreal' => 'QC', 'Quebec City' => 'QC', 'Gatineau' => 'QC', 'Sherbrooke' => 'QC',
        'Vancouver' => 'BC', 'Victoria' => 'BC', 'Surrey' => 'BC', 'Kelowna' => 'BC', 'Kamloops' => 'BC',
        'Calgary' => 'AB', 'Edmonton' => 'AB', 'Red Deer' => 'AB', 'Lethbridge' => 'AB',
        'Winnipeg' => 'MB', 'Brandon' => 'MB', 'Regina' => 'SK', 'Saskatoon' => 'SK',
        'Halifax' => 'NS', 'Sydney' => 'NS', 'Moncton' => 'NB', 'Fredericton' => 'NB', 'Saint John' => 'NB',
        'St. John\'s' => 'NL', 'Charlottetown' => 'PE', 'Whitehorse' => 'YT', 'Yellowknife' => 'NT', 'Iqaluit' => 'NU',
    ];

    protected $streetTypes = [
        'Street', 'Avenue', 'Road', 'Drive', 'Boulevard', 'Crescent', 'Court', 'Lane', 'Way', 'Place',
        'Trail', 'Gate', 'Line', 'Parkway',
    ];

    protected $streetNames = [
        'Yonge', 'Bloor', 'Queen', 'King', 'Dundas', 'Bay', 'Spadina', 'Jarvis', 'Sherbrooke', 'Granville',
        'Robson', 'Portage', 'Jasper', 'Whyte', 'Barrington', 'Water', 'Wellington', 'Rideau', 'Sparks', 'Elgin',
        'Bank', 'Albert', 'Victoria', 'Main', 'Church', 'Maple', 'Lakeshore', 'Dufferin', 'Bathurst', 'Davie',
        'Cambie', 'Macleod', 'Hastings', 'Princess', 'Brock', 'Simcoe', 'Laurier', 'Champlain', 'Cartier', 'Tecumseh',
    ];

    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_CA';
    }

    /**
     * Return a random province or territory name.
     *
     * @return string
     */
    public function province(): string
    {
        return $this->pickArrayRandomKey($this->provinces);
    }

    /**
     * Return a random two-letter province or territory code.
     *
     * @return string
     */
    public function provinceCode(): string
    {
        return $this->pickArrayRandomElement($this->provinces);
    }

    /**
     * Return a random city.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomKey($this->cities);
    }

    /**
     * Return a random postal code in the "A1A 1A1" format.
     *
     * @return string
     */
    public function postcode(): string
    {
        return $this->postcodeForProvince($this->pickArrayRandomKey($this->postcodeFirstLetters));
    }

    /**
     * Return a random house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 9999);
    }

    /**
     * Return a random street name followed by its street type.
     *
     * @return string
     */
    public function streetName(): string
    {
        return sprintf(
            '%s %s',
            $this->pickArrayRandomElement($this->streetNames),
            $this->pickArrayRandomElement($this->streetTypes)
        );
    }

    /**
     * Return a random street address.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%d %s', $this->houseNumber(), $this->streetName());
    }

    /**
     * Return a full address on one line, following the Canada Post order: street address, city, province code and postal code.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        $city = $this->city();
        $provinceCode = $this->cities[$city];

        return sprintf('%s, %s %s %s', $this->streetAddress(), $city, $provinceCode, $this->postcodeForProvince($provinceCode));
    }

    /**
     * Return a random postal code whose first letter belongs to the given province or territory.
     *
     * @param string $provinceCode
     *
     * @return string
     */
    protected function postcodeForProvince(string $provinceCode): string
    {
        return sprintf(
            '%s%d%s %d%s%d',
            $this->pickArrayRandomElement($this->postcodeFirstLetters[$provinceCode]),
            $this->randomizer->getInt(0, 9),
            $this->pickArrayRandomElement($this->postcodeLetters),
            $this->randomizer->getInt(0, 9),
            $this->pickArrayRandomElement($this->postcodeLetters),
            $this->randomizer->getInt(0, 9)
        );
    }
}
