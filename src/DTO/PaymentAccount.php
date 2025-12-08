<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

readonly class PaymentAccount
{
    public function __construct(
        public ?string $iban,
        public ?string $currency,
    ) {
        //
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     */
    public static function create(array $data): self
    {
        return new self(
            $data['iban'] ?? null,
            $data['currency'] ?? null
        );
    }
}
