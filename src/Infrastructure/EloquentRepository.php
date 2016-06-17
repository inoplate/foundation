<?php

namespace Inoplate\Foundation\Infrastructure;

abstract class EloquentRepository
{
    /**
     * Retrieve eloquent model
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Retrieve all record
     * 
     * @param  array  $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * Paginate record
     * 
     * @param  integer $perPage
     * @param  array   $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Create new record
     * 
     * @param  array  $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update record
     * 
     * @param  array  $data
     * @param  mixed  $id
     * @param  string $attributes
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * Delete record
     * 
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Find record by id
     * 
     * @param  mixed $id
     * @param  array  $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find record by given field
     * 
     * @param  string $field
     * @param  mixed  $value
     * @param  array  $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }

    /**
     * Retrieve all records by given field
     * 
     * @param  string $field
     * @param  mixed $value
     * @param  array  $columns
     * @return mixed
     */
    public function findAllBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    /**
     * Convert result to domain model
     * 
     * @param  Model $result
     * @return array|Entity
     */
    public function toDomainModel($result)
    {
        return $result ? $result->toArray() : $result;
    }
}