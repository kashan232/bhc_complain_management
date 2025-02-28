@include('admin.include.main_header')

<!--**********************************
	Main wrapper start
***********************************-->
<div id="main-wrapper">

	<!--**********************************
		Nav header start
	***********************************-->
	@include('admin.include.header')
	<!--**********************************
		Nav header end
	***********************************-->

	<!--**********************************
		Header start
	***********************************-->
	@include('admin.include.navbar')

	<!--**********************************
		Header end ti-comment-alt
	***********************************-->

	<!--**********************************
		Sidebar start
	***********************************-->
	@include('admin.include.sidebar')
	<!--**********************************
		Sidebar end
	***********************************-->

	<!--**********************************
		Content body start
	***********************************-->
	<div class="content-body">
		<!-- row -->
		<div class="container-fluid">

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">All Talukas </h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="example3" class="display">
									<thead>
										<tr>
											<th>Sno</th>
											<th>District Name</th>
											<th>Taluka Name</th>
											<th>Created At</th>
										</tr>
									</thead>
									<tbody>
										@foreach($Talukas as $Taluka)
											<tr>
												<td> {{$loop->iteration}} </td>
												<td>{{ $Taluka->district_id }}</td>
												<td>{{ $Taluka->tehsil_name }}</td>
												<td>{{ $Taluka->created_at->diffForHumans() }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--**********************************
		Content body end
	***********************************-->


	<!--**********************************
		Footer start
	***********************************-->
	@include('admin.include.powerd_by')
	<!--**********************************
		Footer end
	***********************************-->

	<!--**********************************
	   Support ticket button start
	***********************************-->

	<!--**********************************
	   Support ticket button end
	***********************************-->


</div>
<!--**********************************
	Main wrapper end
***********************************-->

<!--**********************************
	Scripts
***********************************-->
<!-- Required script -->
@include('admin.include.footer_links')

</body>

</html>