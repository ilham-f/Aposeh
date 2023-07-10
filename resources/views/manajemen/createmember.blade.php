@extends('layouts.main')

@section('content')
    <form action="/creatememberpost" method="POST" class="w-full max-w-lg mt-4">
        @csrf
        {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}

        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-city">
                    Nama Member
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-city" type="text" name="nama_member">
                @error('nama_member')
                    <div class="error text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-city">
                    No Telpon
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-city" type="text" name="notelp">
                @error('notelp')
                    <div class="error text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-city">
                    Alamat
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-400 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-city" type="text" name="alamat">
                @error('alamat')
                    <div class="error text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-state">
                    Jenis Kelamin
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-400 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state" name="jk">
                        <option selected value="">-- Pilih Jenis Kelamin --</option>
                        <option value="1">Laki-laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
                @error('jk')
                    <div class="error text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-state">
                    Pegawai yang menangani
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-400 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state" name="user_id">

                        <option selected value="">-- Pilih Pegawai --</option>
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
                @error('user_id')
                    <div class="error text-red-600">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="flex justify-between">
            <a href="/indexdatamember" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah
            </button>
        </div>



    </form>
@endsection
