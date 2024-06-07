<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KebunController extends Controller
{
    public array $dataPlants = [];

    // Read all plants from database
    public function readAllPlants($plantId="") : array
    {

        $query = (!empty($plantId)) ? $plantId : "";

        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/GetAllWisataadmin'.$query;

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
			return $this->dataPlants = $row;

        }
        return [];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Memanggil metode readAllNews() untuk mendapatkan data

        $dataPlants = $this->readAllPlants();

        // $dataNews->pagination(10);
        return view("pages.kebun.index", compact("dataPlants"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.kebun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $query= "?user_id=".$request->input("id");

        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/createkebun'.$query;

        $cUrl = curl_init();

        $dataJSON = json_encode(array(
            'judul' => $request->input("judul"),
            'detail_wisata' => $request->input("detail_wisata"),
            'Kontak' => $request->input("Kontak"),
            'wilayah' => $request->input("wilayah"),
            'lan' => $request->input("lan"),
            'long' => $request->input("long"),
            'gambar' => $request->input("gambar_Wisata")
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

        if ($data->success === true) {
            return redirect("/kebun")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/kebun")->with('error', $data->message);

        }

        // return redirect("/news");

        // return "store data berita ". $dataJSON;
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
    public function edit($plantId){

        $dataPlants = $this->readAllPlants("?id=" . $plantId);

        return view("pages.kebun.edit", compact("dataPlants"));

        // return "isi nya: " . $newsId ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $plantId){

        $query= "?id=".$plantId;
        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/EditWisataAdmin'.$query ;

        $cUrl = curl_init();

        $dataJSON = json_encode(array(
            'judul' => $request->input("judul"),
            'detail_wisata' => $request->input("detail_wisata"),
            'Kontak' => $request->input("Kontak"),
            'wilayah' => $request->input("wilayah"),
            'lan' => $request->input("lan"),
            'long' => $request->input("long"),
            'gambar' => $request->input("gambar_Wisata")


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
            return redirect("/kebun")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/kebun")->with('error', $data->message);

        }

        // return "masuk update isinya: ". $request ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($plantId){
        $query= "?id=".$plantId;
        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/deleteWisata'.$query ;

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
            return redirect("/kebun")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/kebun")->with('error', $data->message);

        }

    }
}
