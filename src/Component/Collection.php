<?php

namespace Component;

use Model\Contract\HasId;

abstract class Collection implements \Iterator, \Countable
{
    abstract protected function buildEntity(): HasId;

    private $pool = [];
    private $index = [];
    private $position = 0;

    /**
     * Add new domain entity, that is constructed using array as values. Each array key
     * will be attempted top match with entity's setter method and provided with
     * the respective array value. It returns the newly created entity.
     */
    public function addBlueprint(array $parameters): HasId
    {
        $instance = $this->buildEntity($parameters);
        $this->populateEntity($instance, $parameters);

        $this->addEntity($instance);

        return $instance;
    }


    /** code that does the actual population of data from the given array in blueprint */
    protected function populateEntity(HasId $instance, array $parameters): void
    {
        foreach ($parameters as $key => $value) {
            $method = 'set' . str_replace('_', '', $key);
            if (method_exists($instance, $method)) {
                $instance->{$method}($value);
            }
        }
    }

    public function addEntity(HasId $entity): void
    {
        $id = $entity->getId();
        $this->pool[] = $entity;
        $key = $this->retrieveLastKey($this->pool);
        $this->index[$id] = $key;
    }

    private function retrieveLastKey(array $list)
    {
        end($list);
        return key($list);
    }

    // implementing Iterator
    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->pool[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->pool[$this->position]);
    }

    // implementing Countable
    public function count()
    {
        return count($this->pool);
    }
}
