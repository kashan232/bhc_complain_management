@include('admin.include.main_header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<!--**********************************
        Main wrapper start
    ***********************************-->
    

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
                            <a href="{{ route('Reporting-by-date') }}" class="btn btn-primary">Back</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="exampleexport" class="display" style="width:100%">
                                    <caption style="caption-side:top; text-align:center;">Sindh Water & Agriculture Transformation Project</caption>
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>CNIC</th>
                                            <th>District</th>
                                            <th>Taluka</th>
                                            <th>Contact</th>
                                            <th>Nature of Complaint</th>
                                            <th>Close Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="complaintsTable">
                                        @foreach($complaints as $complaint)
                                        <tr>
                                            <td> {{$loop->iteration}} </td>
                                            <td>{{ $complaint->created_at->format('F j, Y') }}</td>
                                            <td>{{ $complaint->name }}</td>
                                            <td>{{ $complaint->fathername }}</td>
                                            <td>{{ $complaint->cnic }}</td>
                                            <td>{{ $complaint->district }}</td>
                                            <td>{{ $complaint->taluka }}</td>
                                            <td>{{ $complaint->contact }}</td>
                                            <td>{{ $complaint->nature_of_complaint }}</td>
                                            <td>
                                                @if($complaint->status == 'Closed')
                                                <span>{{ $complaint->updated_at->format('F j, Y') }}</span>
                                                @else
                                                <span>Not Closed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($complaint->status == 'Not Process Yet')
                                                <button class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </button>
                                                @elseif($complaint->status == 'In process')
                                                <button class="btn btn-primary btn-sm">In-Progress</button>
                                                @elseif($complaint->status == 'Closed')
                                                <button class="btn btn-success btn-sm">Closed</button>
                                                @elseif($complaint->status == 'Incomplete')
												<button class="btn btn-info btn-sm">Incomplete</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="py-5">
                                    {{ $complaints->appends(request()->input())->links() }}
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
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">XCL Technologeis</a> 2024</p>
        </div>
    </div>
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

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#exampleexport').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
</body>

</html>