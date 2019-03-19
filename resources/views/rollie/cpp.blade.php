@extends('rollie.templates.layout')
@section('title')
    Rollie | CPP
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
    <div class="mr-5 ml-5">
        <div class="row mt-4">
            <div class="col-lg-6 bg main-color p-3 text-white rounded">
                <h3 class="text-center">CPP</h3>
                <hr class="bg-white">
                <div class="form-group">
                    <label for="produk">Nama Produk :</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <table class="table ">
                    <thead class="thead text-white main-color">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection