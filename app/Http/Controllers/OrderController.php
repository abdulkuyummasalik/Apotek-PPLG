<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggal = request('tanggal');
        $query = Order::with('user');

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        }

        $orders = $query->orderBy('created_at', "DESC")->simplePaginate(10);

        return view('order.kasir.index', compact('orders', 'tanggal'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicines = Medicine::all();
        return view('order.kasir.create', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'medicines' => 'required'
        ]);

        $arrayDistinct = array_count_values($request->medicines);

        $arrayAssocMedicines = [];

        foreach ($arrayDistinct as $id => $count) {
            $medicine = Medicine::where('id', $id)->first();

            if ($medicine->stock < $count) {
                $valueBefore = [
                    'name_customer' => $request->name_customer,
                    'medicines' => $request->medicines,
                ];
                $msg = "Stok obat {$medicine->name} : {$medicine->stock}. tidak mencukupi.";
                return redirect()->back()->with('failed', $msg)->withInput($valueBefore);
            }

            $subPrice = $medicine['price'] * $count;

            $arrayItem = [
                'id' => $id,
                'name_medicine' => $medicine['name'],
                'qty' => $count,
                'price' => $medicine['price'],
                'sub_price' => $subPrice
            ];

            array_push($arrayAssocMedicines, $arrayItem);
        }

        $totalPrice = 0;
        foreach ($arrayAssocMedicines as $item) {
            $totalPrice += (int)$item['sub_price'];
        }

        $priceWithPPN = $totalPrice + ($totalPrice * 0.1);

        $proces = Order::create([
            'user_id' => Auth::user()->id,
            'medicines' => $arrayAssocMedicines,
            'name_customer' => $request->name_customer,
            'price' => $totalPrice,
            'total_price' => $priceWithPPN
        ]);

        if ($proces) {
            foreach ($arrayAssocMedicines as $item) {
                $medicine = Medicine::find($item['id']);
                $medicine->stock -= $item['qty'];
                $medicine->save();
            }

            $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
            return redirect()->route('kasir.order.print', $order['id']);
        } else {
            return redirect()->back()->with('failed', 'Gagal membuat data Pembelian, silakan coba lagi!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('order.kasir.print', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // dek
    }

    public function downloadPDF($id)
    {
        $order = Order::find($id)->toArray();
        view()->share('order', $order);
        $pdf = PDF::loadView('order.kasir.download-pdf', $order);
        return $pdf->download('receipt.pdf');
    }

    public function data()
    {
        $tanggal = request('tanggal');
        $query = Order::with('user');

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        }

        $orders = $query->orderBy( "created_at", "desc")->simplePaginate(10);

        return view('order.admin.index', compact('orders', 'tanggal'));
    }

    public function exportExcel()
    {
        $file_name = 'data_pembelian'.'.xlsx';
        return Excel::download(new OrdersExport, $file_name);
    }
}
