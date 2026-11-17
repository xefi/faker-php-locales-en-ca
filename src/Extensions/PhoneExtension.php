<?php

namespace Xefi\Faker\EnCa\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $indicator = '+1';

    protected array $areaCodes = [
        '204', '226', '236', '249', '250', '289', '306', '343', '365', '403', '416', '418', '431', '437',
        '438', '450', '506', '514', '519', '548', '579', '581', '587', '604', '613', '639', '647', '705',
        '709', '778', '780', '782', '807', '819', '825', '867', '873', '902', '905',
    ];

    protected array $landlineFormats = [
        '{area}{separator}{exchange}{d}{d}{separator}{d}{d}{d}{d}',
        '({area}) {exchange}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '{area}{separator}{exchange}{d}{d}{separator}{d}{d}{d}{d}',
        '({area}) {exchange}{d}{d}{separator}{d}{d}{d}{d}',
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
     * Generate a North American phone number with a Canadian area code and an exchange starting with 2-9.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($format === null) {
            $format = $this->pickArrayRandomElement(array_merge($this->landlineFormats, $this->cellFormats));
        }

        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        $format = str_replace(
            ['{area}', '{exchange}'],
            [$this->pickArrayRandomElement($this->areaCodes), (string) $this->randomizer->getInt(2, 9)],
            $format
        );

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
