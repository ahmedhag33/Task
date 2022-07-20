<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use App\Repository\ICustomerRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
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
    public function __construct(ICustomerRepository $repository)
    {
        $this->repository =  $repository;
    }
    /**
     * @return response()
     */
    public function index()
    {
        $customers = $this->repository->getall();
        return view('customer.index', compact('customers'));
    }
    /**
     * @return response()
     */
    public function create()
    {
        return view('customer.create');
    }
    /**
     * @return response()
     */
    public function store(CustomerRequest $request)
    {
        $this->repository->create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
        ]);
        session::flash('message', 'Successfully created post');
        return Redirect::to('customer/');
    }
    /**
     * @return response()
     */
    public function getbyid($id)
    {
        $customers = $this->repository->getbyid($id);
        return view('customer.edit', compact('customers'));
    }
    /**
     * @return response()
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($id, [
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
        ]);
        session::flash('message', 'Successfully created post');
        return Redirect::to('customer/');
    }
    /**
     * @return response()
     */
    public function delete($id)
    {
        $this->repository->delete($id);
        return redirect()
            ->route('customer.index');
    }
}
