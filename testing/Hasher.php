<?php

class Hasher
{
    /**
     * Hash the string by algo
     * @param  string $algo
     * @param  string $string
     * @return string
     */
    public function hash($algo, $string)
    {
        return hash($algo, $string);
    }
}