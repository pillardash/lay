<?php
const SAFE_TO_INIT_LAY = true;
include_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "foundation.php";

\BrickLayer\Lay\Core\View\Domain::new()->index("default");

include_once \BrickLayer\Lay\Core\Server::new()->web . "index.php";
