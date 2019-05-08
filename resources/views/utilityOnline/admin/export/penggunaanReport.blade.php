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
                <th>{{ $t }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <?php $no=0 ?>
        @foreach($bagian as $b)
        <?php $no++ ?>
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $b->bagian }}</td>
                <td>{{ $b->satuan->satuan }}</td>
                @foreach($b->penggunaan as $penggunaan)
                    @if($penggunaan[0])
                        <td>{{ $penggunaan[0]->nilai }}</td>
                    @else
                        <td> 0 </td>
                    @endif
                @endforeach

            </tr>        
        @endforeach
    </tbody>
</table>