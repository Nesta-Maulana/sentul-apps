<table>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Bagian</th>
            <th rowspan="2">Satuan</th>
            <th colspan="{{ $jmlTgl }}">Tanggal</th>
        </tr>
        <tr>
            @foreach($tgl as $t)
                <td>{{$t}}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
    <?php $no=0 ?>
        @foreach($bagian as $b)
        <?php $no++ ?>
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $b['bagian'] }}</td>
                <td>{{ $b['satuan'] }}</td>
                @foreach($b['nilai'] as $n)
                    @if($n)
                        <td>{{ $n['nilai'] }}</td>
                    @else
                        <td> 0 </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
