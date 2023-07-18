@extends('layouts.main')

@section('content')
    <form action="/editmember/{{ $member->id }}" method="POST" class="w-full max-w-lg mt-4">
        @csrf
        @method('put')
        {{-- <input value="{{  }}" type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-city">
                Nama Member
            </label>
            <input value="{{ $member->nama_member }}"
                class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-city" type="text" placeholder="Albuquerque" name="nama_member">
        </div>
        {{-- <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-first-name">
          Nama Depan
        </label>
        <input value="{{  }}" class="appearance-none block w-full bg-gray-200 text-gray-400 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane">
        <p class="text-red-500 text-xs italic">Please fill out this field.</p>
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-last-name">
          Nama Belakang
        </label>
        <input value="{{  }}" class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe">
      </div>
    </div> --}}

        {{-- <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
          Password
        </label>
        <input value="{{  }}" class="appearance-none block w-full bg-gray-200 text-white border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" placeholder="******************">
        <p class="text-white text-xs italic">Make it as long and as crazy as you'd like</p>
      </div>
    </div> --}}
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-city">
                No Telpon
            </label>
            <input value="{{ $member->notelp }}"
                class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-city" type="text" placeholder="Albuquerque" name="notelp">
        </div>

        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-city">
                    Alamat
                </label>
                <input value="{{ $member->alamat }}"
                    class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-city" type="text" placeholder="Albuquerque" name="alamat">
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-state">
                    Jenis Kelamin
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-400 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state" name="jk">
                        <option @if ($member->status == 1)
                            selected
                        @endif
                            value="1">Laki-laki</option>
                        <option @if ($member->status == 2)
                            selected
                        @endif
                            value="2">Perempuan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            {{-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-zip">
          Zip
        </label>
        <input value="{{  }}" class="appearance-none block w-full bg-gray-200 text-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="90210">
      </div> --}}
{{-- 
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-city">
                    Keluhan
                </label>
                <input value="{{ $member->keluhan }}"
                    class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-city" type="text" placeholder="Albuquerque" name="keluhan">
            </div> --}}

            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-state">
                    Status
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-400 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state" name="status">
                  <option   @if ($member->status==1)
                    selected
                    @endif value="1">Aktif</option>
                  <option   @if ($member->status==0)
                    selected
                    @endif value="0">Tidak Aktif</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            {{-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-state">
                    Pegawai yang menangani
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-400 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state" name="user_id">

                        <option selected>-- Pilih Pegawai --</option>
                        @foreach ($pegawai as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div> --}}

        </div>

        {{-- <div class="flex justify-start">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Kembali
      </button>
    </div>

    <div class="flex justify-end">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Tambah
      </button>
    </div> --}}
        {{-- <div class="flex justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Kembali
      </button>
    
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Tambah
      </button>
    </div> --}}
        <div class="flex justify-between">
            <a href="/indexdatamember" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                ubah
            </button>
        </div>



    </form>
@endsection
