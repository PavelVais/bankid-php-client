<?php

declare(strict_types=1);

namespace Unnits\BankId\DTO;

use JsonSerializable;

readonly class SignArea implements JsonSerializable
{
    public function __construct(
        public int $x,
        public int $y,
        public int $width,
        public int $height,
        public int $page,
    ) {
        //
    }

    /**
     * @return array{'x-coordinate': int, 'y-coordinate': int, 'x-dist': int, 'y-dist': int}
     */
    public function jsonSerialize(): array
    {
        return [
            'x-coordinate' => $this->x,
            'y-coordinate' => $this->y,
            'x-dist' => $this->width,
            'y-dist' => $this->height,
            'page' => $this->page,
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     */
    public static function create(array $data): self
    {
        return new self(
            $data['x-coordinate'],
            $data['y-coordinate'],
            $data['x-dist'],
            $data['y-dist'],
            $data['page'],
        );
    }
}
