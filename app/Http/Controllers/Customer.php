<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class Customer extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        return $this->customerService->index();
    }

    public function prospectos()
    {
        return $this->customerService->prospectos();
    }

    public function store(Request $request)
    {
        return $this->customerService->store($request);
    }

    public function show($id)
    {
        return $this->customerService->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->customerService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->customerService->destroy($id);
    }

    public function convertToClient($id)
    {
        return $this->customerService->convertToClient($id);
    }
}
