<?php

namespace model;

class printer
{
    public function printClubCards(array $clubNames = null)
    {
        $clubs = [];
        foreach ($this->prepareClubsCollection($clubNames) as $key => $club) {
            $clubs[$key] = $club->getPrintData();
        }

        echo json_encode($clubs, JSON_PRETTY_PRINT);
    }

    private function prepareClubsCollection(array $clubNames = null)
    {
        $collection = [];

        if (!$clubNames) {
            foreach (getData('/data/clubs.csv') as $clubData) {
                $clubNames[] = $clubData['name'];
            }
        }

        foreach ($clubNames as $clubName) {
            $collection[] = new club($clubName);
        }

        return $collection;
    }

    public function generatePdf()
    {

    }
}
