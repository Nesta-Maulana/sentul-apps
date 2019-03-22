@extends('rollie.templates.layout2')
@section('title')
    Rollie | Package Integrity
@endsection
@section('active-package')
    m-menu__item--active
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('content')

<button class="btn btn-primary" data-id="' + data[index].pengamatan.id + '" data-toggle="modal" data-target="#exampleModal">Import</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header back-purple">
                    <h5 class="text-white">Import</h5>
                </div>
                <div class="modal-body">
                    <select name="" id="" class="form-control mb-3">
                        <option value="">BRIX</option>
                        <option value="">Prisma</option>
                    </select>
                    <input type="file" class="form-control-file">
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                    <button class="btn back-purple text-white" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection