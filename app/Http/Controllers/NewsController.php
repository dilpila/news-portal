<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Services\CategoryService;
use App\Http\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Image;
Use File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $newsService;
    protected $categoryService;

    protected $data = [];

    protected $imageSavePath = '/uploads/news/';


    public function __construct()
    {
        $this->newsService = App::make(NewsService::class);
        $this->categoryService = App::make(CategoryService::class);
    }

    public function index()
    {

        if (request()->ajax()) {
            return $this->newsService->dataTable();
        }
        return view('news.list');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] = $this->categoryService->getAll();
        return view('news.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $catagories = explode(',', $request->categoryIds[0]);

        $attr = $request->except('image', '_token', 'inputCroppedPic', 'category', 'categoryIds');
        try {
            if ($request->has('inputCroppedPic') && !is_null($request->inputCroppedPic)) {

                if (!File::exists($this->imageSavePath)) {
                    File::makeDirectory($this->imageSavePath, 0775, true, true);
                }
                $destinationPath = $this->imageSavePath . $this->getDateFormatFileName('jpg');
                Image::make($request->input('inputCroppedPic'))
                    ->encode('jpg')
                    ->save(public_path($destinationPath));
                $attr['image'] = $destinationPath;
            }
            $news = $this->newsService->create($attr);

            $news->categories()->sync($catagories);

            return redirect()->route('news.index')->with('success', trans('news-portal.success-add'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('news-portal.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $this->data['news'] = $this->newsService->find($id);
        $this->data['categories'] = $this->categoryService->getAll();
        return view('news.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['news'] = $this->newsService->find($id);
        $this->data['categories'] = $this->categoryService->getAll();
        return view('news.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $news = $this->newsService->find($id);
        $cat = explode(',', $request->categoryIds[0]);
        $catagories = array_diff($cat, array(""));
        $attr = $request->except('image', '_token', 'inputCroppedPic', 'category', 'categoryIds');

        try {
            if ($request->has('inputCroppedPic') && !is_null($request->inputCroppedPic)) {
                $destinationPath = $this->imageSavePath . $this->getDateFormatFileName('jpg');
                $path = public_path() . $news->logo;
                \File::delete($path);
                Image::make($request->input('inputCroppedPic'))
                    ->encode('jpg')
                    ->save(public_path($destinationPath));
                $attr['image'] = $destinationPath;
            }
            $this->newsService->update($attr, $id);
            $news->categories()->sync($catagories);

            return redirect()->route('news.index')->with('success', trans('news-portal.success-update'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('news-portal.error'));
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->newsService = $this->newsService->delete($request);

        if ($this->newsService) {
            return response()->json('status', 200);
        } else {
            return response()->json('status', 500);
        }
    }

    protected function getDateFormatFileName($extension = null)
    {
        $fileName = rand();
        if ($extension) {
            $fileName = "{$fileName}.{$extension}";
        }
        return $fileName;
    }
}
