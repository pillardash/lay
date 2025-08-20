<?php
use BrickLayer\Lay\Core\View\Domain;
use BrickLayer\Lay\Core\View\Enums\DomainType;

if(!defined("SAFE_TO_INIT_LAY"))
    define("SAFE_TO_INIT_LAY", true);

include_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "foundation.php";

Domain::new()->create(
    id: "api-endpoint",
    builder: \Web\Api\Plaster::class,
    pattern: "api",
    type: DomainType::SPECIAL,
);

Domain::new()->create(
    id: "default",
    builder: \Web\Default\Plaster::class,
    pattern: "*",
    type: DomainType::REGULAR,
);