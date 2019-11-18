<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-5" style="width: 400px">
		<form action="{{route('user.login')}}" method="post">
			 @csrf
		 <div class="form-group">
		    <label for="exampleInputEmail1">username</label>
		    <input type="text" class="form-control" name="user" placeholder="Enter email">
		   
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control" name="password" placeholder="Password">
		 </div>

		  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
	</div>
</body>
</html>