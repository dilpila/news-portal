<?php

namespace App\Http\Services;

use App;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\DataTables;

class NewsService
{
    use softDeletes;
    /**
     * @var Category
     */
    protected $news;


    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function dataTable()
    {
        $query = News::all();
        return Datatables::of($query)->addColumn('actions', '')->make(true);
    }

    public function create($attr)
    {
        return $this->news->create($attr);
    }

    public function find($id)
    {
        return $this->news->find($id);
    }

    public function update($request, $id)
    {
        return $this->news->where('id', $id)->update($request);
    }

    public function delete($request)
    {
        $news = $this->find($request['id']);
        $path = public_path() . $news->image;
        \File::delete($path);
        $news->delete();
        return $news;
    }
}