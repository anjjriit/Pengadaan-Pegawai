<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\CPNS;

class CPNSController extends Controller
{

	public function validateInput(Request $request){
		$rules = array(
        	'nik'      				=> 'required',
            'nama'      			=> 'required',
            'alamat'    			=> 'required',
            'no_telp'   			=> 'required',
            'email'     			=> 'required|email',
            'foto'    				=> 'required',
            'ipk'     				=> 'required|numeric',
            'hasil_tes'			  	=> 'required|numeric',
            'jurusan'     			=> 'required',
            'pendidikan'     	    => 'required'
        );
        return Validator::make(Input::all(), $rules);
	}

    /**
     * Display all CPNS
     *
     * @return Response
     */
	public function getAllCPNS() {
        return CPNS::orderBy('nik', 'asc')->with('jurusan')->with('pendidikan')->get();
    }

    /**
     * Get a CPNS by NIK
     *
     * @param  bigInt  $nik
     * @return Response
     */
	public function getCPNS($nik) {
        return CPNS::with('jurusan')->with('pendidikan')->where('nik', '=' , $nik)->first();
    }

    /**
     * Add a CPNS
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
	public function addCPNS(Request $request) {
       
       /* Validation with Laravel built-in validator*/
        $validator = $this->validateInput($request);

        if ($validator->fails()) {
            return $validator->messages()->first();
        } else {
        	/* Check whether or not a CPNS with same NIK exist */
            $nik = Input::get('nik');
        	$cpns = CPNS::where('nik', '=' , $nik)->first();
        	if($cpns){
        		return "A CPNS with the same NIK found";
        	} else {
        		//validate phone number
                if (!preg_match('/^[0-9]+$/', Input::get('no_telp'))){
                    return "No. Telp tidak valid. Hanya boleh mengandung angka";
                }
                $cpns = new CPNS;
                $cpns->nik         			= $nik;
                $cpns->nama         		= Input::get('nama');
                $cpns->alamat       		= Input::get('alamat');
                $cpns->no_telp      		= Input::get('no_telp');
                $cpns->email      			= Input::get('email');
                $cpns->foto      			= Input::get('foto');
                $cpns->ipk      			= Input::get('ipk');
                $cpns->hasil_tes      		= Input::get('hasil_tes');
                $cpns->jurusan      		= Input::get('jurusan');
                $cpns->pendidikan_akhir		= Input::get('pendidikan');
                $cpns->save();
                return 1;
        	}
        }

    }

    /**
     * Edit a CPNS by NIK
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  bigInt  $nik
     * @return Response
     */
	public function editCPNS(Request $request, $nik) {
        

		$cpns = CPNS::where('nik', '=' , $nik)->first();
		if(!$cpns)
			return 	"Not found";

		/* Validation with Laravel built-in validator*/
		$validator = $this->validateInput($request);

        if ($validator->fails()) {
            return $validator->messages()->first();
        } else {
        	
			if (!preg_match('/^[0-9]+$/', Input::get('no_telp'))){
				return "No. Telp tidak valid. Hanya boleh mengandung angka";
			}
			$cpns->nik         			= Input::get('nik');
			$cpns->nama         		= Input::get('nama');
			$cpns->alamat       		= Input::get('alamat');
			$cpns->no_telp      		= Input::get('no_telp');
			$cpns->email      			= Input::get('email');
			$cpns->foto      			= Input::get('foto');
			$cpns->ipk      			= Input::get('ipk');
			$cpns->hasil_tes      		= Input::get('hasil_tes');
			//$cpns->jurusan      		= Input::get('jurusan');
			//$cpns->pendidikan_akhir	= Input::get('pendidikan_akhir');
			$cpns->save();
			return 1;
		}
    }

    /**
     * Delete a CPNS by NIK
     *
     * @param  bigInt  $nik
     * @return Response
     */
	public function deleteCPNS($nik) {
        
        $cpns = CPNS::where('nik', '=' , $nik)->first();
        if(!$cpns)
                return "Not Found";

        /*$inAlokasi = Alokasi::where('cpns_nik' , '=', $nik)->count();
        if($inAlokasi > 0){
            return "Cannot delete";
        } else {
            $cpns->delete();
            return 1;
        }*/

        $cpns->delete();
		return 1;

    }

}
