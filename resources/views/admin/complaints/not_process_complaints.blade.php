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
								<h4 class="card-title">Un-Resolved Complaints </h4>
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
											@foreach($not_process_complaints as $not_process_complaint)
												<tr>
													<td>{{ $not_process_complaint->created_at->format('F j, Y') }}</td>
													<td>{{ $not_process_complaint->name }}</td>
													<td>{{ $not_process_complaint->fathername }}</td>
													<td>{{ $not_process_complaint->cnic }}</td>
													<td>{{ $not_process_complaint->district }}</td>
													<td>{{ $not_process_complaint->taluka }}</td>
													<td>{{ $not_process_complaint->contact }}</td>
													<td>{{ $not_process_complaint->nature_of_complaint }}</td>
													<td>
														@if($not_process_complaint->status == 'Not Process Yet')
															<button class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </button>
														@endif
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
									<div class="py-5">
                                        {{ $not_process_complaints->appends(request()->input())->links() }}
                                    </div>
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