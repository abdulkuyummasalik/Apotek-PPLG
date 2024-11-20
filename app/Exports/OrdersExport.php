<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     *
     */
    public function collection()
    {
        return Order::with('user')->get();
    }

    // headings: nama-nama th dari file excel
    public function headings(): array
    {
        return [
            'ID Pembelian',
            "Nama Pembeli",
            "Daftar Obat",
            "Nama Kasir",
            "Total Harga",
            "Tanggal Pembelian"
        ];
    }
    public function map($item): array
    {
        $dataObat = '';
        foreach ($item->medicines as $key => $value) {
            $format = $key + 1 . ". " . $value['name_medicine'] . " (qty " . $value['qty'] . " : Rp. " . number_format($value['sub_price']) . "), ";
            $dataObat .= $format;
        }
        return [
            $item->id,
            $item->name_customer,
            $dataObat,
            $item->user->name,
            "Rp. " . number_format($item->total_price, 0, ',','.'),
            \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->Format('d F Y H:i:s'),
        ];
    }
}
