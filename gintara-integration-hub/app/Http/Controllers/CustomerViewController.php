<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerViewController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:150',
            'telepon' => 'required|max:50',
            'alamat' => 'nullable',
            'pppoe_username' => 'nullable|max:100',
        ]);

        Customer::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'pppoe_username' => $request->pppoe_username,
            'status' => 'aktif',
            'sync_status' => 'pending',
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:150',
            'telepon' => 'required|max:50',
            'alamat' => 'nullable',
            'pppoe_username' => 'nullable|max:100',
            'status' => 'required',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->update([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'pppoe_username' => $request->pppoe_username,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil diupdate');
    }

    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil dihapus');
    }
}
// namespace App\Http\Controllers;


class CustomerViewController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('customers.index', compact('customers'));
    }


    public function create()
    {
        return view('customers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:150',
            'telepon' => 'required|max:50',
            'alamat' => 'nullable',
            'pppoe_username' => 'nullable|max:100',
        ]);


        Customer::create([
            'global_id' => Str::uuid(),

            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'pppoe_username' => $request->pppoe_username,

            'status' => 'aktif',
            'sync_status' => 'pending',
        ]);


        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan');
    }


    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', compact('customer'));
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:150',
            'telepon' => 'required|max:50',
            'alamat' => 'nullable',
            'pppoe_username' => 'nullable|max:100',
            'status' => 'required',
        ]);


        $customer = Customer::findOrFail($id);


        $customer->update([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'pppoe_username' => $request->pppoe_username,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil diupdate');
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();


        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil dihapus');
    }
}
