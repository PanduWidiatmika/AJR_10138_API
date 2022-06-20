<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Pegawai;
use App\Models\Driver;
use Validator;

class AuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     $registrationData = $request->all();
    //     $validate = Validator::make($registrationData, [
    //         'name' => 'required|max:60',
    //         'email' => 'required|email:rfc,dns|unique:users',
    //         'password' => 'required'
    //     ]);

    //     if ($validate->fails())
    //         return response(['message' => $validate->errors()], 400); // return error validasi input

    //     $registrationData['password'] = bcrypt($request->password); // enkripsi password
    //     $user = User::create($registrationData); // membuat user baru
    //     return response([
    //         'message' => 'Register Success',
    //         'user' => $user
    //     ], 200); // return data user dalam bentuk json
    // }

    public function login(Request $request){
        $loginData = $request->all();
        $validate = Validator::make($loginData,[
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);
    
        if($validate->fails())
        return response(['message' => $validate->errors()],400);

        $Customer = Customer::where('EMAIL_CUSTOMER', $loginData['email'])->first();
        $Pegawai = Pegawai::where('EMAIL_PEGAWAI', $loginData['email'])->where('ID_ROLE', 1)->first();
        $Driver = Driver::where('EMAIL_DRIVER', $loginData['email'])->first();

        if($Customer != NULL){
            $cekPasswordCustomer = Hash::check($loginData['password'], $Customer->PASSWORD_CUSTOMER);
            
            if($cekPasswordCustomer){
                $data = Customer::where('EMAIL_CUSTOMER', $loginData['email'])->first();
                return response([
                    'message' => 'Login sebagai customer',
                    'data' => $data
                    ]);
            } 
            else 
            {
                return response([
                    'message' => 'Password salah',
                    'data' => null
                ]);
            }
        } 
        else if($Pegawai != NULL){
            $cekPasswordPegawai = Hash::check($loginData['password'], $Pegawai->PASSWORD_PEGAWAI);  

            if($cekPasswordPegawai){
                $data = Pegawai::where('EMAIL_PEGAWAI', $loginData['email'])->first();
                return response([
                    'message' => 'Login sebagai manager',
                    'data' => $data
                    ]);
            } 
            else 
            {
                return response([
                    'message' => 'Password salah',
                    'data' => null
                ]);
            }
        }
        else if($Driver != NULL){
            $cekPasswordDriver = Hash::check($loginData['password'], $Driver->PASSWORD_DRIVER); 
            
            if($cekPasswordDriver){
                $data = Driver::where('EMAIL_DRIVER', $loginData['email'])->first();
                return response([
                    'message' => 'Login sebagai driver',
                    'data' => $data
                    ]);
            } 
            else 
            {
                return response([
                    'message' => 'Password salah',
                    'data' => null
                ]);
            }
        }
        else
        {
            return response([
                'message' => 'Email Tidak Ditemukan',
                'data' => null
            ]);
        }
    }
}
