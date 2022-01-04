<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allowed');

/*
*
**
***
*/

class Additional {
	public function slugify($text) {
		$text = str_replace('\'', '', $text);
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		// trim
		$text = trim($text, '-');
		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);
		// lowercase
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text;
	}

	public function indonesian_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
		if (trim($timestamp) == '') {
			$timestamp = time();
		} elseif (!ctype_digit($timestamp)) {
			$timestamp = strtotime($timestamp);
		}
		# remove S (st,nd,rd,th) there are no such things in indonesia :p
		$date_format = preg_replace("/S/", "", $date_format);
		$pattern     = array(
			'/Mon[^day]/',
			'/Tue[^sday]/',
			'/Wed[^nesday]/',
			'/Thu[^rsday]/',
			'/Fri[^day]/',
			'/Sat[^urday]/',
			'/Sun[^day]/',
			'/Monday/',
			'/Tuesday/',
			'/Wednesday/',
			'/Thursday/',
			'/Friday/',
			'/Saturday/',
			'/Sunday/',
			'/Jan[^uary]/',
			'/Feb[^ruary]/',
			'/Mar[^ch]/',
			'/Apr[^il]/',
			'/May/',
			'/Jun[^e]/',
			'/Jul[^y]/',
			'/Aug[^ust]/',
			'/Sep[^tember]/',
			'/Oct[^ober]/',
			'/Nov[^ember]/',
			'/Dec[^ember]/',
			'/January/',
			'/February/',
			'/March/',
			'/April/',
			'/June/',
			'/July/',
			'/August/',
			'/September/',
			'/October/',
			'/November/',
			'/December/'
		);
		$replace     = array(
			'Sen',
			'Sel',
			'Rab',
			'Kam',
			'Jum',
			'Sab',
			'Min',
			'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu',
			'Jan',
			'Feb',
			'Mar',
			'Apr',
			'Mei',
			'Jun',
			'Jul',
			'Ags',
			'Sep',
			'Okt',
			'Nov',
			'Des',
			'Januari',
			'Februari',
			'Maret',
			'April',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$date        = date($date_format, $timestamp);
		$date        = preg_replace($pattern, $replace, $date);
		$date        = "{$date} {$suffix}";
		return $date;
	}

	function settImage($data=array()){
		foreach($data as $k=>$v){
			$image = str_split($v['artiArimId']);
			$image_ = implode("/", $image);
			$url_image = PATH_IMG.$image_;
			$data[$k]['images']['img_300x206'] = $url_image."/".$v['artiArimId']."_300x206".".".$v['arimFileType'];
			$data[$k]['images']['img_512x351'] = $url_image."/".$v['artiArimId']."_512x351".".".$v['arimFileType'];
			$data[$k]['images']['img_683x468'] = $url_image."/".$v['artiArimId']."_683x468".".".$v['arimFileType'];
			$data[$k]['images']['img_840x576'] = $url_image."/".$v['artiArimId']."_840x576".".".$v['arimFileType'];
		}

		return $data;
	}

	function settImageGallery($data=array()){
		foreach($data['data'] as $k=>$v){
			$arimId = (int) $v['arimId'];
			if($arimId>9){
				$image = str_split($arimId);
				$image_ = implode("/", $image);
			}else{
				$image_ = $arimId;
			}
			$url_image = PATH_IMG.$image_;
			$data['data'][$k]['images']['img_300x206'] = $url_image."/".$v['arimId']."_300x206".".".$v['arimFileType'];
			$data['data'][$k]['images']['img_512x351'] = $url_image."/".$v['arimId']."_512x351".".".$v['arimFileType'];
			$data['data'][$k]['images']['img_683x468'] = $url_image."/".$v['arimId']."_683x468".".".$v['arimFileType'];
			$data['data'][$k]['images']['img_840x576'] = $url_image."/".$v['arimId']."_840x576".".".$v['arimFileType'];
		}

		return $data;
	}

	function delete_directory($dir) {
		if(is_dir($dir)){
			$dir_handle = opendir($dir);
			if($dir_handle){       
				while($file = readdir($dir_handle)){
					if($file != "." && $file != ".."){
						if(!is_dir($dir."/".$file)){
							unlink( $dir."/".$file );
						} else {
							$this->delete_directory($dir.'/'.$file);
						}		
					}
				}
				closedir( $dir_handle );
			}
			rmdir( $dir );
			return true;
		} else {
			return false;
		}
	}
}
