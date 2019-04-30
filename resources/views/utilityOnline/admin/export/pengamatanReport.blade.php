<table>
    <thead>
        <tr>
            <td>No</td>
            <td>Bagian</td>
            <td>Nilai</td>
            <td>Nama</td>
            <td>User Update</td>
            <td>Created At</td>
            <td>Last Update</td>
        </tr>
    </thead>
    <tbody>
    <?php $no=0 ?>
        @foreach($pengamatan as $p)
            <tr>
                <?php $no++ ?>
                <td>{{ $no }}</td>
                <td>{{ $p->bagian->bagian }}</td>
                <td>{{ $p->nilai_meteran }}</td>
                <td>{{ $p->user->karyawan->fullname }}</td>
                @if($p->user_update)
                    <td>{{ $p->user_update->karyawan->fullname }}</td>
                @else
                    <td>{{ $p->user_update }}</td>
                @endif
                <td>{{ $p->created_at }}</td>
                <td>{{ $p->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>