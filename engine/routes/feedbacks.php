<?php 

	if (!empty($_POST['g-recaptcha-response']) && !empty($_POST['name']) && !empty($_POST['feedback'])) {
		
		$recaptchaData = array(
			'secret' => '6Lef2Q8UAAAAAOl3nKbAO6xIa2e-Z26t-HlHZhZD',
			'response' => $_POST['g-recaptcha-response']
		);

		$verify = curl_init();
		curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($verify, CURLOPT_POST, true);
		curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($recaptchaData));
		curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($verify);
		curl_close ($verify);

		$response = json_decode($response, true);

		if ($response['success'] === true) {

			$purifier = new HTMLPurifier();

			$data = array(
				'name'     => $purifier->purify($_POST['name']),
				'email'    => !empty($_POST['email']) ? $purifier->purify($_POST['email']) : '',
				'feedback' => !empty($_POST['feedback']) ? $purifier->purify($_POST['feedback']) : '',
				'img'      => '',
				'state'    => 0
			);


			if (!empty($_FILES['guest_img']['tmp_name'])) {

				$check = getimagesize($_FILES['guest_img']['tmp_name']);

				if ($check !== false && $_FILES['guest_img']['size'] < 5000000 && in_array($_FILES['guest_img']['type'], array('image/jpg', 'image/png', 'image/jpeg'))) {
					
					if (!file_exists(bDIR . '/disk/feedbacks')){
						mkdir(bDIR.'/disk/feedbacks', 0777);
					}	
					
					$new_name = md5(microtime()*rand(1,1000));
					$uploaded_img = bDIR . '/disk/feedbacks/' . $new_name.'.jpg';
					move_uploaded_file($_FILES['guest_img']['tmp_name'], $uploaded_img);
					// rewriwte data img	
					$data['img'] = $new_name;
				}
			}			

			$insert = $db->insert("INSERT INTO `feedbacks` (`name`, `email`, `feedback`, `img`, `state`) VALUES(%s)", $data);

			if ($insert) {
				// send via email to Igor
				// ........
				redirect(createURL('notification&action=feedback_complete'));
			}
			else {
				redirect(createURL());
			}

		}
		else {
			redirect(createURL());	
		}

		
	}	

	
	// require(bDIR.'/engine/model/model_header.php');
	// require(bDIR.'/engine/model/model_main.php');

		
	// require(bDIR.'/engine/templates/header.php');
	// require(bDIR.'/engine/templates/index.php');
	// require(bDIR.'/engine/templates/footer.php');

?>