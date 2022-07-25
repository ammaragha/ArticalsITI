<form class="col-6 m-auto mt-4" action="auth.php?page=doRegister" method="POST">
    <!-- first name input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">First name</label>
        <input type="text" id="form2Example1" name="first_name" class="form-control" />
    </div>

    <!-- last name input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">last name</label>
        <input type="text" id="form2Example1" name="last_name" class="form-control" />
    </div>

    <!-- address input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">address</label>
        <input type="text" id="form2Example1" name="address" class="form-control" />
    </div>

    <!-- date input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">date of birth</label>
        <input type="date" id="form2Example1" name="date" class="form-control" />
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Email address</label>

        <input type="email" id="form2Example1" name="email" class="form-control" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Password</label>

        <input type="password" id="form2Example2" name='password' class="form-control" />
    </div>




    </div>

    <!-- Submit button -->
    <input type="submit" class="btn btn-primary btn-block mb-4" value="Register">

</form>

<?php
if (isset($_SESSION['errs'])) {
    $errs = $_SESSION['errs'];
    foreach ($errs as $err) {
        echo "<div class='alert alert-danger'>$err</div>";
    }
    unset($_SESSION['errs']);
}
