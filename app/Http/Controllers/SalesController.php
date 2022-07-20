<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repository\IProductRepository;
use App\Repository\ICustomerRepository;
use App\Repository\IInvoiceDetailsRepository;
use App\Repository\IInvoiceRepository;

class SalesController extends Controller
{
    /**
     * @var $customerrepository
     ***/
    private $customerrepository;
    /**
     * @var $productrepository
     ***/
    private $productrepository;
    /**
     * @var $invoiceRepository
     ***/
    private $invoiceRepository;
    /**
     * @var $invoicedetailsRepository
     ***/
    private $invoicedetailsRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ICustomerRepository $customerrepository,
        IProductRepository $productrepository,
        IInvoiceRepository $invoiceRepository,
        IInvoiceDetailsRepository $invoicedetailsRepository
    ) {
        $this->customerrepository = $customerrepository;
        $this->productrepository = $productrepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->invoicedetailsRepository = $invoicedetailsRepository;
    }
    /**
     * @return response()
     */
    public function invoice()
    {
        $customers = $this->customerrepository->getall();
        return view('sales.invoice', compact('customers'));
    }
    /**
     * @return response()
     */
    public function invoicedetails()
    {
        $products = $this->productrepository->getall();
        return view('sales.invoicedetails', compact('products'));
    }
    /**
     * @return response()
     */
    public function create()
    {
        return view('sales.create');
    }
    /**
     * @return response()
     */
    public function AddInvoice(Request $request)
    {
        $num = Invoice::max('id') + 1;
        $currentTime = Carbon::now();
        $date = $currentTime->toDateTimeString();
        $customer = $this->customerrepository->getbyid($request->id);
        $invoice = session()->get('invoice', []);
        $invoice[$request->id] = [
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'invoice_no' => 10 . '' . $num++,
            'invoice_data' => $date
        ];
        session()->put('invoice', $invoice);
        return response()->json(
            [
                'status' => true,
                'Message' => 'Success',
                'id' => $request->id
            ]
        );
    }
    /**
     * @return response()
     */
    public function AddInvoiceDetails(Request $request)
    {
        $product = $this->productrepository->getbyid($request->id);
        $invoicedetails = session()->get('invoicedetails', []);
        if (isset($invoicedetails[$request->id])) {
            $invoicedetails[$request->id]['quantity']++;
        } else {
            $invoicedetails[$request->id] = [
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
        session()->put('invoicedetails', $invoicedetails);
        return response()->json(
            [
                'status' => true,
                'Message' => 'Success',
                'id' => $request->id
            ]
        );
    }
    /**
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('invoicedetails');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('invoicedetails', $cart);
            session()->flash('success', 'invoicedetails updated successfully');
        }
    }
    /**
     * @return response()
     */
    public function store()
    {
        foreach (session('invoice') as  $id => $details) {
            $step1 =  $this->invoiceRepository->create([
                'customer_id' =>  $id,
                'invoice_no' => $details['invoice_no'],
                'invoice_data' => $details['invoice_data']
            ]);
            $invoice = session()->get('invoice');
            unset($invoice[$id]);
            session()->put('invoice', $invoice);
        }
        if ($step1) {
            foreach (session('invoicedetails') as  $id => $details) {
                $step2 =  $this->invoicedetailsRepository->create([
                    'product_id' =>  $id,
                    'invoice_id' => Invoice::max('id'),
                    'quantity' =>  $details['quantity'],
                    'subtotal' => $details['price'] * $details['quantity'],
                ]);
                $invoicedetails = session()->get('invoicedetails');
                unset($invoicedetails[$id]);
                session()->put('invoicedetails', $invoicedetails);
            }
        }
        if ($step2) {
            return redirect()
                ->route('sales.create');
        } else {
            return response()->json([
                'status' => false,
                'Message' => 'error'
            ]);
        }
    }
}
