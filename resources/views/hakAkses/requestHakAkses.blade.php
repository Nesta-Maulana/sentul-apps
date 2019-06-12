@extends('hakAkses.templates.layout')
@section('judul')
    Request Hak Akses
@endsection
@section('active-hak-akses')
    active
@endsection
@section('slogan')
    Request your <span>Hak Akses</span>
@endsection
@section('link-to-content')
    #hak-akses
@endsection
@section('content')

    <div class="row" id="hak-akses">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 info-panel mt-5">
            <div class="form-group">
                <label for="aplikasi">Aplikasi</label>
                <select name="aplikasi" id="aplikasi" class="form-control">
                    <option value="" selected disabled>-- PILIH APLIKASI --</option>
                    @foreach($aplications as $aplication)
                        <option value="{{ $aplication->id }}">{{ $aplication->aplikasi }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table mt-2 text-center table-hak-akses text-vertical-center" border='1'>
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Menu</th>
                        <th colspan="2">Create</th>
                        <th colspan="2">Read</th>
                        <th colspan="2">Update</th>
                        <th colspan="2">Delete</th>
                    </tr>
                    <tr>
                        <td>Y</td>
                        <td>T</td>
                        <td>Y</td>
                        <td>T</td>
                        <td>Y</td>
                        <td>T</td>
                        <td>Y</td>
                        <td>T</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Form Menu</td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" value="checkedValue" checked>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection()
