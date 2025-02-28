@include('admin.include.main_header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
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
						<form id="searchForm" action="{{ route('search-complaints-by-date') }}" method="get">
							@csrf
							<h2 class="mb-4 pt-2 pb-2 mt-2 mb-2 text-center font-weight-bold ">Between Dates Complaints Report</h2>

							<div class="row pl-4 pr-4">
								<div class="col-12 mt-2 mb-2">
									<div class="form-group">
										<label for="startDate">Start Date:</label>
										<input type="date" class="form-control" id="startDate" name="startDate" required>
									</div>
								</div>
								<div class="col-12 mt-2 mb-2">
									<div class="form-group">
										<label for="endDate">End Date:</label>
										<input type="date" class="form-control" id="endDate" name="endDate" required>
									</div>
								</div>
								<div class="text-center mt-2 mb-2 w-100">
									<button type="submit" class="btn btn-success" id="searchButton">Search</button>
								</div>
							</div>
						</form>
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
@include('admin.include.footer_links')


</body>

</html>