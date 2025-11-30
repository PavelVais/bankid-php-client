<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

use Exception;
use JsonSerializable;
use Unnits\BankId\Enums\ResponseType;
use Unnits\BankId\Enums\Scope;

readonly class RequestObject implements JsonSerializable
{
    /**
     * @param int $maxAge
     * @param string $acrValues
     * @param Scope[] $scopes
     * @param ResponseType $responseType
     * @param StructuredScope $structuredScope
     * @param string $txn
     * @param string $state
     * @param string $nonce
     * @param string $clientId
     * @param string|null $bankId
     */
    public function __construct(
        public int $maxAge,
        public string $acrValues,
        public array $scopes,
        public ResponseType $responseType,
        public StructuredScope $structuredScope,
        public string $txn,
        public string $state,
        public string $nonce,
        public string $clientId,
        public ?string $bankId = null,
    ) {
        //
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $json = [
            'max_age' => $this->maxAge,
            'bank_id' => $this->bankId,
            'acr_values' => $this->acrValues,
            'scope' => implode(' ', array_map(
                fn (Scope $scope) => $scope->value,
                $this->scopes
            )),
            'response_type' => $this->responseType,
            'structured_scope' => $this->structuredScope->jsonSerialize(),
            'txn' => $this->txn,
            'state' => $this->state,
            'nonce' => $this->nonce,
            'client_id' => $this->clientId,
        ];

        if ($this->bankId !== null) {
            $json['bank_id'] = $this->bankId;
        }

        return $json;
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     * @throws Exception
     */
    public static function create(array $data): self
    {
        return new self(
            maxAge: $data['max_age'],
            acrValues: $data['acr_values'],
            scopes: array_filter(array_map(
                fn (string $item) => Scope::tryFrom($item),
                explode($data['scope'], ' ')
            )),
            responseType: $data['response_type'],
            structuredScope: StructuredScope::create($data['structured_scope']),
            txn: $data['txn'],
            state: $data['state'],
            nonce: $data['nonce'],
            clientId: $data['client_id'],
            bankId: $data['bank_id'],
        );
    }
}
