<?php

abstract class functions extends PHPUnit_Framework_TestCase
{
    public function getRivalries()
    {
        return getData('/data/rivalries.csv');
    }

    public function dataRivalries()
    {
        return prepareDataProvider($this->getRivalries());
    }

    public function getRivalryFullMatchingQty($rivalry)
    {
        $i = 0;
        foreach ($this->getRivalries() as $r) {
            if ($r === $rivalry) {
                $i++;
            }
        }

        return $i;
    }

    public function getRivalryNamesMatchingQty($rivalry)
    {
        $i = 0;
        foreach ($this->getRivalries() as $r) {
            if ($r['home'] === $rivalry['home'] && $r['against'] === $rivalry['against']) {
                $i++;
            }
        }

        return $i;
    }

    public function inverseRivalry($rivalry)
    {
        return [
            'home' => $rivalry['against'],
            'against' => $rivalry['home'],
            'name' => $rivalry['name'],
            'status' => $rivalry['status'],
        ];
    }
}
