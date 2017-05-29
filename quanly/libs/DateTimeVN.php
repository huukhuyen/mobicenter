<?php
	date_default_timezone_set('Asia/Vietnam');
	$thoigian_hientai = time();
	Class DateTimeVN
	{
		public $thoigian_hientai1;
		public $gio;
		public $tuan;
		public $ngay;
		public $thang_so;
		public $thang;
		public $thang_chu = array();
		public $nam;

		public function thoi_gian($time)
		{
			$this->thoigian_hientai1 = $time;
			$this->gio = date("H:i", $this->thoigian_hientai1);
			$this->tuan = date("l", $this->thoigian_hientai1);
			if($this->tuan == 'Monday')
			{
				 $this->tuan = str_replace("Monday", "Thứ Hai", $this->tuan);
			}

			elseif($this->tuan == 'Tuesday')
			{
				$this->tuan = str_replace("Tuesday", "Thứ Ba", $this->tuan);
			}

			elseif($this->tuan == 'Wednesday')
			{
				$this->tuan = str_replace("Wednesday", "Thứ Tư", $this->tuan);
			}

			elseif($this->tuan == 'Thursday')
			{
				$this->tuan = str_replace("Thursday", "Thứ Năm", $this->tuan);
			}

			elseif($this->tuan == 'Friday')
			{
				$this->tuan = str_replace("Friday", "Thứ Sáu", $this->tuan);
			}

			elseif($this->tuan == 'Saturday')
			{
				$this->tuan = str_replace("Saturday", "Thứ Bảy", $this->tuan);
			}

			elseif($this->tuan == 'Sunday')
			{
				$this->tuan = str_replace("Sunday", "Chur Nhật", $this->tuan);
			}
			$this->ngay = date("d", $this->thoigian_hientai1);
			if (substr($this->ngay, 0, 1) == 0)
			{
				$this->ngay = str_replace("0", "", $this->ngay);
			}
			$this->thang_so= date("m", $this->thoigian_hientai1);
			if (substr($this->thang_so, 0, 1) == 0)
			{
				 $this->thang_so = str_replace("0", "", $this->thang_so);
			}

			$this->thang_chu = array (
                        1 => 'Tháng một',
                        2 => 'Tháng hai',
                        3 => 'Tháng ba',
                        4 => 'Tháng tư',
						5 => 'Tháng Năm',
						6 => 'Tháng Sáu',
						7 => 'Tháng Bảy',
						8 => 'Tháng Tám',
						9 => 'Tháng Chín',
						10 => 'Tháng Mười',
						11 => 'Thánh Mười Một',
						12 => 'Tháng Mười Hai'
                    );
			$this->thang = $this->thang_chu[$this->thang_so];

		$this->nam = date("y", $this->thoigian_hientai1);
		$this->nam = '20' . $this->nam;
		//echo date('l, F j, Y', $this->thoigian_hientai);
		return sprintf('%d-%d-%d', $this->ngay, $this->thang_so, $this->nam);
		}
	}
?>