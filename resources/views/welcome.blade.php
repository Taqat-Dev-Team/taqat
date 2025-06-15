<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />


    </head>
    <body class="antialiased">

        <form id="userForm">
            <div class="card">
                <div class="card-body">
                    <!-- Name in Arabic and English -->
                    <div class="form-group">
                        <label for="name_arabic">Name in Arabic:</label>
                        <input type="text" class="form-control" name="name_arabic" required>
                  </div>

                    <div class="form-group">
                        <label for="name_english">Name in English:</label>
                        <input type="text" class="form-control" name="name_english" required>
                    </div>


                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <!-- Mobile -->
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="tel" class="form-control" name="mobile" id="mobile" required>
                    </div>

                    <!-- Landline -->
                    <div class="form-group">
                        <label for="landline">Landline:</label>
                        <input type="tel" class="form-control" name="landline">
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" name="address" rows="4"></textarea>
                    </div>

                    <!-- Fax -->
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="tel" class="form-control" name="fax">
                    </div>

                    <!-- Country and City (Select Inputs) -->
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <select class="form-control" name="country" id="country">
                            <option value="usa">USA</option>
                            <!-- Add more countries as needed -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <select class="form-control" name="city" id="city">
                            <option value="new_york">New York</option>
                            <!-- Add more cities as needed -->
                        </select>
                    </div>

                    <!-- Profession and Institution (Select Inputs) -->
                    <div class="form-group">
                        <label for="profession">Profession:</label>
                        <select class="form-control" name="profession" id="profession">
                            <option value="doctor">Doctor</option>
                            <!-- Add more professions as needed -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="institution">Institution:</label>
                        <select class="form-control" name="institution" id="institution">
                            <option value="hospital">Hospital</option>
                            <!-- Add more institutions as needed -->
                        </select>
                    </div>

                    <!-- Job Category (Select Input) -->
                    <div class="form-group">
                        <label for="job_category">Job Category:</label>
                        <select class="form-control" name="job_category" id="job_category">
                            <option value="medicine">Medicine</option>
                            <!-- Add more job categories as needed -->
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/additional-methods.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>

<script>
        $('select').select2();

    </script>
    </body>
</html>
