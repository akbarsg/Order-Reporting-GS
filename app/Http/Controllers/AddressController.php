<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class AddressController extends Controller
{
    public function getData($type, Request $request)
    {
        $request->validate([
            'id' => 'bail|required',
            ]);
            
            switch ($type) {
                case 'regency':
                    $regencies = Regency::where('province_id', $request->id)->get();
                    foreach ($regencies as $key => $value) {
                        echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                    }                
                break;
                case 'district':
                    $districts = District::where('regency_id', $request->id)->get();
                    foreach ($districts as $key => $value) {
                        echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                    }                
                break;
                case 'village':
                    $villages = Village::where('district_id', $request->id)->get();
                    foreach ($villages as $key => $value) {
                        echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                    }                
                break;
                
                default:
                
            break;
        }
    }
}
