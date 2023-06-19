<?php 
namespace App\Repositories ;
use Illuminate\Database\Eloquent\Model;
use App\Http\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    protected $model ;

    public function __construct(Model $model)
    {
        $this->model = $model ;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update(array $data,$id)
    {
        $recored =  $this->model->findOrFail($id);
        return $recored->update($data);
    }
    public function delete($id)
    {
        $recored =  $this->model->findOrFail($id);
        return $recored->delete();
    }
    public function show($id)
    {
        $recored =  $this->model->findOrFail($id);
        return $recored ;
    }

    public function getModel()
    {
        return $this->model ;
    }
    public function setModel($model)
    {
        $this->model = $model ;
        return $this ;
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
