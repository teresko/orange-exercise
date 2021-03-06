<?php

namespace Model\Service;

use Model\Entity;
use Model\Exception;
use Model\Mapper;

class Memory
{
    private $resourceMapper;
    private $collectionMapper;

    public function __construct(Mapper\Equation $resourceMapper, Mapper\EquationCollection $collectionMapper)
    {
        $this->resourceMapper = $resourceMapper;
        $this->collectionMapper = $collectionMapper;
    }


    public function remember(Entity\Equation $equation): void
    {
        $this->resourceMapper->store($equation);
    }


    public function recallAll(): Entity\EquationCollection
    {
        $collection = new Entity\EquationCollection();
        $this->collectionMapper->fetch($collection);

        return $collection;
    }


    public function recall(int $id): Entity\Equation
    {
        $equation = new Entity\Equation();
        $equation->setId($id);
        try {
            $this->resourceMapper->fetch($equation);
        } catch (Exception\EntityNotFound $exception) {
            // rethrow persistence level exception as domain level exception
            throw new Exception\EquationNotFound();
        }

        return $equation;
    }
}
