<?php

namespace Joferreira\DataMapperOrm\QueryBuilder;

interface QueryBuilderInterface
{
    public function getValues(): array;
    public function __toString();
}
