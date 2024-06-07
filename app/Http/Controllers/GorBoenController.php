<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GorBoenController extends Controller
{
    public array $dataGorBoen = [];

    public function readAllNews($newsId="") : array
    {

        $query = (!empty($newsId)) ? $newsId : "";

        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/getAllNews2'.$query;

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
			return $this->dataGorBoen = $row;

        }
        return [];
    }

    public function index(){

        // Memanggil metode readAllNews() untuk mendapatkan data

        $dataGorBoen = $this->readAllNews();

        // $dataGorBoen->pagination(10);
        return view("pages.gorboen.index", compact("dataGorBoen"));

		// return view("pages.news.index")->with("dataProducts");

    }

    public function store(Request $request){

        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/createNews2';

        $cUrl = curl_init();

        $dataJSON = json_encode(array(
            'judul' => $request->input("judul_berita"),
            'detail_berita' => $request->input("detail_berita"),
            'tanggal' => $request->input("tanggal_berita"),
            'gambar' => $request->input("gambar_berita")
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
            return redirect("/gorboen")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/gorboen")->with('error', $data->message);

        }

        // return redirect("/news");

        // return "store data berita ". $dataJSON;
    }

    public function create(){
        return view('pages.gorboen.create');
    }

    public function show(){
    }

    public function update(Request $request, $newsId){

        $query= "?id=".$newsId;
        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/updateNews2'.$query ;

        $cUrl = curl_init();

        $dataJSON = json_encode(array(
            'judul' => $request->input("judul_berita"),
            'detail_berita' => $request->input("detail_berita"),
            'tanggal' => $request->input("tanggal_berita"),
            'gambar' => $request->input("gambar_berita")
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
            return redirect("/gorboen")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/gorboen")->with('error', $data->message);

        }

        // return "masuk update isinya: ". $request ;

    }

    public function destroy($newsId){


        $query= "?id=".$newsId;
        // API URL
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-pkmqdbd/endpoint/deleteNews2'.$query ;

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
            return redirect("/gorboen")->with('success', $data->message);

        } else {
            // Jika login gagal, bisa menampilkan pesan error atau melakukan tindakan lainnya
            return redirect("/gorboen")->with('error', $data->message);

        }

    }

    public function edit($newsId){

        $dataGorBoen = $this->readAllNews("?id=" . $newsId);

        return view("pages.gorboen.edit", compact("dataGorBoen"));

        // return "isi nya: " . $newsId ;
    }




}
