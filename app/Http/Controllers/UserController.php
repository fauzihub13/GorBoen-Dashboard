<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public array $dataUser = [];

    // Read all plants from database
    public function readAllUser($userId="") : array
    {

        $query = (!empty($userId)) ? $userId : "";

        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-ihplh/endpoint/getAllUser'.$query;

        $cUrl = curl_init();

		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_RETURNTRANSFER => true,

		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
        // var_dump($data);
		curl_close($cUrl);

        // Mengecek jika response sukses dan menyimpan data ke dalam session
        if ($data->success === true) {
            // Menggunakan foreach untuk mengurai properti dari 'result'
            // Mengakses properti dari objek 'result' secara langsung
            $row = $data->courses;

            if (is_array($row) && !empty($row))
			return $this->dataUser = $row;

        }
        return [];
    }

    public function index()
    {
        //
        // Memanggil metode readAllNews() untuk mendapatkan data

        $dataUser = $this->readAllUser();

        // $dataNews->pagination(10);
        return view("pages.user.index", compact("dataUser"));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("pages.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($request->input("password")===$request->input("password-confirm")){

            // API URL
            $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-ihplh/endpoint/registerUser';

            $cUrl = curl_init();

            $dataJSON = json_encode(array(
                'nama_lengkap' => $request->input("nama_lengkap"),
                'username' => $request->input("username"),
                'email' => $request->input("email"),
                'password' => md5(urlencode($request->input("password"))),
                'role' => $request->input("role"),
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
                return redirect("/user")->with('success', $data->message);

            } else {
                // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
                return redirect("/user")->with('error', $data->message);

            }

        } else {
            return redirect("/user/create")->with('error', "Password tidak cocok");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $userId)
    {
        //
         $dataUser = $this->readAllUser("?id=" . $userId);

        return view("pages.user.edit", compact("dataUser"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $userId)
    {
        //
        $query= "?id=".$userId;
        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-ihplh/endpoint/updateUser'.$query ;

        $cUrl = curl_init();

        $dataJSON = json_encode(array(
            'nama_lengkap' => $request->input("nama_lengkap"),
            'username' => $request->input("username"),
            'email' => $request->input("email"),
            'role' => $request->input("role"),
            'avatar' => "no avatar"

        ));

		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER=> array("Content-Type:application/json"),
            CURLOPT_POSTFIELDS => $dataJSON
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
        // var_dump($data);
		curl_close($cUrl);

        // Mengecek jika response sukses dan menyimpan data ke dalam session
        if ($data->success === true) {
            return redirect("/user")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/user/".$userId."/edit")->with('error', $data->message);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
    {
        //
        $query= "?id=".$userId;
        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-ihplh/endpoint/deleteUser'.$query ;

        $cUrl = curl_init();

		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_CUSTOMREQUEST => "DELETE",
			CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER=> array("Content-Type:application/json")
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
        // var_dump($data);
		curl_close($cUrl);

        // Mengecek jika response sukses dan menyimpan data ke dalam session
        if ($data->success === true) {
            return redirect("/user")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/user")->with('error', $data->message);

        }
    }
}
