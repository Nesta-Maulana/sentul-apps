<table>
    <thead>
        <tr>
            <td rowspan='2' style="text-align:center" >No</td>
            <td rowspan='2' style="text-align:center" >Bagian</td>
            <td rowspan='2' style="text-align:center" >Satuan</td>
            <td colspan="{{ $jmlTgl }}" style="text-align:center">Tanggal</td>
        </tr>
        <tr>
            @foreach($tgl as $t)
                <td>{{ $t }}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
    <?php $no=0 ?>
    @foreach($bagian as $b)
        <?php $no++ ?>
            <tr>
                <td rowspan="2">{{ $no }}</td>
                <td rowspan="2">{{ $b->bagian }}</td>
                <td rowspan="2">{{ $b->satuan->satuan }}</td>
                @foreach($b->pengamatan as $pengamatan)
                    @if($pengamatan[0])
                        <td>{{ $pengamatan[0]->nilai_meteran }}</td>
                    @else
                        <td> Tidak Ada Inputan </td>
                    @endif
                @endforeach
            </tr>
            <tr>
                @foreach($b->pengamatan as $pengamatan)
                    @if($pengamatan[0])
                        <td>{{ $pengamatan[0]->user->karyawan->fullname }}</td>
                    @else
                        <td>Tidak Ada Pengamat</td>
                    @endif
                @endforeach
            </tr>            
        @endforeach
    </tbody>
</table>