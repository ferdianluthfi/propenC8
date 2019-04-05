<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KemajuanProyek;
use App\Proyek;
use App\Pelaksanaan;


class KemajuanProyekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * method untuk melihat daftar kemajuan seluruh proyek yang sedang berjalan
     */
    public function viewKemajuan(){

        $idProyeks = Proyek::select('proyeks.id')->where('isLPJExist', 0)->get();
        $proyeks = Proyek::select('proyeks.*')->where('isLPJExist', 0)->get();
        $idPelaksanaan = Pelaksanaan::select('pelaksanaans.id')->whereIn('proyek_id',$idProyeks)->get();
        $pelaksanaans = Pelaksanaan::select('pelaksanaans.*','proyeks.*','kemajuan_proyeks.*')
        ->join('proyeks','proyeks.id','=','pelaksanaans.proyek_id')
        ->join('kemajuan_proyeks','kemajuan_proyeks.pelaksanaan_id','=','pelaksanaans.id')
        ->whereIn('proyek_id',$idProyeks)->get();
        $kemajuans = KemajuanProyek::select('kemajuan_proyeks.*')->whereIn('pelaksanaan_id',$idPelaksanaan)->get();
        $proyekPrint = [];
        $proyekDetail = [];
        $data = $pelaksanaans->groupBy('proyek_id');
        foreach ($data as $proyek) {
            $sumGaji = 0;
            $sumBelanja = 0;
            $sumAdministrasi = 0;
            foreach ($proyek as $kemajuan) {
                if ($kemajuan['tipeKemajuan'] == 1) {
                    $sumGaji += $kemajuan['value'];
                }
                elseif ($kemajuan['tipeKemajuan'] == 2) {
                    $sumBelanja += $kemajuan['value'];
                }
                else {
                    $sumAdministrasi += $kemajuan['value'];
                }
            }
            $proyekDetail[] = array(
                "projectName" => $kemajuan['projectName'],
                "totalGaji" => $sumGaji,
                "totalBelanja" => $sumBelanja,
                "totalAdministrasi" => $sumAdministrasi,
                "totalKeseluruhan" => $sumGaji + $sumAdministrasi + $sumBelanja,
                "maxValue" => $kemajuan['projectValue']
                
            );
            $proyekPrint[$kemajuan['projectName']] = (($sumGaji + $sumAdministrasi + $sumBelanja) / $kemajuan['projectValue'])*100;
        }    
        //dd($proyekDetail);
        $test = 50;
        //print json_encode($proyekDetail);
        return view('viewAll', compact('proyekPrint','proyekDetail','test'));
    }
}
