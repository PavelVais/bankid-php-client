<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

use Unnits\BankId\Enums\AddressType;

readonly class Address
{
    public function __construct(
        public ?AddressType $type,
        public ?string $streetName,
        public ?string $streetNumber,
        public ?string $evidenceNumber,
        public ?string $buildingApartment,
        public ?string $city,
        public ?string $cityArea,
        public ?string $zipCode,
        public ?string $country,
        public ?string $ruianReference,
    ) {
        //
    }

    /**
     * @param array<string, string> $data
     * @return self
     */
    public static function create(array $data): self
    {
        return new self(
            type: array_key_exists('type', $data) ? AddressType::from(strtolower($data['type'])) : null,
            streetName: $data['street'] ?? null,
            streetNumber: $data['streetnumber'] ?? null,
            evidenceNumber: $data['evidencenumber'] ?? null,
            buildingApartment: $data['buildingapartment'] ?? null,
            city: $data['city'] ?? null,
            cityArea: $data['cityarea'] ?? null,
            zipCode: $data['zipcode'] ?? null,
            country: array_key_exists('country', $data) ? strtolower($data['country']) : null,
            ruianReference: $data['ruian_reference'] ?? null,
        );
    }
}
