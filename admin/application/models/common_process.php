<?
	Class Common_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> helper('page');
			$this->load->library('email');
		}

		/*
		*	檔案上傳
		*/
		function do_upload($upload_path,$FileName,$WH,$XY,$PreWH)
		{
			if(!file_exists($upload_path))
			{
				mkdir($upload_path, 0700);
			}

		  $config['upload_path']   = $upload_path;
		  $config['allowed_types']  = 'jpeg|jpg|png';
		  $config['max_size']   = 1024*2;
		  $config['max_width']  = 1920;
		  $config['max_height'] = 1000;
			$config['encrypt_name'] = 'true';

		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($FileName))
		  {
		  	return array('Status' => '1718','Error' => $this->upload->display_errors());
		  }
		  else
		  {
		    $data = array('upload_data' => $this->upload->data());

		    $this->load->library('image_lib');
				$x = 0;
				list($width, $height) = getimagesize($data['upload_data']['full_path']);

				foreach ($WH as $row) {

			    $config['image_library'] = 'gd2';
			    $config['source_image'] = $data['upload_data']['full_path'];
			    $config['maintain_ratio'] = TRUE;
			    $config['master_dim'] = 'width';

					if($row['floder'])
						$config['new_image'] = $upload_path.$row['floder'];
					else
						$config['new_image'] = $upload_path;

					if(!is_dir($config['new_image'])){
						mkdir($config['new_image'],0700);
					}
			    $config['width'] = $row['width'];
			    $config['height'] = $row['width']*$height/$width;
			    $this->image_lib->initialize($config);
					//改變影像尺寸
			    $this->image_lib->resize();
					$this->image_lib->clear();
					if($x==0){
						//剪裁影像
						switch ($data['upload_data']['image_type']) {
							case 'png':
								if($row['floder'])
									$img_r = imagecreatefrompng($upload_path.$row['floder'].$data['upload_data']['file_name']);
								else
									$img_r = imagecreatefrompng($upload_path.$data['upload_data']['file_name']);

								$crop = imagecreatetruecolor( $row['width'], $row['height']);
								imagealphablending($crop, false);
            		imagesavealpha($crop,true);
								$transparent = imagecolorallocatealpha($crop, 255, 255, 255, 127);
            		imagefilledrectangle($crop, 0, 0, $row['width'], $row['height'], $transparent);
								imageCopy(
								    $crop,
								    $img_r,
								    0,
								    0,
								    round($row['width']/$PreWH['w']*$XY['x']),
								    round(($row['height']*$XY['y'])/$PreWH['h']),
								    round($row['width']),
								    round($row['width']*$height/$width)
								);

								$jpeg_quality = 9;
								if($row['floder'])
									@imagepng($crop,$upload_path.$row['floder'].$data['upload_data']['file_name'],$jpeg_quality);
								else
									@imagepng($crop,$upload_path.$data['upload_data']['file_name'],$jpeg_quality);
								break;
							case 'jpeg':
							case 'jpg':
								if($row['floder'])
									$img_r = imagecreatefromjpeg($upload_path.$row['floder'].$data['upload_data']['file_name']);
								else
									$img_r = imagecreatefromjpeg($upload_path.$data['upload_data']['file_name']);
								$crop = ImageCreateTrueColor( $row['width'], $row['height'] );
								imageCopy(
								    $crop,
								    $img_r,
								    0,
								    0,
								    round($row['width']/$PreWH['w']*$XY['x']),
								    round(($row['height']*$XY['y'])/$PreWH['h']),
								    round($row['width']),
								    round($row['width']*$height/$width)
								);
								$jpeg_quality = 60;
								if($row['floder'])
									@imagejpeg($crop,$upload_path.$row['floder'].$data['upload_data']['file_name'],$jpeg_quality);
								else
									@imagejpeg($crop,$upload_path.$data['upload_data']['file_name'],$jpeg_quality);
								break;
						}
					}
					$x++;
				}
				return array('Status' => '0000', 'FileName' => $data['upload_data']['file_name']);
		  }
		}
	}
?>
