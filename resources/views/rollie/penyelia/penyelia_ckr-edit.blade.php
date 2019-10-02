@extends('rollie.penyelia.templates.layout')
@section('title')
ROLLIE | MTOL
@endsection
@section('active-$menu->link')
active
@endsection

@section('content')
    <!-- fixed-top-->

    <!-- ////////////////////////////////////////////////////////////////////////////-->
<br>
    <div class="app-content content">
      
        
        <div class="content-body">
<!-- Bordered table start -->
<div class="row">
	<div class="col-12">
		<div class="card-content show" id="card">
			<div class="card-header">
				<h4 class="card-title" style="color: black;">
					<i class="fa fa-edit"></i> CKR Edit
				</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="show">Signed as, {{ $username->user->role->role }}<i class="ft-user"></i></a></li>
						<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						<li><a data-action="close"><i class="ft-x"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
					<label>dd/mm/yy</label>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-dark mb-0">
						<thead class="thead-dark" align="center">
							<tr>
								<th>Tanggal</th>
								<th>Nama Mesin</th>
								<th>Nama Produk</th>
								<th>No WO</th>
								<th>
									<div class="form-inline">
									  <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>
									  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
									    <option selected>Kategory Activity</option>
									    <option value="1">PDT</option>
									    <option value="2">UPDT</option>
									    <option value="3">Prod Time</option>
									  </select>
	                            	</div>
                        		</th>
								<th>Activity</th>
								<th>Kategori BD</th>
								<th>Detail BD</th>
								<th>Start</th>
								<th>Stop</th>
								<th>Durasi(menit)</th>
								<th>
									<div class="btn-group mr-1 mb-1 btn-group-sm">
		                                	<button type="button" class="btn btn-dark">Keterangan</button>
		                                	<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                                	</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#">Input Manual Tiap Row</a>
										</div>
										</div>
								</th>
								<th>
									<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
	                                <button type="button" class="btn btn-info">Phase</button>
	                            	</div>
                            	</th>
                            	<th>
                            		<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            		<button type="button" class="btn btn-danger">Stops</button>
                            		</div>
                            	</th>
                            	<th>
                            		<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            		<button type="button" class="btn btn-warning">Kategori Idle</button>
                            		</div>
                            	</th>
                            	<th>
                            		<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            		<button type="button" class="btn btn-warning">Penyebab Idle</button>
                            		</div>
                            	</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th><input type="date" name=""></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>=(Stop=start)</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th><input type="date" name=""></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>=(Stop=start)</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th><input type="date" name=""></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>=(Stop=start)</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th><input type="date" name=""></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>=(Stop=start)</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th><input type="date" name=""></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>=(Stop=start)</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th><input type="date" name=""></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>=(Stop=start)</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th><input type="date" name=""></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>=(Stop=start)</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
					<div class="btn btn-group">
						<a href="rollie-penyelia-penyelia_ckr" class=" btn btn-info"><i class="fa fa-mail-reply"></i> Back</a>
					</div>
					<div class="btn btn-group">
						<a href="" class="btn btn-success"><i class="fa fa-retweet"></i> Update data</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Bordered table end -->
      <!---->
    <!-- Styles -->
    <div class="card-content show" id="card2">
<style>
#card {
	background-color: white; 
}
#card2 {
	background-color: ;
}
</style>

<!-- Resources -->
	<script type="text/javascript" src="{{ asset('rollie/penyelia/lib/amchart/charts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('rollie/penyelia/lib/amchart/core.js')}}"></script>
    <script type="text/javascript" src="{{ asset('rollie/penyelia/lib/amchart/themes/animated.js')}}"></script>
 <!-- Chart code -->
    <!-- ////////////////////////////////////////////////////////////////////////////-->
@endsection