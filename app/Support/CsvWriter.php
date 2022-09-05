<?php

namespace App\Support;

use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use SplTempFileObject;

class CsvWriter
{

    /**
     * @param  array  $header
     * @param  array  $data
     * @param  string  $name
     * @return void
     * @throws CannotInsertRecord
     */
    public function write(array $header, array $data, string $name): void
    {
        $writer = Writer::createFromFileObject(new SplTempFileObject());

        $writer->insertOne($header);
        $writer->insertAll($data);

        $writer->output($name . ".csv");
    }
}
