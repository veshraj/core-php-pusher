<?php
require_once './vendor/autoload.php';

use Classes\DB;
use Classes\Push;


if (!empty($_POST['name']) && !empty($_POST['email'])) {
	if (DB::insert('users', $_POST)) {
		Push::trigger('users', 'created', 'A new user which name -' . $_POST['name'] . 'has been created');
		$success = true;
	}
	else {
		$error = 'There is an unknown error. Please try again later';
	}
}
else if (($_POST)) {
	$error = 'Please fill all required fields';
}

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link
            href="https://getbootstrap.com/docs/4.5/examples/offcanvas/offcanvas.css"
            rel="stylesheet"
    />
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
            crossorigin="anonymous"
    />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
            integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
            crossorigin="anonymous"
    />
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('dc475aee7dec4cb4d5f5', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            alert(JSON.stringify(data));
        });
    </script>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="/">Pusher</a>
    <button
            class="navbar-toggler p-0 border-0"
            type="button"
            data-toggle="offcanvas"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline"></nav>
</div>

<main role="main" class="container">
    <div
            class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm"
    >
        <img
                class="mr-3"
                src="https://symbols-electrical.getvecta.com/stencil_261/37_pusher.466585046b.svg"
                alt=""
                width="48"
                height="48"
                style="background:#fff; padding: 5px;"
        />
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Pusher Realtime communication</h6>
            <small>Pusher Realtime communication using Core PHP and Pusher Js</small>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
		<?php
		if (isset($success)) {
			?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done! User created</h4>
                <p>User Create successfully you need to check pusher worked in real time or not.</p>
                <hr>
                <p class="mb-0"> To do so you should open this page separately and list page separately.</p>
            </div>
			<?php
		}
		else if (isset($error)) {
			?>
            <div class="alert alert-danger" role="alert">
				<?php
				echo $error;
				?>
            </div>
			<?php
		}
		?>
        <h6 class="border-bottom border-gray pb-2 mb-0">Create User</h6>
        <form class="form-horizontal mt-3" method="post">
            <div class="form-group form-row row">
                <div class="col-4">
                    <label class="control-label">Name*</label>
                    <input class="form-control" type="text" name="name"/>
                </div>
                <div class="col-4">
                    <label class="control-label">Email*</label>
                    <input class="form-control" name="email" type="email">
                </div>
                <div class="col-4">
                    <label class="control-label">Phone</label>
                    <input class="form-control" type="text" name="phone">
                </div>
                <div class="col-4 mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>

    </div>
</main>

<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"
></script>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"
></script>
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"
></script>
<script></script>
</body>
</html>
