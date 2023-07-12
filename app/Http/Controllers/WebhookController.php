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
                'target' => $sender,
                'message' => $reply['message'],
                'url' => $reply['url'],
                'filename' => $reply['filename'],
            ),
          CURLOPT_HTTPHEADER => array(
            "Authorization: GtPn!oM74dAeY3EcV0n0"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }

//     public function ambilchat($input_source = "php://input")
//   {

//     $json = file_get_contents($input_source);
//     $data = json_decode($json, true);
//     if ($data != null) {
//       if (substr($data['sender'], 0, 2) == 62) {
//         $sender = preg_replace('/^62/', '0', $data['sender']);
//       } else if (substr($data['sender'], 0, 1) == 0) {
//         $sender = $data['sender'];
//       }
//       $message = $data['message'];
//       $member = Member::where('no_member', $sender)->first();
//       $user = User::where('no', $sender)->first();
//       $noperusahaan = Setting::where('no_penerima_pesan', $sender)->first();
//       $setting = Setting::first();
//       $tokenfonnte = $setting->token_fonnte;

//       if ($member != null) {
//         $getpegawai = User::where('id', $member->id_users)->first();
//         $curl = curl_init();
//         curl_setopt_array($curl, array(
//           CURLOPT_URL => 'https://api.fonnte.com/send',
//           CURLOPT_RETURNTRANSFER => true,
//           CURLOPT_ENCODING => '',
//           CURLOPT_MAXREDIRS => 10,
//           CURLOPT_TIMEOUT => 0,
//           CURLOPT_FOLLOWLOCATION => true,
//           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//           CURLOPT_CUSTOMREQUEST => 'POST',
//           CURLOPT_POSTFIELDS => array(
//             'target' => $getpegawai->no,
//             'message' => $sender . " (" . $member->nama_member . ")\n" . $message,
//             // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//             // 'filename' => 'filename',
//             'schedule' => '0',
//             'typing' => false,
//             'delay' => '2',
//             'countryCode' => '62',
//           ),
//           CURLOPT_HTTPHEADER => array(
//             'Authorization: ' . $tokenfonnte
//           ),
//         ));

//         $response = curl_exec($curl);
//         curl_close($curl);
//         $data = json_decode($response, true); // Menguraikan respons JSON menjadi array
//         $status = $data['status']; // Mendapatkan nilai "status" dari array

//         if ($status == 1) {
//           $chat = new Chat();
//           $chat->no_pengirim = $sender;
//           $chat->no_penerima = $getpegawai->no;
//           $chat->isi_pesan = $message;
//           $chat->save();
//         }
//       } else if ($user != null) {
//         if ($message == "/Template") {
//           $chattemplate = ChatTemplate::get();
//           $jumlahtemplate = count($chattemplate);
//           for ($i = 0; $i < $jumlahtemplate; $i++) {
//             $pesan = str_replace('\n', "\n", $chattemplate[$i]->template_chat);
//             $curl = curl_init();
//             curl_setopt_array($curl, array(
//               CURLOPT_URL => 'https://api.fonnte.com/send',
//               CURLOPT_RETURNTRANSFER => true,
//               CURLOPT_ENCODING => '',
//               CURLOPT_MAXREDIRS => 10,
//               CURLOPT_TIMEOUT => 0,
//               CURLOPT_FOLLOWLOCATION => true,
//               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//               CURLOPT_CUSTOMREQUEST => 'POST',
//               CURLOPT_POSTFIELDS => array(
//                 'target' => $sender,
//                 'message' => $pesan,
//                 // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//                 // 'filename' => 'filename',
//                 'schedule' => '0',
//                 'typing' => false,
//                 'delay' => '2',
//                 'countryCode' => '62',
//               ),
//               CURLOPT_HTTPHEADER => array(
//                 'Authorization: ' . $tokenfonnte
//               ),
//             ));
//             $response = curl_exec($curl);
//             curl_close($curl);
//           }
//         } else {
//           $tempgetmember = preg_match("/\d+/", $message, $tempnomember);
//           if ($tempnomember != null) {
//             $nomember = $tempnomember[0];
//             $cekmember = Member::where('no_member', $nomember)->first();
//             if ($cekmember != null) {
//               if ($cekmember->id_users == $user->id) {
//                 $temppesan = explode($nomember, $message);
//                 $temppesan2 = explode("\n", $temppesan[1]);
//                 $pesan = $temppesan2[1];
//                 $curl = curl_init();
//                 curl_setopt_array($curl, array(
//                   CURLOPT_URL => 'https://api.fonnte.com/send',
//                   CURLOPT_RETURNTRANSFER => true,
//                   CURLOPT_ENCODING => '',
//                   CURLOPT_MAXREDIRS => 10,
//                   CURLOPT_TIMEOUT => 0,
//                   CURLOPT_FOLLOWLOCATION => true,
//                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                   CURLOPT_CUSTOMREQUEST => 'POST',
//                   CURLOPT_POSTFIELDS => array(
//                     'target' => $nomember,
//                     'message' => $pesan,
//                     // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//                     // 'filename' => 'filename',
//                     'schedule' => '0',
//                     'typing' => false,
//                     'delay' => '2',
//                     'countryCode' => '62',
//                   ),
//                   CURLOPT_HTTPHEADER => array(
//                     'Authorization: ' . $tokenfonnte
//                   ),
//                 ));
//                 $response = curl_exec($curl);
//                 curl_close($curl);
//                 $data = json_decode($response, true); // Menguraikan respons JSON menjadi array
//                 $status = $data['status']; // Mendapatkan nilai "status" dari array

//                 if ($status == 1) {
//                   $chat = new Chat();
//                   $chat->no_pengirim = $sender;
//                   $chat->no_penerima = $nomember;
//                   $chat->isi_pesan = $pesan;
//                   $chat->save();
//                 }
//               } else {
//                 $curl = curl_init();
//                 curl_setopt_array($curl, array(
//                   CURLOPT_URL => 'https://api.fonnte.com/send',
//                   CURLOPT_RETURNTRANSFER => true,
//                   CURLOPT_ENCODING => '',
//                   CURLOPT_MAXREDIRS => 10,
//                   CURLOPT_TIMEOUT => 0,
//                   CURLOPT_FOLLOWLOCATION => true,
//                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                   CURLOPT_CUSTOMREQUEST => 'POST',
//                   CURLOPT_POSTFIELDS => array(
//                     'target' => $sender,
//                     'message' => "No yang Anda kirimkan bukan member Anda",
//                     // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//                     // 'filename' => 'filename',
//                     'schedule' => '0',
//                     'typing' => false,
//                     'delay' => '2',
//                     'countryCode' => '62',
//                   ),
//                   CURLOPT_HTTPHEADER => array(
//                     'Authorization: ' . $tokenfonnte
//                   ),
//                 ));
//                 $response = curl_exec($curl);
//                 curl_close($curl);
//               }
//             } else {
//               $curl = curl_init();
//               curl_setopt_array($curl, array(
//                 CURLOPT_URL => 'https://api.fonnte.com/send',
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => '',
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => 'POST',
//                 CURLOPT_POSTFIELDS => array(
//                   'target' => $sender,
//                   'message' => "No yang Anda kirimkan bukan member",
//                   // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//                   // 'filename' => 'filename',
//                   'schedule' => '0',
//                   'typing' => false,
//                   'delay' => '2',
//                   'countryCode' => '62',
//                 ),
//                 CURLOPT_HTTPHEADER => array(
//                   'Authorization: ' . $tokenfonnte
//                 ),
//               ));
//               $response = curl_exec($curl);
//               curl_close($curl);
//             }
//           } else {
//             $curl = curl_init();
//             curl_setopt_array($curl, array(
//               CURLOPT_URL => 'https://api.fonnte.com/send',
//               CURLOPT_RETURNTRANSFER => true,
//               CURLOPT_ENCODING => '',
//               CURLOPT_MAXREDIRS => 10,
//               CURLOPT_TIMEOUT => 0,
//               CURLOPT_FOLLOWLOCATION => true,
//               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//               CURLOPT_CUSTOMREQUEST => 'POST',
//               CURLOPT_POSTFIELDS => array(
//                 'target' => $sender,
//                 'message' => "Pesan tidak terkirim",
//                 // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//                 // 'filename' => 'filename',
//                 'schedule' => '0',
//                 'typing' => false,
//                 'delay' => '2',
//                 'countryCode' => '62',
//               ),
//               CURLOPT_HTTPHEADER => array(
//                 'Authorization: ' . $tokenfonnte
//               ),
//             ));
//             $response = curl_exec($curl);
//             curl_close($curl);
//           }
//         }
//       } else if ($noperusahaan != null) {
//         $tempgettarget = preg_match("/\d+/", $message, $tempnotarget);
//         if ($tempnotarget != null) {
//           $notarget = $tempnotarget[0];
//           $temppesan = explode($notarget, $message);
//           $temppesan2 = explode("\n", $temppesan[1]);
//           $pesan = $temppesan2[1];
//           $curl = curl_init();
//           curl_setopt_array($curl, array(
//             CURLOPT_URL => 'https://api.fonnte.com/send',
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => '',
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => 'POST',
//             CURLOPT_POSTFIELDS => array(
//               'target' => $notarget,
//               'message' => $pesan,
//               // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//               // 'filename' => 'filename',
//               'schedule' => '0',
//               'typing' => false,
//               'delay' => '2',
//               'countryCode' => '62',
//             ),
//             CURLOPT_HTTPHEADER => array(
//               'Authorization: ' . $tokenfonnte
//             ),
//           ));
//           $response = curl_exec($curl);
//           curl_close($curl);
//         } else {
//           $curl = curl_init();
//           curl_setopt_array($curl, array(
//             CURLOPT_URL => 'https://api.fonnte.com/send',
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => '',
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => 'POST',
//             CURLOPT_POSTFIELDS => array(
//               'target' => $sender,
//               'message' => "Pesan tidak terkirim",
//               // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//               // 'filename' => 'filename',
//               'schedule' => '0',
//               'typing' => false,
//               'delay' => '2',
//               'countryCode' => '62',
//             ),
//             CURLOPT_HTTPHEADER => array(
//               'Authorization: ' . $tokenfonnte
//             ),
//           ));
//           $response = curl_exec($curl);
//           curl_close($curl);
//         }
//       } else {
//         if ($setting->no_penerima_pesan != null) {
//           $curl = curl_init();
//           curl_setopt_array($curl, array(
//             CURLOPT_URL => 'https://api.fonnte.com/send',
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => '',
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => 'POST',
//             CURLOPT_POSTFIELDS => array(
//               'target' => $setting->no_penerima_pesan,
//               'message' => $sender . "\n" . $message,
//               // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
//               // 'filename' => 'filename',
//               'schedule' => '0',
//               'typing' => false,
//               'delay' => '2',
//               'countryCode' => '62',
//             ),
//             CURLOPT_HTTPHEADER => array(
//               'Authorization: ' . $tokenfonnte
//             ),
//           ));
//           $response = curl_exec($curl);
//           curl_close($curl);
//         }
//       }
//     }
//   }

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
