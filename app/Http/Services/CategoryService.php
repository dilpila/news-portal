<?php

namespace App\Http\Services;

use App;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\DataTables;

class CategoryService
{
    use softDeletes;
    /**
     * @var Category
     */
    protected $category;


    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function dataTable()
    {
        $query = Category::all();
        return Datatables::of($query)->addColumn('actions', '')->make(true);
    }

    public function create($attr)
    {
        return $this->category->create($attr);
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function update($request, $id)
    {
        return $this->category->where('id', $id)->update($request);
    }

    public function delete($request)
    {
        return $this->category->where('id', $request->id)->delete();
    }
}