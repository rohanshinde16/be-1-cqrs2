<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

use App\Shared\Domain\Bus\Command;
use Symfony\Component\Uid\Uuid;

class GetPostCommand implements Command
{
    public function __construct(
        public readonly ?Uuid $id
    ) {
    }
}
