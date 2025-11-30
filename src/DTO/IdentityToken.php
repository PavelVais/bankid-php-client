<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

use DateTime;
use Exception;
use Unnits\BankId\Enums\AcrValue;

readonly class IdentityToken
{
    public function __construct(
        public string $sub,
        public DateTime $expiresAt,
        public DateTime $issuedAt,
        public ?DateTime $authenticatedAt,
        public string $iss,
        public string $aud,
        public AcrValue $acr,
        public string $jti,
        public string $bankId,
        public ?StructuredScope $structuredScope,
        public ?string $nonce = null,
        public ?string $sid = null,
        public ?string $name = null,
        public ?string $rawValue = null,
    ) {
        //
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     * @throws Exception
     */
    public static function create(array $data, ?string $rawValue = null): self
    {
        return new self(
            sub: $data['sub'],
            expiresAt: new DateTime(sprintf('@%d', $data['exp'])),
            issuedAt: new DateTime(sprintf('@%d', $data['iat'])),
            authenticatedAt: array_key_exists('auth_time', $data)
                ? new DateTime(sprintf('@%d', $data['auth_time']))
                : null,
            iss: $data['iss'],
            aud: $data['aud'],
            acr: AcrValue::from($data['acr']),
            jti: $data['jti'],
            bankId: $data['bank_id'],
            structuredScope: array_key_exists('structured_scope', $data)
                ? StructuredScope::create($data['structured_scope'])
                : null,
            nonce: $data['nonce'] ?? null,
            sid: $data['sid'] ?? null,
            name: $data['name'] ?? null,
            rawValue: $rawValue,
        );
    }
}
