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
								<h4 class="card-title">All Complaints </h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example3" class="display">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Date of complaint</th>
												<th>Name</th>
												<th>Father Name</th>
												<th>CNIC</th>
												<th>District</th>
												<th>Taluka</th>
												<th>Contact</th>
												<th>Complaint Nature</th>
												<th>Closed Complaint</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($all_complaints as $all_complaint)
												<tr>
													<td> {{$loop->iteration}} </td>
													<td>{{ $all_complaint->created_at->format('F j, Y') }}</td>
													<td>{{ $all_complaint->name }}</td>
													<td>{{ $all_complaint->fathername }}</td>
													<td>{{ $all_complaint->cnic }}</td>
													<td>{{ $all_complaint->district }}</td>
													<td>{{ $all_complaint->taluka }}</td>
													<td>{{ $all_complaint->contact }}</td>
													<td>{{ $all_complaint->nature_of_complaint }}</td>
													<td>
														@if($all_complaint->status == 'Closed')
															<span>{{ $all_complaint->updated_at->format('F j, Y') }}</span>
														@else
															<span>Not Closed</span>
														@endif
													</td>
													<td>
														@if($all_complaint->status == 'Not Process Yet')
															<button class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved</button>
														@elseif($all_complaint->status == 'In process')
															<button class="btn btn-primary btn-sm">In-Progress</button>
														@elseif($all_complaint->status == 'Closed')
															<button class="btn btn-success btn-sm">Closed</button>
														@elseif($all_complaint->status == 'Incomplete')
															<button class="btn btn-info btn-sm">Incomplete</button>
														@endif
													</td>
													<td>
														<a href="{{ route('view-complaints',['id' => $all_complaint->id,'cnic' => $all_complaint->cnic ]) }}" class="btn btn-info btn-sm" style="font-size: 12px!important;">View</a>
													</td>
												</tr>
											@endforeach
											
											
										</tbody>
									</table>
									<div class="py-5">
                                        {{ $all_complaints->appends(request()->input())->links() }}
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