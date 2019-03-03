@extends('utilityOnline.templates.layout')
@section('title')
    Utility Online | Database
@endsection
@section('content')

<div id="particles-js"></div>
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-6 teks rounded-top-left pt-3">
            <h3 class="text-white d-flex justify-content-center">Database</h3>
            <div class="form-group">
                <label for="jenis" class="text-white">Pilih Jenis : </label>
                <select name="jenis" id="jenis" class="form-control">
                    <option value="">Water</option>
                    <option value="">Energy</option>
                    <option value="">Utility</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jenis" class="text-white">Pilih Jenis : </label>
                <select name="jenis" id="jenis" class="form-control">
                    <option value="">Water</option>
                    <option value="">Energy</option>
                    <option value="">Utility</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 teks rounded-top-right"></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12 s12 teks rounded-top-right rounded-bottoms align-middle">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="align-center">Isi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-secondary text-white">
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, maxime?
                        </td>
                        <td><button class="btn btn-primary">Edit</button></td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, maxime?
                        </td>
                        <td><button class="btn btn-primary">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, maxime?
                        </td>
                        <td><button class="btn btn-primary">Edit</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>

@endsection