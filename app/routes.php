<?php
/**
 * ====================================================
 * Routes and application logic is defined nicely here
 * ====================================================
 */


$klein->respond('GET', '/register', function() use($blade) {
    return $blade->view()->make('index/register')->render();
});

$klein->respond('POST', '/register', function($request, $response) use($blade, $db) {
	$postParams = $request->paramsPost(); 

	// Prepare parameters
	$email = $postParams->email; 
	$password = crypt($postParams->password);
	$first_name = $_POST['first_name']; 
	$last_name = $postParams->last_name;  
	$country = $postParams->country; 
	$address = $postParams->address; 
	$city = $postParams->city; 
	$zip = $postParams->zip; 

   	$sql = "INSERT INTO users SET
            email = '$email',
            password = '$password',
            first_name = '$first_name',
            last_name = '$last_name',
            country = '$country',
            address = '$address',
            city = '$city',
            zip = '$zip',
            created_at = NOW()";
	                                    
    $result = $db->query($sql); 

    if($result && $result['result']) {
    	header('Location: ' . APP_URL . "/login");
    	die(); 
    }   

    header('Location: ' . APP_URL . "/register");
	die();  
}); 

$klein->respond('GET', '/login', function() use($blade) {
    return $blade->view()->make('index/login')->render();
});

$klein->respond('POST', '/login', function($request, $response, $service) use($blade, $db) {
	$postParams = $request->paramsPost(); 

	$email = $postParams->email;
	$password = $postParams->password;

    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

   	$result = $db->query($sql); 

    if($result && $result['status']) {
		$user = $result['result'][0];  

		if($user['password'] == crypt($password, "a!4n39)u+ZfnS*Sm")) {
			// Set session as logged in
			$_SESSION['first_name'] = $user['first_name']; 
			$_SESSION['logged_in'] = true; 

			header('Location: ' . APP_URL);
			die();  
		}
    }      	

  	$flash_error = "User not found or email/password-combination is incorrect."; 
    return $blade->view()->make('index/login', compact('flash_error'))->render();
});

$klein->respond('POST', '/login/checkout', function($request, $response, $service) use($blade, $db) {
	$postParams = $request->paramsPost(); 

	$email = $postParams->email; 
	$password = $postParams->password; 

   	$sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";	


   	$result = $db->query($sql); 

    if($result && $result['status']) {
		$user = $result['result'][0];  

		if($user['password'] && crypt($password, "a!4n39)u+ZfnS*Sm")) {
			// Set session as logged in
			$_SESSION['first_name'] = $user['first_name']; 
			$_SESSION['logged_in'] = true; 

			header('Location: ' . APP_URL . "/checkout");
			die(); 
		}
    }      	

  	$flash_error = "User not found or email/password-combination is incorrect."; 
    return $blade->view()->make('index/login', compact('flash_error'))->render();
});

$klein->respond('GET', '/logout', function($request, $response, $service) {
	session_destroy();

	$service->flash("Successfully logged out", "success"); 
	header('Location: ' . APP_URL);
	die(); 
}); 

$klein->respond('/cart/add/[:id]', function ($request, $response) use($db, $blade) {
	$id = $request->id; 
	$sql = "SELECT * FROM products WHERE id = $id LIMIT 1"; 

   	$result = $db->query($sql); 
    if($result && $result['status']) {
		$product = $result['result'][0]; 

		if(!isset($_SESSION['cart'])) {
			$cart = array($request->id); 
			$_SESSION['cart'] = $cart; 
			$_SESSION['price'] = $product['price']; 

		} else {
			$cart = $_SESSION['cart']; 
			array_push($cart, $request->id); 
			$_SESSION['cart'] = $cart; 
			$_SESSION['price'] += $product['price']; 
		}		
	}

    header('Location: ' . APP_URL);
    die(); 
});

$klein->respond('POST', '/checkout', function($request, $response, $service) use($blade, $db) {
	$postParams = $request->paramsPost(); 
	
	unset($_SESSION['price']); 
	unset($_SESSION['cart']); 

    return $blade->view()->make('index/confirmation', compact('postParams'))->render();
});

$klein->respond('GET', '/checkout', function($request, $response, $service) use($blade, $db) {
    return $blade->view()->make('index/checkout')->render();
});

$klein->respond('GET', '/', function($request, $response, $service) use($blade, $db) {
	$sql = "SELECT * FROM products";

   	$result = $db->query($sql); 

    if($result && $result['status']) {
		$products = $result['result'];  	

    	return $blade->view()->make('index/index', compact('products'))->render();
    }
});

