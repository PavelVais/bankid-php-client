<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

use Unnits\BankId\Enums\Gender;

readonly class Profile
{
    /**
     * @param string|null $customerUuid
     * @param string|null $givenName
     * @param string|null $familyName
     * @param string|null $titlePrefix
     * @param string|null $titleSuffix
     * @param Gender|null $gender
     * @param int|null $age
     * @param string|null $birthDate
     * @param string|null $birthNumber
     * @param string|null $birthPlace
     * @param string|null $birthCountry
     * @param string|null $primaryNationality
     * @param string[]|null $nationalities
     * @param string|null $maritalStatus
     * @param bool|null $majority
     * @param string|null $email
     * @param string|null $phoneNumber
     * @param bool|null $limitedLegalCapacity
     * @param bool|null $pep
     * @param Address[]|null $addresses
     * @param IdCard[]|null $idCards
     * @param string[]|null $paymentAccounts
     * @param string[]|null $paymentAccountsDetails
     * @param int|null $updatedAt
     * @param ?VerifiedClaims $verifiedClaims
     * @param string|null $transactionIdentifier
     */
    public function __construct(
        public ?string $customerUuid,
        public ?string $givenName,
        public ?string $familyName,
        public ?string $titlePrefix,
        public ?string $titleSuffix,
        public ?Gender $gender,
        public ?int $age,
        public ?string $birthDate,
        public ?string $birthNumber,
        public ?string $birthPlace,
        public ?string $birthCountry,
        public ?string $primaryNationality,
        public ?array $nationalities,
        public ?string $maritalStatus,
        public ?bool $majority,
        public ?string $email,
        public ?string $phoneNumber,
        public ?bool $limitedLegalCapacity,
        public ?bool $pep,
        public ?array $addresses,
        public ?array $idCards,
        public ?array $paymentAccounts,
        public ?array $paymentAccountsDetails,
        public ?int $updatedAt,
        public ?VerifiedClaims $verifiedClaims,
        public ?string $transactionIdentifier = null,
    ) {
        //
    }

    /**
     * @param array<int|string, mixed> $data
     * @return self
     */
    public static function create(array $data): self
    {
        $addresses = array_map(
            fn (array $address) => Address::create($address),
            $data['addresses'] ?? []
        );

        $idCards = array_map(
            fn (array $idCard) => IdCard::create($idCard),
            $data['idcards'] ?? []
        );

        $nationalities = array_map(
            fn($nationality) => strtolower($nationality),
            $data['nationalities'] ?? []
        );

        return new self(
            $data['sub'] ?? null,
            $data['given_name'] ?? null,
            $data['family_name'] ?? null,
            $data['title_prefix'] ?? null,
            $data['title_suffix'] ?? null,
            array_key_exists('gender', $data) ? Gender::from($data['gender']) : null,
            $data['age'] ?? null,
            $data['birthdate'] ?? null,
            $data['birthnumber'] ?? null,
            $data['birthplace'] ?? null,
            array_key_exists('birthcountry', $data) ? strtolower($data['birthcountry']) : null,
            array_key_exists('primary_nationality', $data) ? strtolower($data['primary_nationality']) : null,
            $nationalities,
            $data['maritalstatus'] ?? null,
            $data['majority'] ?? null,
            $data['email'] ?? null,
            $data['phone_number'] ?? null,
            $data['limited_legal_capacity'] ?? null,
            $data['pep'] ?? null,
            $addresses,
            $idCards,
            $data['paymentAccounts'] ?? null,
            $data['paymentAccountsDetails'] ?? null,
            $data['updated_at'] ?? null,
            array_key_exists('verified_claims', $data) ? VerifiedClaims::create($data['verified_claims']) : null,
            $data['txn'] ?? null,
        );
    }
}
