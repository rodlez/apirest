<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

// Model
use App\Models\Customer;
// Request
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
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
        $queryItems = $filter->transform($request);     // [['column', 'operator', 'value']]

        // check if the query is empty
        if (count($queryItems) === 0) {
            return new CustomerCollection(Customer::paginate());
        } else {
            return new CustomerCollection(Customer::where($queryItems)->paginate());
        }

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
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource. Givin an id return the Customer object
     * 
     */
    public function show(Customer $customer)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
