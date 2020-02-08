<?php

function getData($dataFilePath)
{
    $data = [];

    $handle = fopen(PROJECT_PATH . $dataFilePath, 'r');
    $header = null;
    while ($row = fgetcsv($handle, 1000, ',')) {
        if (!$header) {
            $header = $row;
        } else {
            $data[] = array_combine($header, $row);
        }
    }
    fclose($handle);

    return $data;
}

function getRecord($table, $field, $find)
{
    $records = [];
    foreach (getData($table) as $record) {
        if ($record[$field] == $find) {
            $records[] = $record;
        }
    }

    return $records;
}

function prepareDataProvider(array $array)
{
    $dataProvider = [];
    foreach ($array as $value) {
        $dataProvider[] = [$value];
    }
    return $dataProvider;
}

function sortContent($filePath, $delimiter = "\r\n")
{
    $content = file_get_contents($filePath);
    $content = explode($delimiter, $content);
    sort($content);
    $content = implode($delimiter, $content);
    file_put_contents($filePath, $content);
}
