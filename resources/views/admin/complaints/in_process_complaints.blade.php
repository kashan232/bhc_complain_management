@include('admin.include.main_header')
<style>
    .bottom--impo th
    {
      padding-right: 28px!important;
    font-size: 22px!important;
    color: #000!important;
    text-align: center;
    }
    .h-5 
    { 
      width: 30px;
    }
    .leading-5
    {
      padding: 15px 0px;
      
    }
    .leading-5 span:nth-child(3)
    {
      color: red;
      font-weight: 500;
    }
    .dataTables_info
    {
        display:none;
    }
    .dataTables_paginate
    {
        display:none;
    }
  </style>
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
								<h4 class="card-title">In-Progress Complaints </h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
								<table id="example3" class="display" style="min-width: 845px">
										<thead>
											<tr>
												<th>Date of complaint</th>
												<th>Name</th>
												<th>Father Name</th>
												<th>CNIC</th>
												<th>District</th>
												<th>Taluka</th>
												<th>Contact</th>
												<th>Nature of Complaint</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											@foreach($In_process_complaints as $In_process_complaint)
												<tr>
													<td>{{ $In_process_complaint->created_at->format('F j, Y') }}</td>
													<td>{{ $In_process_complaint->name }}</td>
													<td>{{ $In_process_complaint->fathername }}</td>
													<td>{{ $In_process_complaint->cnic }}</td>
													<td>{{ $In_process_complaint->district }}</td>
													<td>{{ $In_process_complaint->taluka }}</td>
													<td>{{ $In_process_complaint->contact }}</td>
													<td>{{ $In_process_complaint->nature_of_complaint }}</td>
													<td>
														@if($In_process_complaint->status == 'In process')
															<button class="btn btn-primary btn-sm">In-Progress</button>
														@endif
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
									<div class="py-5">
                                        {{ $In_process_complaints->appends(request()->input())->links() }}
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