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
                        <form action="{{ route('search-complaints-by-filters') }}" method="get">
                            @csrf
                            <h2 class="mb-4 pt-2 pb-2 mt-2 mb-2 text-center font-weight-bold ">Choose Detail</h2>
                            <div class="row pl-4 pr-4">
                                <div class="col-12 mt-2 mb-2">
                                    <div class="form-group">
                                        <label for="district">District:</label>
                                        <select class="form-control" id="district" name="district" required>
                                            <option disabled selected>Select District</option>
                                            @foreach($Districts as $District)
                                            <option value="{{ $District->district_name }}">{{ $District->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mt-2 mb-2">
                                    <div class="form-group">
                                        <label for="Taluka" class="mt-2 mb-2 font-weight-bold">Taluka:</label>
                                        <br>
                                        <div id="talukaRadios">
                                            <!-- Radio buttons will be dynamically added here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-2 mb-2 w-100">
                                    <button type="submit" class="btn btn-success">Search</button>
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

<script>
    $(document).ready(function() {
        $('#district').on('change', function() {
            var selectedDistrict = $(this).val();

            $.ajax({
                type: 'GET',
                url: '{{ route("get-talukas-report") }}',
                data: {
                    district: selectedDistrict
                },
                dataType: 'json',
                success: function(response) {
                    appendTalukas(response.talukas);
                },
                error: function(error) {
                    console.error('Error in AJAX request:', error);
                }
            });
        });
    });

    function appendTalukas(talukas) {
        var talukaRadios = $('#talukaRadios');
        talukaRadios.empty(); // Clear existing radios

        if (talukas.length > 0) {
            $.each(talukas, function(index, taluka) {
                // Append radio buttons for each taluka
                var radioHtml = '<input type="radio" id="' + taluka + '" name="taluka" value="' + taluka + '">';
                radioHtml += '<label for="' + taluka + '"> ' + taluka + '</label><br>'; // Add space before the label text and <br> for spacing
                talukaRadios.append(radioHtml);
            });
        } else {
            // If no talukas found, display a message
            talukaRadios.append('<p>No Talukas found</p>');
        }
    }
</script>


</body>

</html>