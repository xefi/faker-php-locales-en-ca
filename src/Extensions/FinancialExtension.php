<?php

namespace Xefi\Faker\EnCa\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    protected array $institutionNumbers = ['001', '002', '003', '004', '006', '010', '016', '039', '614', '815'];

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
     * Canada does not use IBAN: this builds an IBAN-shaped string from a 5-digit transit number,
     * a 3-digit institution number and a 7-digit account number.
     *
     * @param string|null $countryCode
     * @param string|null $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'CA';
        }

        if ($format === null) {
            $format = sprintf(
                '%s%s%s',
                str_repeat('{d}', 5),
                $this->pickArrayRandomElement($this->institutionNumbers),
                str_repeat('{d}', 7)
            );
        }

        return parent::iban($countryCode, $format);
    }
}
