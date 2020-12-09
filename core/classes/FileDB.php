<?php

namespace Core;

/**
 * Class FileDB
 */
class FileDB
{

    private $file_name;
    private $data;

    /**
     * FileDB constructor.
     *
     * @param string $file_name - path where data is saved.
     */
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }


    /**
     * @param $data_array - data to save.
     */
    public function setData(array $data_array): void
    {
        $this->data = $data_array;
    }

    /**
     * @return mixed - data to return.
     */
    public function getData(): array
    {
        return $this->data ?? [];
    }

    /**
     * Function saves data (getData()) to database ($file_name - db path).
     * @return bool
     */
    public function save(): bool
    {
        $data = json_encode($this->getData());
        $bytes_written = file_put_contents($this->file_name, $data);

        return $bytes_written !== false;
    }

    /**
     * Get data from database file and decode to array
     *
     * @return bool
     */
    public function load(): bool
    {
        if (file_exists($this->file_name)) {
            $data = file_get_contents($this->file_name);

            if ($data !== false) {
                $this->setData(json_decode($data, true) ?? []);
            } else {
                $this->setData([]);
            }

            return true;
        }

        return false;
    }

    /**
     * Function creates new array in $this->data array with particular index.
     * @param $table_name - array index.
     * @return bool
     */

    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * Function checks if table with given name exists.
     * @param $table_name - table name.
     * @return bool
     */
    public function tableExists($table_name): bool
    {
        return isset($this->data[$table_name]);
    }

    /**
     * Function checks if table with given name exists and deletes it.
     * @param string $table_name - table name.
     * @return bool
     */
    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);

            return true;
        }

        return false;
    }

    /**
     * Empties an array by given index.
     * @param $table_name - table name.
     * @return bool
     */
    public function truncateTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];

            return true;
        }

        return false;
    }

    /**
     * Function adds a row to a table by given index.
     * @param string $table_name
     * @param array $row
     * @param string|null $row_id
     * @return bool|int|string|null
     */
    public function insertRow(string $table_name, array $row, $row_id = null)
    {
        if (!isset($this->data[$table_name][$row_id])) {
            if ($row_id === null) {
                $this->data[$table_name][] = $row;
                $row_id = array_key_last($this->data[$table_name]);
            } else {
                $this->data[$table_name][$row_id] = $row;
            }
            return $row_id;
        }
        return false;
    }

    /**
     * Check if table has a row with given id.
     * @param string $table_name
     * @param string $row_id
     * @return bool
     */
    public function rowExists(string $table_name, $row_id): bool
    {
        return isset($this->data[$table_name][$row_id]);
    }

    /**
     * Check if table ($table_name) has a row with given id ($row_id) and replaces it with new given content ($row).
     * @param string $table_name - table name
     * @param $row - new row content
     * @param $row_id - row index
     * @return bool
     */
    public function updateRow(string $table_name, array $row, $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;

            return true;
        }

        return false;
    }

    /**
     * Delete a row from array.
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function deleteRow(string $table_name, $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);

            return true;
        }

        return false;
    }

    /**
     * Return row if it exists.
     * @param $table_name
     * @param $row_id
     * @return false|array
     */
    public function getRowById(string $table_name, $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {

            return $this->data[$table_name][$row_id];
        }

        return false;
    }

    /**
     * Get rows matching conditions
     *
     * @param string $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere(string $table_name, array $conditions = []): array
    {
        $results = [];

        if (isset($this->data[$table_name])) {

        foreach ($this->data[$table_name] as $row_id => $row) {
            $found = true;

            foreach ($conditions as $condition_id => $condition_value) {
                if ($row[$condition_id] !== $condition_value) {
                    $found = false;
                    break;
                }
            }

            if ($found) {
                $results[$row_id] = $row;
            }
        }
    }
        return $results;
    }

    /**Get one row matching condition
     * @param $table_name
     * @param array $condition
     * @return false|array
     */
    public function getRowWhere(string $table_name, array $conditions = [])
    {
        foreach ($this->data[$table_name] ?? [] as $row_id => $row) {
            $found = true;

            foreach ($conditions as $condition_id => $condition_value) {
                if ($row[$condition_id] !== $condition_value) {
                    $found = false;
                    break;
                }
            }

            if ($found) {
                return $row;
            }
        }

        return false;
    }
}