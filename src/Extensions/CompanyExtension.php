<?php

namespace Xefi\Faker\EnCa\Extensions;

use Xefi\Faker\Calculators\Luhn;
use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
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

    private array $companies = [
        'Northern Lights Energy Inc.', 'Maple Leaf Logistics Ltd.', 'Great Lakes Shipping Corp.',
        'Prairie Harvest Foods Inc.', 'Rocky Mountain Outfitters Ltd.', 'Atlantic Fisheries Limited',
        'True North Software Inc.', 'Boreal Forest Products Ltd.', 'Pacific Coast Lumber Corp.',
        'Hudson Trading Company Ltd.', 'Laurentian Engineering Inc.', 'Canadian Shield Mining Corp.',
        'Muskoka Cottage Rentals Inc.', 'Okanagan Valley Wineries Ltd.', 'Fundy Tidal Power Inc.',
        'Klondike Gold Exploration Ltd.', 'Niagara Escarpment Wines Inc.', 'Chinook Air Services Ltd.',
        'Red River Agriculture Corp.', 'Cabot Trail Tourism Inc.', 'Algonquin Outdoor Supply Ltd.',
        'Saskatoon Berry Farms Inc.', 'Gulf Islands Ferries Ltd.', 'Yukon Expeditions Inc.',
        'Toronto Harbour Capital Corp.', 'Rideau Consulting Group Inc.', 'Kootenay Timber Ltd.',
        'Northwest Passage Analytics Inc.', 'Grand Banks Seafood Limited', 'Polar Bear Insurance Ltd.',
    ];

    /**
     * Return a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Generate a 9-digit federal Business Number (BN) with a valid Luhn check digit.
     *
     * @return string
     */
    public function businessNumber(): string
    {
        $base = $this->randomizer->getInt(1, 9).$this->randomizer->getBytesFromString('0123456789', 7);

        return (string) Luhn::create((int) $base);
    }
}
