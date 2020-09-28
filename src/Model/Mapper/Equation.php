<?php

namespace Model\Mapper;

use Model\Entity;
use Model\Exception;
use PDO;

class Equation
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function store(Entity\Equation $equation): void
    {
        $sql = 'INSERT INTO Equations(expression, result, createdOn)
                     VALUES (:expression, :result, :timestamp)';

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':expression', $equation->getExpression(), PDO::PARAM_STR);
        $statement->bindValue(':result', $equation->getResult(), PDO::PARAM_STR);
        $statement->bindValue(':timestamp', time(), PDO::PARAM_INT);

        $statement->execute();
        $equation->setId($this->connection->lastInsertId());
    }

    public function fetch(Entity\Equation $equation): void
    {
        $sql = 'SELECT expression,
                       result
                  FROM Equations
                 WHERE equationId = :id';

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $equation->getId(), PDO::PARAM_INT);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($data)) {
            throw new Exception\EntityNotFound();
        }

        $equation->setExpression($data['expression']);
        $equation->setResult($data['result']);
    }
}
