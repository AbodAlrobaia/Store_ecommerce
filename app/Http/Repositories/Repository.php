<?php
namespace App\Http\Repositories;
use App\Http\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model;

    //constructor to  bind model to repo
    public function __construct(Model $model)
    {
        $this->model= $model ;
    }
    public function all()
    {
        // return $this->model->pagination(15);
        return $this->model->all(15);
    }
    public function create(array $data)
    {
        return $this->model->create($data); //  البيانات باتجي من الكنترولر
    }
    public function update(array $data,$id)
    {
        $record= $this->find($id);
        return $record->update($data);
    }
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getModel()
    {
        return $this->model;
    }
    public function setModel($model)
    {
         $this->model=$model;
         return $this;
    }


    //eager load database relationships
    public function with($relations){
        return $this->model->with($relations);
    }

}
