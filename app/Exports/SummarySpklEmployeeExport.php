<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Overtime;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SummarySpklEmployeeExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public $from; 
    public $to; 
    public $employee; 

    public function __construct($from, $to, $employee)
    {
        $this->from = $from;
        $this->employee = $employee;
        $this->to = $to;

    }

    public function query()
    {
      // dd($this->employee);
      return Overtime::query()->where('employee_id', $this->employee)->whereBetween('date', [$this->from, $this->to]);
// dd('ok');
         // dd($overtime);
    }

    public function headings(): array
    {
      
         $employee = Employee::find($this->employee);
         // dd($employee);
        return [
         [
            'SUMMARY SPKL',
            
         ],
         [
            'NIK',
            $employee->nik,
            
         ],
         [
            'Nama',
            $employee->biodata->first_name . ' ' . $employee->biodata->last_name
            
         ],
         [
            'Periode',
            formatDate($this->from) . ' - ' . formatDate($this->to),
            
            
         ],
         [
            'Total Jam Lembur',
            $employee->getOvertimes($this->from, $this->to)->where('type', 1)->sum('hours'),
            
            
         ],
         [
            'Total Piket',
            $employee->getOvertimes($this->from, $this->to)->where('type', 1)->sum('hours_final')
            
            
         ],
         [
            '-',
            '-'
            
            
         ],
            
            [
                'Type',
                'Day',
                'Date',
                'Qty (Hours)',
            ]
        ];
      //   dd('ok');
    }

    public function map($overtime): array
    {
   
         if ($overtime->type == 1) {
            $type = 'Lembur';
         } else {
            $type = 'Piket';
         }

         // dd($overtime);
        
        return [
            $type,
            formatDayName($overtime->date),
            formatDate($overtime->date),
            $overtime->hours,

            
            
        ];
    }

    

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            // 2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'A2' => ['rowspan' => ['2' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
