<?php

/**
 * @namespace
 */
namespace Fw\Mvc;

use Fw\Library\Arrayable;

/**
 * Class Model
 */
abstract class Model implements Arrayable, \JsonSerializable
{
    /**
     * @var string|array Name the primary key field
     */
    protected static $primaryKey;

    /**
     * @var array
     */
    private static $reservedProperties = [
        'reservedProperties',
        'primaryKey',
        'isSaved',
    ];

    /**
     * @var bool True if the record taken from the storage
     */
    private $isSaved = false;

    /**
     * Property isSaved establishes the true
     * 
     * @return self
     */
    private function setIsSaved()
    {
        $this->isSaved = true;
        return $this;
    }

    /**
     * True if the record taken from the storage
     * 
     * @return bool
     */
    public function isSaved()
    {
        return $this->isSaved;
    }

    /**
     * @param array|string $properties
     * @return self
     */
    protected function appendReservedProperties($properties)
    {
        self::$reservedProperties =
            array_merge(self::$reservedProperties, (array) $properties);

        return $this;
    }

    /**
     * @return array
     */
    public function getReservedProperties()
    {
        return self::$reservedProperties;
    }

    /**
     * @return array
     */
    public function getAffordableProperties()
    {
        $reservedProperties = $this->getReservedProperties();
        $allProperties = array_keys(get_object_vars($this));

        return array_values(array_diff($allProperties, $reservedProperties));
    }

    /**
     * @param string $property
     * @param mixed  $value
     * @return self
     */
    public function setProperty($property, $value = null)
    {
        $properties = $this->getAffordableProperties();

        if (in_array($property, $properties)) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * @param array $data
     * @return self
     */
    public function setProperties(array $data)
    {
        $properties = $this->getAffordableProperties();

        foreach ($properties as $property) {
            $value = null;
            if (isset($data[$property])) {
                $value = $data[$property];
            }
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * Finds record by primary key
     * 
     * @param mixed $pkValue
     * @return self
     */
    public static function findByPk($pkValue)
    {
        $data = self::executeQuery(static::$primaryKey, $pkValue);

        if (!$data) {
            return null;
        }

        return (new static())
            ->setIsSaved()
            ->setProperties($data);
    }

    /**
     * Execute query to the data store
     * 
     * @param array|string
     * @param array|mixed
     * @return array
     */
    private static function executeQuery($fields, $values)
    {
        $data = [
            'App\Model\User' => [
                'id' => [
                    '1' => [
                        'id' => '1',
                        'firstname' => 'Zeev',
                        'lastname' => 'Surasky',
                        'age' => '42',
                    ],
                ],
            ],
        ];
        $modelName = get_called_class();
        $keyForFind = implode('_', (array) $fields);
        $valueForFind = implode('_', (array) $values);

        if (isset($data[$modelName][$keyForFind][$valueForFind])) {
            return $data[$modelName][$keyForFind][$valueForFind];
        }

        return null;
    }

    /**
     * Implements the Arrayable interface
     * 
     * @return array
     */
    public function toArray()
    {
        $data = [];
        $properties = $this->getAffordableProperties();

        foreach ($properties as $property) {
            $data[$property] = $this->$property;
        }

        return $data;
    }

    /**
     * Implements the JsonSerializable interface
     * 
     * @return array
     */
    public function JsonSerialize()
    {
        return $this->toArray();
    }
}