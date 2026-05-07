<?php

namespace App\Contract\Config;

use Doctrine\Common\Collections\Collection;

interface ConfigInterface
{

    public function getRules(): Collection;

}