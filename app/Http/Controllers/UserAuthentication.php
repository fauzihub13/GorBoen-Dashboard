<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserAuthentication extends Controller
{
    public function Login(Request $request)
	{

        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-ihplh/endpoint/getOneUser';

        $cUrl = curl_init();

        $dataJSON = json_encode(array(
            'email' => $request->input("email"),
            'password' => md5(urlencode($request->input("password")))
        ));

		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER=> array("Content-Type:application/json"),
            CURLOPT_POSTFIELDS => $dataJSON
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
        var_dump($data);
		curl_close($cUrl);

        // Mengecek jika response sukses dan menyimpan data ke dalam session
        if ($data->success === true) {
            // Menggunakan foreach untuk mengurai properti dari 'result'
            // Mengakses properti dari objek 'result' secara langsung
            $row = $data->result;

            if($row->role === "admin"){
                // Menyimpan setiap properti ke dalam session dengan prefix 'user_'
                Session::put("id", $row->_id);
                Session::put("username", $row->username);
                Session::put("email", $row->email);
                Session::put("password", $row->password);
                Session::put("avatar", $row->avatar);
                Session::put("role", $row->role);
                Session::put("nama_lengkap", $row->nama_lengkap);

                // echo "admin ini usernamenya: ". Session::get('username');
                return redirect("/");

            } else{
                // echo "Anda bukan Admin";
                return redirect("/login")->with('error', 'Anda bukan Admin');
            }

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/login")->with('error', $data->message);

        }


	}

    public function LogOut(){
        session_start();

		Session::flush();

		return redirect("/login");
    }

    public function Register(Request $request){

        if ($request->input("password")===$request->input("password-confirm")){

            // API URL
            $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-ihplh/endpoint/registerUser';

            $cUrl = curl_init();

            $dataJSON = json_encode(array(
                'nama_lengkap' => $request->input("nama_lengkap"),
                'username' => $request->input("username"),
                'password' => md5(urlencode($request->input("password"))),
                'email' => $request->input("email"),
                'avatar' => "no avatar",
            ));

            $options = array(
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER=> array("Content-Type:application/json"),
                CURLOPT_POSTFIELDS => $dataJSON
            );

            curl_setopt_array($cUrl, $options);
            $response = curl_exec($cUrl);
            $data = json_decode($response);
            // var_dump($data);
            curl_close($cUrl);

            if ($data->success === true) {
                return redirect("/login")->with('success', $data->message);

            } else {
                // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
                return redirect("/register")->with('error', $data->message);

            }

        } else {
            return redirect("/register")->with('error', "Password tidak cocok");
        }



    }




}
