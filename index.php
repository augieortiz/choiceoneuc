<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$from = 'info@choiceone.com'; 
		$to = 'compliance@choiceoneuc.com'; 
		$emailSubject = 'Compliance Report New Submission';

		$headers = "From: Compliance Report <compliance@choiceoneuc.com>" . "\r\n" .
           "Reply-To: compliance@choiceoneuc.com" . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

		$result = "";
		$errMessage = "";
		$errSubject = "";
		
		$body ="From: $name\n Subject: $subject\n Message:\n $message";
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}

		//Check if message has been entered
		if (!$_POST['subject']) {
			$errSubject = 'Please enter your subject';
		}

// If there are no errors, send the subject
if (!$errSubject && !$errMessage) {
	if (mail ($to, $emailSubject, $body, $headers)) {
		$result='<div class="alert alert-success">Thank you for sharing your concern.  We will look into the matter promptly.</div>';
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	}
}
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Choice One Compliance Report</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-custom">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">ChoiceOneUC - Compliance</a>
                </div>
                <ul class="nav navbar-nav navbar-collapse">
                </ul>
            </div>
        </nav>
        <div class="container">
        	<div class="page-header">
  				<h1>Compliance Reports</h1>
  				<h3>Use this form to submit any reports anonymously.  The Compliance team will review your report & respond in the best way possible.</h3>
			</div>
			<form class="form-horizontal" role="form" method="post" action="index.php">
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" placeholder="Not required if you want to stay anonymous" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="subject" class="col-sm-2 control-label">Subject</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="">
						<?php echo "<p class='text-danger'>" . (!empty($errSubject) ? $errSubject : "") . "</p>";?>
					</div>
				</div>
				<div class="form-group">
					<label for="message" class="col-sm-2 control-label">Report Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="4" name="message"></textarea>
						<?php echo "<p class='text-danger'>" . (!empty($errMessage) ? $errMessage : "") . "</p>";?>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
					<?php if (empty($result)) { ?>
					    <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
					<?php } else { ?>
					    <a href="/" class="btn btn-default" role="button">New Report</a>
					<?php } ?>
						
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<?php echo !empty($result) ? $result : ""; ?>	
					</div>
				</div>
			</form>
		</div>
</body>