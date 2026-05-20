<?php

namespace App\Repository;

trait HydrationTrait
{
    protected function hydrateList(
        array $rows,
    ): array {

        return array_map(
            fn(array $row) => $this->hydrate($row),
            $rows,
        );
    }
}