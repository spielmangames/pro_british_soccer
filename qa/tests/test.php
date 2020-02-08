<?php

require_once('functions.php');

class test extends functions
{
    /**
     * @test
     * @dataProvider dataRivalries
     * @param $rivalry
     */
    public function rivalryContent($rivalry)
    {
        // has valid content
        new \model\club($rivalry['home']);
        new \model\club($rivalry['against']);
        $this->assertContains($rivalry['status'], ['strong', 'minor']);

        // is unique (club names matching only)
        $err = '[' . $rivalry['home'] . ',' .  $rivalry['against'] . '] is not unique.';
        $this->assertEquals(1, $this->getRivalryNamesMatchingQty($rivalry), $err);

        // is unique (full matching)
        $err = '[' . implode(',', $rivalry) . '] is not unique.';
        $this->assertEquals(1, $this->getRivalryFullMatchingQty($rivalry), $err);

        // is specified inversely (club names matching only)
        $err =  '[' . $rivalry['home'] . ',' .  $rivalry['against'] . '] is not specified inversely.';
        $this->assertEquals(1, $this->getRivalryNamesMatchingQty($this->inverseRivalry($rivalry)), $err);

        // is specified inversely (full matching)
        $err =  '[' . implode(',', $rivalry) . '] is not specified inversely correctly.';
        $this->assertEquals(1, $this->getRivalryFullMatchingQty($this->inverseRivalry($rivalry)), $err);
    }
}
