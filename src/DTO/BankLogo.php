<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

readonly class BankLogo
{
    public function __construct(
        public string $id,
        public string $url,
        public int $width,
        public int $height,
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
            id: $data['id'],
            url: $data['url'],
            width: $data['width'],
            height: $data['height'],
        );
    }
}
