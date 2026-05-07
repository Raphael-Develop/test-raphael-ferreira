<?php

namespace App\QueryGenerator;

use App\Contract\Config\ConfigInterface;
use App\Contract\Rule\RuleInterface;
use App\Query\QueryBuilder;
use App\Query\QueryInterface;

class ConfigQueryGenerator
{

    private const VALUE_SEPARATOR = ' OU ';

    public function __construct(
        private readonly QueryBuilder $builder,
    ) {
    }

    public function generate(ConfigInterface $staplingConfig): QueryInterface
    {
        $this->builder->reset();
        $rules = $staplingConfig->getRules();

        foreach ($rules as $rule) {
            $this->processRule($rule);
        }

        return $this->builder->buildQuery();
    }

    private function processRule(RuleInterface $rule): void
    {
        $values = $this->parseRuleValues($rule);

        if ($this->hasMultipleValues($values)) {
            $this->buildMultiValueQuery($rule, $values);
        } else {
            $this->buildSingleValueQuery($rule, $values[0]);
        }
    }

    private function parseRuleValues(RuleInterface $rule): array
    {
        return explode(self::VALUE_SEPARATOR, (string) $rule->getValue());
    }

    private function hasMultipleValues(array $values): bool
    {
        return count($values) > 1;
    }

    private function buildMultiValueQuery(RuleInterface $rule, array $values): void
    {
        $glueOperator = $rule->getGlueOperator();
        $comparisonOperator = $rule->getComparisonOperator();

        $this->builder->$glueOperator(
            $this->builder->or(
                function () use ($comparisonOperator, $rule, $values): void {
                    foreach ($values as $value) {
                        $this->builder->$comparisonOperator($rule->getMetadata(), $value);
                    }
                }
            )
        );
    }

    private function buildSingleValueQuery(RuleInterface $rule, string $value): void
    {
        $glueOperator = $rule->getGlueOperator();
        $comparisonOperator = $rule->getComparisonOperator();

        $this->builder->$glueOperator(
            $this->builder->$comparisonOperator($rule->getMetadata(), $value)
        );
    }

}