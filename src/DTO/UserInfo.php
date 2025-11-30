<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

use Unnits\BankId\Enums\Gender;

readonly class UserInfo
{
    public function __construct(
        public string $customerUuid,
        public string $transactionIdentifier,
        public ?VerifiedClaims $verifiedClaims,
        public ?string $name,
        public ?string $givenName,
        public ?string $familyName,
        public ?string $middleName,
        public ?string $nickname,
        public ?string $preferredUsername,
        public ?string $email,
        public ?bool $emailVerified,
        public ?Gender $gender,
        public ?string $birthDate,
        public ?string $timezone,
        public ?string $locale,
        public ?string $phoneNumber,
        public ?bool $phoneNumberVerified,
        public ?string $updatedAt,
    ) {
        //
    }

    /**
     * @param array<int|string, mixed> $data
     * @return self
     */
    public static function create(array $data): self
    {
        $verifiedClaims = array_key_exists('verified_claims', $data)
            ? VerifiedClaims::create($data['verified_claims'])
            : null;

        $emailVerified = array_key_exists('email_verified', $data)
            ? (bool)$data['email_verified']
            : null;

        $gender = array_key_exists('gender', $data)
            ? Gender::from($data['gender'])
            : null;

        $phoneVerified = array_key_exists('phone_number_verified', $data)
            ? (bool)$data['phone_number_verified']
            : null;

        $updatedAt = array_key_exists('updated_at', $data)
            ? (string)$data['updated_at']
            : null;

        return new self(
            $data['sub'],
            $data['txn'],
            $verifiedClaims,
            $data['name'] ?? null,
            $data['given_name'] ?? null,
            $data['family_name'] ?? null,
            $data['middle_name'] ?? null,
            $data['nickname'] ?? null,
            $data['preferred_username'] ?? null,
            $data['email'] ?? null,
            $emailVerified,
            $gender,
            $data['birthdate'] ?? null,
            $data['zoneinfo'] ?? null,
            $data['locale'] ?? null,
            $data['phone_number'] ?? null,
            $phoneVerified,
            $updatedAt,
        );
    }
}
