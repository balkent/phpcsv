<?php

namespace App\Builder;

use League\Csv\Writer;

class CsvBuilder
{
    public function build(
        string $fileNamePath,
        string $jsonSchema,
        array $data
    ): bool {
        $schema = json_decode($jsonSchema, true);

        $writer = Writer::createFromPath($fileNamePath, 'r+');
        $writer->insertOne($this->getHeader($schema));
        $writer->insertAll($this->lineGenarator($schema, $data));

        return true;
    }

    private function getHeader(array $schema): array
    {
        $tab = [];
        foreach ($schema as $value) {
            if (false === empty($value['header'])) {
                $tab[] = $value['header'];
            }
        }

        return $tab;
    }

    private function lineGenarator(array $schema, array $data): iterable
    {
        foreach ($data as $object) {
            $tab = [];
            foreach ($schema as $value) {
                if (false === empty($value['field'])) {
                    $method = 'get'.ucfirst($value['field']);
                    $tab[] = call_user_func([$object, $method]);
                }
            }

            yield $tab;
        }
    }
}
