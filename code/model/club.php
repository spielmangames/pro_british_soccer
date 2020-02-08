<?php

namespace model;

class club
{
    protected $name;
    protected $founded;
    protected $rivalries;

    protected $city;
    protected $county;
    protected $country;
    protected $flagPath;
    protected $nationality;

    protected $wiki;


    public function __construct($name)
    {
        $clubData = getRecord('/data/clubs.csv', 'name', $name)[0];

        $this->name = $name;
        $this->founded = (int)$clubData['founded'];
        $this->rivalries = getRecord('/data/rivalries.csv', 'home', $this->name);

        $this->city = $clubData['city'];
        $this->county = $clubData['county'];
        $this->country = $clubData['country'];
        $this->flagPath = '/pro_british_soccer/data/flag/' . $clubData['country'] . '.PNG';
        $this->nationality = $this->prepareNationality();

        $this->wiki = $clubData['wiki'];
    }

    private function prepareNationality()
    {
        switch ($this->country) {
            case 'ENG':
                return 'an English';
                break;
            case 'IRL':
                return 'an Irish';
                break;
            case 'NIR':
                return 'a Northern Irish';
                break;
            case 'SCO':
                return 'a Scottish ';
                break;
            case 'WAL':
                return 'a Welsh';
                break;
        }
    }

    public function getPrintData()
    {
        $data = [];

        $data['name'] = $this->name;
        $data['flag'] = $this->flagPath;
        $data['nationality'] = $this->nationality;
        $data['city'] = $this->city;
        $data['county'] = $this->county;
        $data['founded'] = $this->founded;
        $data['strong_rivalries'] = $this->prepareRivalries('strong');
        $minor = $this->prepareRivalries('minor');
        if ($data['strong_rivalries'] == null) {
            $minor = str_replace([' also ', 'less heated'], [' ', 'traditional'], $minor);
        }
        $data['minor_rivalries'] = $minor;

        return $data;
    }

    private function prepareRivalries($status)
    {
        if ($status == 'strong') $prefix = 'They hold a fierce long-standing strong rivalry with ';
        if ($status == 'minor') $prefix = 'There is also a less heated minor rivalry with ';

        $rivalries = [];
        foreach ($this->rivalries as $key => $rivalry) {
            if ($rivalry['status'] != $status) continue;

            $rivalries[$key] = $rivalry['against'];
            if ($rivalry['name'] != 'null') {
                $rivalries[$key] = $rivalries[$key] . ' (' . $rivalry['name'] . ')';
            }
        }
        sort($rivalries);
        $rivalriesQty = count($rivalries);

        if ($rivalriesQty == 0) return null;

        $text = $prefix . implode(', ', $rivalries);

        if ($rivalriesQty == 1) return $text;

        if ($rivalriesQty > 1) {
            $text = str_replace(['There is', 'rivalry', ' a '], ['There are', 'rivalries', ' '], $text);
            $text = str_replace(', ' . $rivalries[$rivalriesQty - 1], ' & ' . $rivalries[$rivalriesQty - 1], $text);
            return $text;
        }
    }
}
