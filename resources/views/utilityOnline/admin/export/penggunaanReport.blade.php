<table>
    <thead>
        <tr>
            <th rowspan="3">No</th>
            <th rowspan="3">Bagian</th>
            <th rowspan="3">Satuan</th>
            <th colspan="{{ $jmlTgl * 2 }}">Tanggal</th>
        </tr>
        <tr>
            @foreach($tgl as $t)
                <td colspan='2'>{{$t}}</td>
            @endforeach
        </tr>
        <tr>
            @for($i =0; $i<= $jmlTgl/2; $i++)
                <th>NFI</th>
                <th>HNI</th>
            @endfor
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
                        <td>{{ $penggunaan[0]->nilai_nfi }}</td>
                        <td>{{ $penggunaan[0]->nilai_hni }}</td>
                    @else
                        <td> 0 </td>
                    @endif
                @endforeach

            </tr>        
        @endforeach
    </tbody>
</table>