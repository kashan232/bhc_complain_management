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
						<form id="searchForm" action="{{ route('search-complaints-by-type') }}" method="get">
							@csrf
							<h2 class="mb-4 pt-2 pb-2 mt-2 mb-2 text-center font-weight-bold ">Report by Complaints Type </h2>

							<div class="row pl-4 pr-4">
								<div class="col-12 mt-2 mb-2">
									<div class="form-group">
										<label for="startDate">Complaints Type</label>
										<select id="nature_of_complaint" class="form-control" name="nature_of_complaint" required>
										<option value="De-Credit">De-Credit</option>
										<option value="Eligible">Eligible</option>
										<option value="Ineligible">Ineligible</option>
										<option value="Underage Case">Underage Case</option>
										<option value="Error 938">Error 938</option>
										<option value="Error 920">Error 920</option>
										<option value="Error 933 - District Not Match">Error 933 - District Not Match </option>
										<option value="Error 368 - CNIC cannot be verified">Error 368 - CNIC cannot be verified</option>
										<option value="Death Case">Death Case</option>
										<option value="Finger Print Issue">Finger Print Issue</option>
										<option value="Expired CNIC">Expired CNIC</option>
										<option value="Wrong CNIC">Wrong CNIC</option>
										<option value="Others">Others</option>
										</select>
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