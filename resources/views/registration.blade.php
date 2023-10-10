<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Online Pharmacy for you</title>
  </head>
  <body>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <img src="img2.jpeg"
                class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <form action="{{ route('register-user') }}" method="post">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1">Name</label>
                    <input type="text" id="form3Example1" class="form-control" name="name" value="{{ old('name') }}" />
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Email address</label>
                    <input type="email" id="form3Example3" class="form-control" name="email" value="{{ old('email') }}"/>
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>

                <!-- Address input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1">Address</label>
                    <input type="text" id="form3Example1" class="form-control" name="address" value="{{ old('address') }}"/>
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>

                <!-- Contact Number input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1">Contact Number</label>
                    <input type="number" id="form3Example1" class="form-control" name="contact_no" value="{{ old('contact_no') }}"/>
                    <span class="text-danger">@error('contact_no'){{ $message }}@enderror</span>
                </div>

                <!-- DOB input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1">Date of birth</label>
                    <input type="date" id="form3Example1" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}"/>
                    <span class="text-danger">@error('date_of_birth'){{ $message }}@enderror</span>
                </div>


                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4">Password</label>
                    <input type="password" id="form3Example4" class="form-control" name="password" value="{{ old('password') }}"/>
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>

                <!--Confirm Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4">Confirm Password</label>
                    <input type="password" id="form3Example4" class="form-control" name="confirm_password" value="{{ old('confirm_password') }}"/>
                    <span class="text-danger">@error('confirm_password'){{ $message }}@enderror</span>
                </div>

                <div class="d-flex justify-content-around align-items-center mb-4">
                    <!-- Registration -->
                    <p>Already Registered?<a href="/">Login here</a></p>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign up</button>

              </form>
            </div>
          </div>
        </div>
      </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
    </style>
  </body>
</html>
