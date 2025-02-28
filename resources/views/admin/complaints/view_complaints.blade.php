@include('admin.include.main_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Complaint Action Remark</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="complaintForm">
				<div class="alert alert-success text-dark" role="alert" id="alertmessage" style="display: none;"></div>
					<input type="hidden" name="complain_id" value="{{ $view_complaints->id }}" readonly>
					<input type="hidden" name="complain_cnic" value="{{ $view_complaints->cnic }}" readonly>
					<div class="form-group">
						<label for="status">Status:</label>
						<select class="form-control" id="status" name="status">
							<option value="In process">In process</option>
							<option value="Closed">Closed</option>
						</select>
					</div>

					<div class="form-group">
						<label for="remark">Remark:</label>
						<textarea class="form-control" id="remark" name="remark" rows="5"></textarea>
					</div>
					<div class=" w-100 text-right">
						<button type="button" class="btn btn-primary" id="submitBtn">Submit</button>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Your modal HTML -->
<div class="modal" id="successModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Success</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="successMessage"></p>
            </div>
        </div>
    </div>
</div>

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
	<div class="content-body" id="pdfContent">
		<!-- row -->
		<div class="container-fluid">

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">View Complaints Details </h4>
							<!-- <a href="#" class="btn btn-success text-white" id="generatePdfBtn">Generate PDF</a> -->
						</div>
						<div class="card-body table-border-style">
							<div class="table-responsive">
								<hr>
								<table class="table table-bordered">
									<tbody>

										<tr>
											<td><b>Complaint Number</b></td>
											<td> {{ $view_complaints->id }} </td>
											<td><b>Complainant Name</b></td>
											<td> {{ $view_complaints->name }} </td>
											<td><b> Date Of Complaint </b></td>
											<td> {{ $view_complaints->created_at->format('F j, Y') }} </td>
										</tr>


										<tr>
											<td><b>District</b></td>
											<td> {{ $view_complaints->district }} </td>
											<td><b>Taluka</b></td>
											<td> {{ $view_complaints->taluka }} </td>
											<td><b>Cnic</b></td>
											<td> {{ $view_complaints->cnic }} </td>
										</tr>

										<tr>
											<td><b>Contact </b></td>
											<td colspan="5"> {{ $view_complaints->contact }} </td>
										</tr>

										<tr>
											<td><b>Complaint Details </b></td>
											<td colspan="5"> {{ $view_complaints->nature_of_complaint }}.</td>
										</tr>

										<tr>
											<td><b>Complaint Descrpition </b></td>
											<td colspan="5"> {{ $view_complaints->other_descrpition }}.</td>
										</tr>

										<tr>
											<td><b>Final Status</b></td>

											<td colspan="5">
												@if($view_complaints->status == 'Not Process Yet')
												<span class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </span>
												@elseif($view_complaints->status == 'In process')
												<span class="btn btn-primary btn-sm">In-Progress</span>
												@elseif($view_complaints->status == 'Closed')
												<span class="btn btn-success btn-sm">Closed</span>
												@elseif($complaint_remark->status == 'Incomplete')
												<span class="btn btn-info btn-sm">Incomplete</span>
												@endif
											</td>

										</tr>

										<tr>
											<th>S.No</th>
											<th colspan="3">Remark</th>
											<th>Status</th>
											<th>Updation Date</th>
										</tr>
										@foreach($complaint_remarks as $complaint_remark)
											<tr>
												<td>{{$loop->iteration}}</td>
												<td colspan="3">{{ $complaint_remark->remark }}</td>
												<td>
													@if($complaint_remark->status == 'Not Process Yet')
													<span class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </span>
													@elseif($complaint_remark->status == 'In process')
													<span class="btn btn-primary btn-sm">In-Progress</span>
													@elseif($complaint_remark->status == 'Closed')
													<span class="btn btn-success btn-sm">Closed</span>
													@endif
												</td>
												<td>{{ $complaint_remark->updated_at->format('F j, Y') }}</td>
											</tr>
										@endforeach
										<tr>
											<td>
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Take Action</button>
											</td>
										</tr>
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
<!-- Required script -->
@include('admin.include.footer_links')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
	$(document).ready(function() {
		// Add click event to the button with id "submitBtn"
		$('#submitBtn').on('click', function() {
			// Create a JavaScript object to represent form data
			var formData = {
				complain_id: $('[name="complain_id"]').val(),
				complain_cnic: $('[name="complain_cnic"]').val(),
				status: $('#status').val(),
				remark: $('#remark').val(),
				_token: $('meta[name="csrf-token"]').attr('content')
			};

			// Perform AJAX submission
			$.ajax({
				type: 'POST',
				url: '/action-on-complaint',
				contentType: 'application/json',
				data: JSON.stringify(formData),
				success: function(response) {
					// Handle the success response
					var message = response.message;
            
					// Update the HTML content of the element with the ID "lock_message"
					$("#alertmessage").html(message).show();
					// Show the response message in your modal or wherever needed
					// Trigger the success modal after 2 seconds
                    setTimeout(function() {
                        $('#successMessage').html(message);
                        $('#successModal').modal('show');
                    }, 1000);

                    // Refresh the page after 4 seconds
                    setTimeout(function() {
                        location.reload();
                    }, 3000);

					
				},
				error: function(error) {
					// Handle the error response
					console.error(error);
					// Show the error message in your modal or wherever needed
					alert('Error: ' + error.responseJSON.error);
				}
			});
		});
	});

	document.getElementById('generatePdfBtn').addEventListener('click', function () {
		// Get the element to be converted to PDF
		const element = document.getElementById('pdfContent');

		// Options for the pdf generation
		const options = {
			margin: 10,
			filename: 'complaints_details.pdf',
			image: { type: 'jpeg', quality: 0.98 },
			html2canvas: { scale: 2 },
			jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
		};

		// Generate the PDF
		try {
			html2pdf().from(element).set(options).outputPdf();
		} catch (error) {
			console.error('Error generating PDF:', error);
			alert('Error generating PDF. Please check the console for details.');
		}
	});


</script>

</body>

</html>