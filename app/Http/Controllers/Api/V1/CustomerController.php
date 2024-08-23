<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Model
use App\Models\Customer;
// Request
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
// Controller
use App\Http\Controllers\Controller;
// Resources
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
// Filters
use App\Filters\V1\CustomersFilter;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomersFilter();
        $filterItems = $filter->transform($request);     // [['column', 'operator', 'value']]

        // Include invoices in the result or not
        $includeInvoices = $request->query('includeInvoices');

        $customers = Customer::where($filterItems);

        if ($includeInvoices) {
            $customers = $customers->with('invoices');
        }

        return new CustomerCollection($customers->paginate()->appends($request->query()));


        // return Customer::all();
        // without the need of define the CustomerCollection will take the format defined in CustomerResource
        // return new CustomerCollection(Customer::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource. Givin an id return the Customer object
     * 
     */
    public function show(Customer $customer)
    {
        // Include invoices in the result or not
        $includeInvoices = request()->query('includeInvoices');

        if ($includeInvoices) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }

        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
