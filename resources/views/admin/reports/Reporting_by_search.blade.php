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
						<form id="searchForm" method="get">
							<h2 class="mb-4 pt-2 pb-2 mt-2 mb-2 text-center font-weight-bold">Search Complaints</h2>
							<div class="row pl-4 pr-4">
								<div class="col-12 mt-2 mb-2">
									<div class="form-group">
										<label for="cnic">Enter CNIC:</label>
										<input type="text" class="form-control" id="cnic" name="cnic" placeholder="Enter CNIC in the format XXXXXXXXXXXXX." required>
										<small class="form-text text-muted"></small>
									</div>
								</div>
								<div class="text-center mt-2 mb-2 w-100">
									<button type="button" class="btn btn-success" id="searchButton">Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">All Complaints </h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="display table table-striped">
									<thead>
										<tr>
											<th>Name</th>
											<th>CNIC</th>
											<th>District</th>
											<th>Taluka</th>
											<th>Contact</th>
											<th>Nature of Complaint</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody id="complaintsTable">

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
@include('admin.include.footer_links')

<script>
	$(document).ready(function () {
		$('#searchButton').on('click', function () {
			var cnic = $('#cnic').val();
			$.ajax({
				type: 'get',
				url: '{{ route("search-complaints-by-cnic") }}',
				data: { cnic: cnic },
				dataType: 'json',
				success: function (response) {
					displaySearchResults(response.complaints);
				},
				error: function (error) {
					console.log(error);
				}
			});
		});

			function displaySearchResults(complaints) {
				var tbody = $('#complaintsTable');
				tbody.empty();

				if (complaints.length === 0) {
					tbody.append('<tr><td colspan="7">No complaints found for the given CNIC.</td></tr>');
				} else {
					complaints.forEach(function (complaint) {
						var statusHtml = '';

					    if (complaint.status === 'Not Process Yet') {
							statusHtml = '<button class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </button>';
						} else if (complaint.status === 'In process') {
							statusHtml = '<button class="btn btn-primary btn-sm">In-Progress</button>';
						} else if (complaint.status === 'Closed') {
							statusHtml = '<button class="btn btn-success btn-sm">Closed</button>';
						}else if (complaint.status === 'Incomplete') {
							statusHtml = '<button class="btn btn-info btn-sm">Incomplete</button>';
						}

						var row = '<tr>' +
							'<td>' + complaint.name + '</td>' +
							'<td>' + complaint.cnic + '</td>' +
							'<td>' + complaint.district + '</td>' +
							'<td>' + complaint.taluka + '</td>' +
							'<td>' + complaint.contact + '</td>' +
							'<td>' + complaint.nature_of_complaint + '</td>' +
							'<td>' + statusHtml + '</td>' +
							'</tr>';

						tbody.append(row);
					});
				}
			}
	});

</script>



</body>

</html>