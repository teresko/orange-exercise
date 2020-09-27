<?php

namespace Model\Mapper;

use Model\Entity;
use PDO;

class EquationCollection
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    public function fetch(Entity\EquationCollection $collection)
    {
        $sql = "SELECT equationId AS id,
                       expression,
                       result
                  FROM Equations";

        $statement = $this->connection->query($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($statement as $entry) {
            $collection->addBlueprint($entry);
        }
    }
}
