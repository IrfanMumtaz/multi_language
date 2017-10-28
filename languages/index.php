<?php

    $success = false;

	if (isset($_POST['submit'])) {
		$var_index = $_POST['var_index'];
		$language = $_POST['language'];

		
        $path = 'view.php';
		$fname = 'english/'.$path;
		$fhandle = fopen($fname,"r");
		$content = fread($fhandle,filesize($fname));

		$content = str_replace("?>", generate_array($var_index, $language), $content);

		$fhandle = fopen($fname,"w");
		fwrite($fhandle,$content);
		fclose($fhandle);

		$fname = "../".$path;
		$fhandle = fopen($fname,"r");
		$content = fread($fhandle,filesize($fname));

		$content = str_replace($var_index, generate_func($var_index), $content);

		$fhandle = fopen($fname,"w");
		fwrite($fhandle,$content);
		fclose($fhandle);
        $success = true;
	}

	function generate_key($key){
		$key = preg_replace('/[^A-Za-z0-9 ]/', '', $key);
		$key = strtolower($key);
		$key = str_replace(" ", "_", $key);
		return $key;
	}

	function generate_array($var_index, $language){
		$key = generate_key($var_index);
		$result = "\n\$lang[\"{$key}\"][\"{$language}\"] = \"{$var_index}\";\n?>";
		return $result;
	}

	function generate_func($var_index){
		$result = "<?php echo translate('".generate_key($var_index)."'); ?>";
		return $result;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Language</title>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Language Translation Dashboard</h1>
			</div>
		</div>
	</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<form method="POST" accept="<?php $_SERVER['PHP_SELF']?>">
                    <h2>Add Variable</h2>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <input type="text" name="var_index" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <select class="form-control" name="language">
                                <option value="en">English</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="submit" name="submit" value="Save" class="btn">
                        </div>
                    </div>
				</form>
                <?php
                 if($success):
                ?>
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Variable successfully created.
                </div>
                <?php
                endif;
                ?>
			</div>
		</div>
	</div>

	

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>