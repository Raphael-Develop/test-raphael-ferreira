<?php

namespace App\Entity;

use App\Contract\Rule\RuleInterface;
use App\Enum\MetadataEnumSign;
use App\Repository\SignRuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SignRuleRepository::class)]
class SignRule implements RuleInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $glueOperator = null;

    #[ORM\Column(length: 255)]
    private ?string $comparisonOperator = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\Column(type: 'boolean')]
    private bool $excludeFromGeneration = false;

    #[ORM\Column(type: 'string', length: 255, enumType: MetadataEnumSign::class)]
    private MetadataEnumSign $metadata;

    #[ORM\ManyToOne(inversedBy: 'signRules')]
    private ?SignConfig $signConfig = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGlueOperator(): ?string
    {
        return $this->glueOperator;
    }

    public function setGlueOperator(string $glueOperator): static
    {
        $this->glueOperator = $glueOperator;

        return $this;
    }

    public function getComparisonOperator(): ?string
    {
        return $this->comparisonOperator;
    }

    public function setComparisonOperator(string $comparisonOperator): static
    {
        $this->comparisonOperator = $comparisonOperator;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getMetadata(): string
    {
        return $this->metadata->value;
    }

    public function setMetadata(MetadataEnumSign $metadata): static
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function getSignConfig(): ?SignConfig
    {
        return $this->signConfig;
    }

    public function setSignConfig(?SignConfig $signConfig): static
    {
        $this->signConfig = $signConfig;

        return $this;
    }

    public function isExcludeFromGeneration(): bool
    {
        return $this->excludeFromGeneration;
    }

    public function setExcludeFromGeneration(bool $excludeFromGeneration): void
    {
        $this->excludeFromGeneration = $excludeFromGeneration;
    }

}
