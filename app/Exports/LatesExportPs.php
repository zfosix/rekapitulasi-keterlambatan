<?php

namespace App\Exports;

use App\Models\Lates;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class LatesExportPs implements FromCollection, WithHeadings, WithStyles
{
    private $rayon;
    private $rayonNumber;

    public function __construct($rayon, $rayonNumber)
    {
        $this->rayon = $rayon;
        $this->rayonNumber = $rayonNumber;
    }

    public function collection()
    {
        $latesData = Lates::with('student.rombel', 'student.rayon')
            ->whereHas('student.rayon', function ($query) {
                $query->where('rayon', $this->rayon . ' ' . $this->rayonNumber);
            })
            ->get();

        $groupedData = $latesData->groupBy('student.nis');

        $transformedData = $groupedData->map(function ($group) {
            $lates = $group->first();
            $student = $lates->student;

            return [
                'NIS' => $student->nis,
                'Nama' => $student->name,
                'Rombel' => optional($student->rombel->first())->rombel,
                'Rayon' => optional($student->rayon->first())->rayon,
                'Jumlah Keterlambatan' => $group->count(),
            ];
        });

        return $transformedData->values();
    }

    private function calculateJumlahKeterlambatan($lates)
    {
        // Implementasi logika Anda untuk menghitung jumlah keterlambatan berdasarkan $nis
        // Misalnya, tingkatkan jumlah keterlambatan sebanyak 1 untuk setiap siswa dengan nis yang sama
        $jumlahKeterlambatan = 1;

        return $jumlahKeterlambatan;
    }

    public function styles(Worksheet $sheet)
    {
        // Styling untuk header
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'DDDDDD'],
            ],
        ]);

        // Styling untuk sel data
        $sheet->getStyle('A2:E' . $sheet->getHighestRow())->applyFromArray([
            'font' => [
                'bold' => false,
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Rombel',
            'Rayon',
            'Jumlah Keterlambatan',
        ];
    }
}
