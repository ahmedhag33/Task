<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repository\IProductRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * @var $repository
     ***/
    private $repository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IProductRepository $repository)
    {
        $this->repository =  $repository;
    }
    /**
     * @return response()
     */
    public function index()
    {
        $products = $this->repository->getall();
        return view('product.index', compact('products'));
    }
    /**
     * @return response()
     */
    public function create()
    {
        return view('product.create');
    }
    /**
     * @return response()
     */
    public function store(ProductRequest $request)
    {
        $this->repository->create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        session::flash('message', 'Successfully created post');
        return Redirect::to('product/');
    }
    /**
     * @return response()
     */
    public function getbyid($id)
    {
        $products = $this->repository->getbyid($id);
        return view('product.edit', compact('products'));
    }
    /**
     * @return response()
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($id, [
            'name' => $request->name,
            'price' => $request->price
        ]);
        session::flash('message', 'Successfully created post');
        return Redirect::to('product/');
    }
    /**
     * @return response()
     */
    public function delete($id)
    {
        $this->repository->delete($id);
        return redirect()
            ->route('product.index');
    }
}
