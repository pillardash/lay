<?php
namespace Web\Api;

use BrickLayer\Lay\Core\Api\ApiCast;

class Plaster extends ApiCast
{
    protected function pre_hook(): void
    {
        $this->set_version("v1");

        $this->group_limit(60, "1 minute");
    }
}