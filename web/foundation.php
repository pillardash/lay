<?php

use BrickLayer\Lay\Core\View\DomainResource;

$res = DomainResource::get();

$site_name = \BrickLayer\Lay\Core\App::new()->name['short'];

DomainResource::set_res(
    "copyright",
    "&copy; " . date("Y") . " | All Rights Reserved By <a href='{$res->domain->domain_uri}'>$site_name</a>"
);
