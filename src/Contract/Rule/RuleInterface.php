<?php

namespace App\Contract\Rule;

interface RuleInterface
{

    public function getGlueOperator(): ?string;
    public function getComparisonOperator(): ?string;
    public function getValue(): ?string;
    public function getMetadata(): string;


}