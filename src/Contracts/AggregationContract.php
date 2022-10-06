<?php

namespace SilentRidge\Statistics\Contracts;

interface AggregationContract
{
    public function aggregate(string $uuid, iterable $data) : void;
}
