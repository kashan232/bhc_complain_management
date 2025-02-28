<?php

namespace App\Exports;

use App\Models\Complaint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithHeadings;



class TypeExcel implements FromCollection,WithHeadings
{

    protected $nature_of_complaint;
    protected $district;

    /**
     * Constructor to initialize date range.
     */
    public function __construct($nature_of_complaint = null, $district = null)
    {
        $this->nature_of_complaint = $nature_of_complaint;
        $this->district = $district;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->district != null){
            if($this->district == 'All'){
                return Complaint::select(
                    'name',
                    'fathername',
                    'cnic',
                    'incorrect_cnic',
                    'correct_cnic',
                    'district',
                    'taluka',
                    'contact',
                    'nature_of_complaint',
                    'other_descrpition',
                    'date_of_birth',
                    'cnic_issuance_date',
                    'status',
                )->get();
            }else{
                return Complaint::select(
                    'name',
                    'fathername',
                    'cnic',
                    'incorrect_cnic',
                    'correct_cnic',
                    'district',
                    'taluka',
                    'contact',
                    'nature_of_complaint',
                    'other_descrpition',
                    'date_of_birth',
                    'cnic_issuance_date',
                    'status',
                )->where('district', $this->district)->get();
            }
           
        }
        if($this->nature_of_complaint != null){
            return Complaint::select(
                'name',
                'fathername',
                'cnic',
                'incorrect_cnic',
                'correct_cnic',
                'district',
                'taluka',
                'contact',
                'nature_of_complaint',
                'other_descrpition',
                'date_of_birth',
                'cnic_issuance_date',
                'status',
            )->where('nature_of_complaint', $this->nature_of_complaint)->get();
        }
        
    }

    public function headings(): array
    {
        return [
            'name',
            'fathername',
            'cnic',
            'incorrect_cnic',
            'correct_cnic',
            'district',
            'taluka',
            'contact',
            'nature_of_complaint',
            'other_descrpition',
            'date_of_birth',
            'cnic_issuance_date',
            'status',
        ];
    }

}
