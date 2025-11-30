<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

use Unnits\BankId\Enums\IdCardType;

readonly class IdCard
{
    public function __construct(
        public ?IdCardType $type,
        public ?string $description,
        public ?string $country,
        public ?string $number,
        public ?string $validTo,
        public ?string $issuedBy,
        public ?string $issuedAt,
    ) {
        //
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     */
    public static function create(array $data): self
    {
        $description = $data['description'] ?? null;

        assert(is_string($description) || is_null($description));

        return new self(
            array_key_exists('type', $data) ? IdCardType::from(strtolower($data['type'])) : null,
            $description,
            array_key_exists('country', $data) ? strtolower($data['country']) : null,
            $data['number'] ?? null,
            $data['valid_to'] ?? null,
            $data['issuer'] ?? null,
            $data['issue_date'] ?? null,
        );
    }
}
