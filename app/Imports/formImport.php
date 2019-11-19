<?php

namespace App\Imports;

use App\Models\masterApps\formHead;
use App\Models\masterApps\formDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use App\Notifications\Email;


class formImport implements WithMappedCells, ToModel
{
    public function mapping(): array
    {
        $row = array();
        $row['nama']='C1';
        $row['req_no_wo']='C2';

        for($i=6; $i<=100;$i++){
            $row['kriteria_row_'.$i]= 'B'.$i;
            $row['parameter_row_'.$i]= 'C'.$i;  
            $row['if_not_ok_'.$i]= 'D'.$i;
            $row['keterangan_'.$i]= 'E'.$i;
        }

        return $row;
        
    }
    
    public function model(array $row)
    {
        $kelompok = 1;
        
        for($i=6; $i<=100;$i++){
            $hasil['baris_ke_'.$kelompok] = array();
            foreach($row as $key => $value)
            {
                $keynya = explode('_', $key);
                $cek = end($keynya);
                if($cek == $i){ 
                    array_push($hasil['baris_ke_'.$kelompok], $value);
                }
            }
            if (!is_null($hasil['baris_ke_'.$kelompok][0])) 
            {
                $kelompok++;
            }
        }
        $head = formHead::create([
            'nama'=>$row['nama'],
            'req_no_wo'=>$row['req_no_wo']
        ]);
        
        $head->email = "luthfeniaaa@gmail.com";
        $head->notify(new Email($head));

        $insert = array();
        foreach($hasil as $value){
            if(!is_null($value[0])&&!is_null($value[1])&&!is_null($value[2])&&!is_null($value[3])){
                $array = array();
                $array['head_id'] = $head->id;
                $array['kriteria'] = $value[0];
                $array['parameter'] = $value[1];
                $array['if_not_ok'] = $value[2];
                $array['keterangan'] = $value[3];

                array_push($insert, $array);
            }
        }
        foreach ($insert as $input)
        {
            formdetail::create($input);
        }
    }
}
