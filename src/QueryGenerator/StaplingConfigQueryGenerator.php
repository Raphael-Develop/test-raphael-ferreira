<?php

namespace App\QueryGenerator;

use App\Entity\StaplingConfig;
use App\Query\QueryInterface;

readonly class StaplingConfigQueryGenerator
{

    public function __construct(
        private ConfigQueryGenerator $configQueryGenerator,
    ) {
    }

    public function generate(StaplingConfig $staplingConfig): QueryInterface
    {
        return $this->configQueryGenerator->generate($staplingConfig);
    }

}
