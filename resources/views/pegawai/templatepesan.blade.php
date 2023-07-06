@extends('layouts.main')
<link rel="stylesheet" href="/public/assets/css/tailwind.css">
<link rel="stylesheet" href="/public/assets/css/tailwind.output.css">
<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
@section('content')
<div style="padding-bottom: 50px; padding-top: 30px;">
    <div class="container" style="border-radius: 25px; background-color: white; width:100%; height:fit-content; padding-top:40px;">
        <h1 style="color: grey; padding-left:30px; font-size:30px; font-weight:500; padding-bottom:10px;">Template pesan</h1>
        <form action="/tambahtemplatepesan" method="post" style="padding-left: 30px; padding-right: 30px;">
           @csrf 
            <label style="padding-top: 5px; color:grey; font-weight:500; padding-top: 5px">Tuliskan template</label><br>
            <textarea name='chat' style="margin-bottom: 30px; width:100%; border-radius:8px ; border:0px; background-color: white; box-shadow: 2px 3px 5px rgba(150, 146, 146, 0.8);" type="text"></textarea>
            <button type="submit" style="margin-bottom: 30px; color:grey;">Simpan</button>
        </form>
    </div>
</div>
<div style="paddi">
    <div class="container" style="border-radius: 25px; background-color: white; width:100%; height:500px; padding-top:40px;">
       <div style="padding-inline: 30px;">
        <table>
            
            <tr>
                <th>Id</th>
                <th>Chat</th>
                <th>Aksi</th>
            </tr>
            @foreach($datablade as $chatt)
            <tr>
                <td>{{ $chatt->id }}</td>
                <td>{{ $chatt->chat }}</td>
                <td>
                    <a href="{{ url('templatepesan/'.$chatt->id.'/edit') }}">Edit</a>
                    <a href="/hapustemplatepesan/{{ $chatt->id }}" style="btn btn-primary">Delete</a></td>
                    
                </tr>
                @endforeach
          </table>

        </div> 
            </div>
</div>

<!-- Modal toggle -->



@endsection