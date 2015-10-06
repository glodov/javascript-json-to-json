<?php

function fixJSON($str)
{
    $str = preg_replace('/(\w+):/i', '"\1":', $str);
	return $str;
}

$json = null;
$error = false;
$input = isset($_POST['input']) ? $_POST['input'] : null;
if ($input)
{
	$data = json_decode(fixJSON($input), true);
	if (null === $data)
	{
		$error = json_last_error_msg();
	}
	$json = json_encode($data, JSON_PRETTY_PRINT);
}
?>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
    rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css"
    rel="stylesheet" type="text/css">
	<style>
	.code {
		font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
	}
	</style>
  </head>

  <body>
  <form action="" method="post">
    <div class="section">
      <div class="container">
        <h1 class="lead text-center">Convert javascript JSON into JSON RFC 4627</h1>
        <div class="row">
          <div class="col-md-12">
            <textarea class="form-control" rows="10" cols="" name="input" placeholder="JSON data"><?= htmlspecialchars($input) ?></textarea>
            <br>
            <div class="text-center">
              <button type="submit" class="btn btn-large btn-primary">Convert into valid and pretty JSON</button>
            </div>
          </div>
        </div>
        <br>
        <br>
        <p class="lead text-center">JSON RFC 4627</p>
        <br>
		<?php if ($error) : ?>
		<div class="alert alert-danger">
			Wrong JSON input data
			<br>
			<?= htmlspecialchars($error) ?>
		</div>
		<?php elseif ($json) : ?>
		<textarea class="form-control code" rows="20" cols="" name="output"><?= htmlspecialchars($json) ?></textarea>
        <!-- <pre><?= htmlspecialchars($json) ?></pre> -->
		<?php else : ?>
		<div class="alert alert-default">
			Provide some input data and click convert button
		</div>
		<?php endif; ?>
      </div>
    </div>
  </form>
  </body>

</html>
