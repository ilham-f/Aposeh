<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        header('Content-Type: application/json; charset=utf-8');

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $device = $data['device'];
        $sender = $data['sender'];
        $message = $data['message'];
        $text= $data['text']; //button text
        $member= $data['member']; //group member who send the message
        $name = $data['name'];
        $location = $data['location'];
        //data below will only received by device with all feature package
        //start
        $url =  $data['url'];
        $filename =  $data['filename'];
        $extension=  $data['extension'];
        //end

        if ( $message == "Y" ) {
            $reply = [
                "message" => "Untuk mendaftar sebagai member silahkan mengisi data diri berikut:

                Nama Lengkap (Sesuai KTP) :
                Alamat :
                Tanggal Lahir :
                Jenis Kelamin :
                Keluhan Saat Ini :",
            ];
        } elseif ( $message == "halo" ) {
            $reply = [
                "message" => "Selamat datang di Aposeh!

                Untuk layanan pembelian obat dan pengingat waktu minum obat online hanya diberikan kepada pasien yang terdaftar sebagai member kami.
                Apakah anda tertarik untuk mendaftar sebagai member?
                Ketik Y jika iya,
                Ketik N jika tidak

                Terima Kasih!",
            ];
        } elseif ( $message == "image" ) {
            $reply = [
                "message" => "image message",
                "url" => "https://filesamples.com/samples/image/jpg/sample_640%C3%97426.jpg",
            ];
        } elseif ( $message == "audio" ) {
            $reply = [
                    "message" => "audio message",
                "url" => "https://filesamples.com/samples/audio/mp3/sample3.mp3",
                "filename" => "music",
            ];
        } elseif ( $message == "video" ) {
            $reply = [
                "message" => "video message",
                "url" => "https://filesamples.com/samples/video/mp4/sample_640x360.mp4",
            ];
        } elseif ( $message == "file" ) {
            $reply = [
                "message" => "file message",
                "url" => "https://filesamples.com/samples/document/docx/sample3.docx",
                "filename" => "document",
            ];
        } else {
            $reply = [
                "message" => "Sorry, i don't understand. Please use one of the following keyword :

                Test
                Audio
                Video
                Image
                File",
            ];
        }

        sendFonnte($sender, $reply);

    }

    function sendFonnte($target, $data) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.fonnte.com/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => $data['message'],
                'url' => $data['url'],
                'filename' => $data['filename'],
            ),
          CURLOPT_HTTPHEADER => array(
            "Authorization: TOKEN"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
