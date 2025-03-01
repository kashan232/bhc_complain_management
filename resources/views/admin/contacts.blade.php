	@include('admin.include.main_header')
	
	<div id="main-wrapper">
        @include('admin.include.header')
		@include('admin.include.navbar')
		@include('admin.include.sidebar')
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">All District </h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example3" class="display">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Name</th>
												<th>Email</th>
												<th>Subject</th>
												<th>Message</th>
												<th>Created At</th>
											</tr>
										</thead>
										<tbody>
											@foreach($Contacts as $Contact)
												<tr>
													<td> {{$loop->iteration}} </td>
													<td>{{ $Contact->name }}</td>
													<td>{{ $Contact->email }}</td>
													<td>{{ $Contact->subject }}</td>
													<td>{{ $Contact->message }}</td>
													<td>{{ $Contact->created_at->diffForHumans() }}</td>
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
		@include('admin.include.powerd_by')
	</div>
	@include('admin.include.footer_links')
</body>
</html>