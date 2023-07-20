@extends('layouts.main')

@section('content')
    <style>
        #chatscroll::-webkit-scrollbar {
            width: 0.1em;
            /* Set the width of the invisible scrollbar */
        }

        #chatscroll::-webkit-scrollbar-track {
            background-color: transparent;
            /* Set the background color of the invisible scrollbar track */
        }

        #chatscroll::-webkit-scrollbar-thumb {
            background-color: transparent;
            /* Set the color of the invisible scrollbar thumb */
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <div class="container mt-4">
        <div class="row clearfix">
            <div class="col-lg-12">
                @if (count($chats) != 0)
                    <div class="card chat-app" style="height: 670px">
                        <div id="plist" class="people-list">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            <ul class="list-unstyled chat-list mt-2 mb-0">
                                @foreach ($chats as $no_pengirim)
                                    @if ($no_pengirim != Auth::user()->notelp)
                                        <li class="clearfix flex justify-between items-center" id="{{ $loop->index }}">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                            <div class="">{{ $no_pengirim }}</div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="chat p-4" style="height: 670px" style="overflow: hidden">
                            <div class="chat-header clearfix">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="flex mr-2 items-center">
                                            <a id="fotoOrang" href="javascript:void(0);" data-toggle="modal"
                                                data-target="#view_info">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    alt="avatar">
                                            </a>
                                            <div class="chat-about">
                                                <h6 class="m-b-0" id="orang"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-history" style="overflow: hidden">
                                <div class="hidden" id="jmlChat">{{ count($chats) }}</div>
                                @foreach ($chats as $cht)
                                    <ul class="m-b-0 {{ $loop->index }}" id="chatscroll" value="{{ $cht }}"
                                        style="height: 470px; overflow-y: auto; overflow-x:hidden">
                                        @php
                                            $chatorangmasuk = App\Models\Chat::where('no_pengirim', $cht)
                                                ->orWhere('no_pengirim', Auth::user()->notelp)
                                                ->get();
                                            $pegawai = App\Models\User::where('role', 'pegawai')->get();
                                            $pegawaiArr = [];
                                            foreach ($pegawai as $peg) {
                                                $pegawaiArr[] = $peg->notelp;
                                            }
                                        @endphp
                                        {{-- @dd($chatorangmasuk) --}}
                                        @foreach ($chatorangmasuk as $chtorang)
                                            @if ($chtorang->no_pengirim == Auth::user()->notelp)
                                                <br>
                                                <li class="text-right" style="margin: 0">
                                                    <div class="message other-message float-right">{{ $chtorang->isi }}
                                                    </div>
                                                </li>
                                            @else
                                                <br>
                                                <li class="text-left" style="margin: 0">
                                                    <div class="message other-message float-left">{{ $chtorang->isi }}</div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                            <div id="chat" class="chat-message clearfix"
                                style="position:absolute;bottom: 0; width: 75%">
                                <div class="input-group mb-0 flex justify-between items-center">
                                    <form action="/kirimchat" method="post" id="chatform">
                                        @csrf
                                        <input type="hidden" name="no_penerima" value="" id="target">
                                        <input type="hidden" name="no_pengirim" value="{{ Auth::user()->notelp }}">
                                        <textarea style="width: 350%; padding: 10px" name="isi" class="form-control" placeholder="Enter text here..."></textarea>
                                    </form>
                                    <div id="submit" class="input-group-prepend mr-4"
                                        style="font-size: 40px; cursor: pointer;">
                                        <span class="input-group-text"><i class="fa fa-send"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <span class="text-white">Belum ada chat masuk</span>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var jmlChat = $('#jmlChat').html();
            $('#fotoOrang').hide();
            $('#chat').hide();
            // alert(jmlChat);
            for (let i = 0; i < jmlChat; i++) {
                $('.' + i).hide();

                $('#' + i).click(function(e) {
                    $('#chat').show();
                    $('#fotoOrang').show();
                    e.preventDefault();
                    var noOrang = $('.' + i).attr('value');
                    // alert(noOrang);
                    $('#orang').html(noOrang);
                    $('#target').val(noOrang);
                    $('.' + i).show();
                    for (let j = 0; j < jmlChat; j++) {
                        if (j != i) {
                            $('.' + j).hide();
                        }
                    }
                });
            }

            $('#submit').click(function(e) {
                e.preventDefault();
                $('#chatform').submit();
            });

            var no = '{{ session("chat") }}';
            if (no) {
                for (let i = 0; i < jmlChat; i++) {
                    var notelp = $('.' + i).attr('value');
                    if (no == notelp) {
                        $('.' + i).show();
                    }
                }
            }
        });
    </script>
@endsection
