<?php

namespace App\Repository;

use App\Repository\IBaseRepository;
use Illuminate\Database\Eloquent\Model;


class BaseRepository implements IBaseRepository
{



    public $colums = [];
    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /*------------------------*/
    /**
     * @return Model
     */
    /*------------------------*/
    public function getall()
    {
        return $this->model->all();
    }
    /*------------------------*/
    /**
     * @return Model
     */
    /*------------------------*/
    public function getbycolums()
    {
        return $this->model->select($this->colums)->whereNull('deleted_at')->paginate(10);
    }
    /*------------------------*/
    /** 
     *  @return Model by @param 
     */
    /*------------------------*/
    public function getbyid($id)
    {
        return $this->model->findOrFail($id);
    }
    /*------------------------*/
    /**
     * @param array $attributes
     * @return Model
     */
    /*------------------------*/
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
    /*------------------------*/
    /**
     * @param array $attributes
     * @return Model
     */
    /*------------------------*/
    public function update($id, array $attributes)
    {
        return $this->model->where('id', $id)->update($attributes);
    }
    /*------------------------*/
    /** 
     *  @return Model by @param 
     */
    /*------------------------*/
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
