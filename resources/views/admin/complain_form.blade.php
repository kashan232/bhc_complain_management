<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>complaint Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .container {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }
    </style>
</head>

<body>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="complaintModal" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="complaintModalLabel">Complaint Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content will be dynamically inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class=" text-center">
            <img src="/swat.jpeg" style="width: 90px;height: 90px;" />
        </div>

        <div class="title mt-3 mb-5 text-center">
            <h5>Sindh Water & Agriculture Transformation Project</h5>
            <h6>Online complaint Form</h6>
        </div>
        <div class="content">
            <form id="complaintForm" action="{{ route('store-complain') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 mt-2">
                        <label for="name">Name of Complainant</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                        <label for="name">Father/Husband of Complainant </label>
                        <input type="text" class="form-control" id="fathername" name="fathername" placeholder="Enter your Father Name" required>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                        <label for="cnic">CNIC No</label>
                        <input type="text" class="form-control" name="cnic" id="cnic" placeholder="Enter your CNIC" required>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                        <label for="district">District</label>
                        <select id="district" class="form-control" name="district" required>
                            <option>Select District</option>
                            <option value="Badin">Badin</option>
                            <option value="Dadu">Dadu</option>
                            <option value="Ghotki">Ghotki</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Jacobabad">Jacobabad</option>
                            <option value="Jamshoro">Jamshoro</option>
                            <option value="Kashmore">Kashmore</option>
                            <option value="Khairpur">Khairpur</option>
                            <option value="Larkana">Larkana</option>
                            <option value="Matiari">Matiari</option>
                            <option value="Mirpur Khas">Mirpur Khas</option>
                            <option value="Naushahro Feroze">Naushahro Feroze</option>
                            <option value="Shaheed Benazirabad">Shaheed Benazirabad</option>
                            <option value="Qambar Shahdadkot">Qambar Shahdadkot</option>
                            <option value="Sanghar">Sanghar</option>
                            <option value="Shikarpur">Shikarpur</option>
                            <option value="Sukkur">Sukkur</option>
                            <option value="Tando Allahyar">Tando Allahyar</option>
                            <option value="Tando Muhammad Khan">Tando Muhammad Khan</option>
                            <option value="Tharparkar">Tharparkar</option>
                            <option value="Thatta">Thatta</option>
                            <option value="Umerkot">Umerkot</option>
                            <option value="Sujawal">Sujawal</option>
                            <option value="Malir">Malir</option>
                            <option value="8 num">8 num</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                        <label for="taluka">Taluka</label>
                        <select id="taluka" class="form-control" name="taluka" required></select>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                        <label for="contact">Contact No</label>
                        <input type="text" class="form-control" name="contact" id="contact" placeholder="Enter your contact number" required>
                    </div>
                    <div class="form-group col-md-12 mt-2">
                        <label for="complaint">Nature of Complaint</label>
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
                            <option value="Total">Total</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 mt-2">
                        <label for="complaint">Other Descrpition</label>
                        <textarea name="other_descrpition" id="other_descrpition" class="form-control"  rows="5" placeholder="Descrpition here"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the select elements
            const districtSelect = document.getElementById('district');
            const talukaSelect = document.getElementById('taluka');

            // Event listener for district dropdown change
            districtSelect.addEventListener('change', function() {
                const selectedDistrict = districtSelect.value;

                // Make an Ajax request to fetch talukas based on the selected district
                fetch(`/api/get-talukas?district=${selectedDistrict}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing taluka options
                        talukaSelect.innerHTML = '';

                        // Populate taluka options
                        data.data.forEach(taluka => {
                            const option = document.createElement('option');
                            option.value = taluka;
                            option.text = taluka;
                            talukaSelect.add(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching talukas:', error);
                    });
            });
        });
    </script>



    <script>
        document.getElementById('complaintForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            fetch(this.action, {
                    method: this.method,
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'Success') {
                        // Populate the modal with success message
                        showComplaintModal('Success', data.message);
                    } else {
                        // Populate the modal with error message
                        showComplaintModal('Error', 'Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Populate the modal with unexpected error message
                    showComplaintModal('Error', 'An unexpected error occurred.');
                });
        });

        function showComplaintModal(title, message) {
            // Set the modal title and message
            document.getElementById('complaintModalLabel').textContent = title;
            document.querySelector('#complaintModal .modal-body').innerHTML = message;

            // Show the modal
            $('#complaintModal').modal('show');

            // Add event listener for modal close event
            $('#complaintModal').on('hidden.bs.modal', function() {
                // Reload the page when the modal is closed
                location.reload();
            });
        }
    </script>

</body>

</html>