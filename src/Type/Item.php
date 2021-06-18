<?php
declare(strict_types=1);

namespace Diarium\To\Anything\Type;


abstract class Item
{

    protected function getReadOnlyFields(): array
    {
        return [];
    }

    abstract public function toArray();

    public static function createFromArray(array $row)
    {
        return new static();
    }

    /**
     * @param array $updates
     * @return static
     */
    public function getUpdated(array $updates)
    {
        $fields = $this->toArray();
        $readOnlyFields = $this->getReadOnlyFields();
        foreach ($updates as $fieldName => $fieldValue) {
            if (in_array($fieldName, $readOnlyFields, true)) {    continue; }
            $fields[$fieldName] = $fieldValue;
        }
        return static::createFromArray($fields);
    }

}
