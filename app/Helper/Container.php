<?php

namespace app\Helper;

class Container {
    private array $binding = [];

    public function set(string $id, callable $factory): void {
        $this->binding[$id] = $factory;
    }

    public function get(string $id) {
        if (!isset($this->binding[$id])) {
            throw new \Exception('Target binding [$id] does not exist.');
        }

        $factory = $this->binding[$id];
        return $factory($this);
    }
}
