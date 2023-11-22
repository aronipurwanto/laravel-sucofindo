<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    private CategoryService $service;

    /**
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function getList(): Response
    {
        $data = $this->service->getCategoryList();

        return response()->view('category.category', [
            'title' => 'Category',
            'data' => $data,
        ]);
    }

    public function addCategory(Request $request) : Response | RedirectResponse
    {
        $name = $request->input('name');
        $desc = $request->input('description');
        if(empty($name) || empty($desc)){
            $data = $this->service->getCategoryList();

            return response()->view('todolist.todolist',[
                'title' => 'Category',
                'todolist' => $data,
                'error'=>'Name is required or Description is required'
            ]);
        }

        $this->service->saveCategory(uniqid(), $name, $desc);
        return redirect()->action([CategoryController::class,'getList']);
    }

    public function removeCategory(Request $request, string $id) : RedirectResponse
    {
        $this->service->removeCategory($id);
        return redirect()->action([CategoryController::class,'getList']);
    }
}
