<?php


class Counter
{
	function auto_run()
	{
		global $CMS, $DB, $func;
		
		$this->ip_address = $CMS->class->filter->ip_cleaner( $_SERVER['REMOTE_ADDR'] );
		$this->user_agent = substr( $CMS->class->filter->clean_value( $_SERVER['HTTP_USER_AGENT']), 0, 50 );
		$this->time_now = time();
		$this->time_out = $this->time_now - $CMS->vars['visitor_session'];
		$this->today = getdate();
		$this->update_time = intval( $CMS->class->cookie->get_cookie('update_time') );
		
		$this->counter();
	
		if ( isset($this->update_time) && ($this->update_time < $this->time_out ) )
		{
			$this->update_users_info();

			$CMS->class->cookie->set_cookie("update_time", $this->time_now, -1);
		}
		
		$this->counter_referer();
	}

	function counter_referer()
	{
		global $CMS, $DB, $func;
		
		$root = str_replace( "http://", "", $CMS->vars['root_domain'] );
		$target = str_replace( array("http://", "www."), array("", ""), strtolower($_SERVER["HTTP_REFERER"]) );
		
		if ( $_SERVER["HTTP_REFERER"] AND substr($target, 0, strlen($root)) != $root )
		{
			$referer = $_SERVER["HTTP_REFERER"];
			$referer = str_replace(array("http://", "www."), array("", ""), $referer);
			$referer = explode( "/", $referer );
			$referer = $referer[0];
			
			$DB->query("SELECT * FROM ".root_table."counter_referer WHERE url='{$referer}'");
			
			if ( $DB->num_rows() == 0 )
			{
				$DB->query("INSERT INTO ".root_table."counter_referer (url, hit) VALUES ('{$referer}', 1);");	
			}
			else
			{
				$DB->query("UPDATE ".root_table."counter_referer SET hit=hit+1 WHERE url='{$referer}'");	
			}
			
			$referer2 = $_SERVER["HTTP_REFERER"];
			$referer2 = str_replace(array("http://", "www."), array("", ""), $referer2);
			
			$DB->query("SELECT * FROM ".root_table."counter_referer_details WHERE url='{$referer2}'");
			
			if ( $DB->num_rows() == 0 )
			{
				$DB->query("INSERT INTO ".root_table."counter_referer_details (url, hit) VALUES ('{$referer2}', 1);");	
			}
			else
			{
				$DB->query("UPDATE ".root_table."counter_referer_details SET hit=hit+1 WHERE url='{$referer2}'");	
			}
		}	
	}
	
	function update_users_info()
	{
		global $CMS, $DB, $func;

		//----------------------------------------
		// User Browser
		//----------------------------------------
		
		if ((ereg("Nav", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Gold", $_SERVER["HTTP_USER_AGENT"])) || (ereg("X11", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Mozilla", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Netscape", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("Firefox", $_SERVER["HTTP_USER_AGENT"]))) $user_browser = "Netscape";
		elseif(ereg("Firefox", $_SERVER["HTTP_USER_AGENT"])) $user_browser = "Firefox";
		elseif(ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) $user_browser = "MSIE";
		elseif(ereg("Lynx", $_SERVER["HTTP_USER_AGENT"])) $user_browser = "Lynx";
		elseif(ereg("Opera", $_SERVER["HTTP_USER_AGENT"])) $user_browser = "Opera";
		elseif(ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) $user_browser = "Konqueror";
		elseif((eregi("bot", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Google", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Slurp", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Scooter", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Spider", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Infoseek", $_SERVER["HTTP_USER_AGENT"]))) $user_browser = "Bot";
		else $user_browser = "Other";
					
		$DB->query("SELECT * FROM ".root_table."cache WHERE name='browser'");
		$cache_browser = $DB->fetch_array();
		
		if ( !$cache_browser )
		{
			$browser = array();
			$browser['MSIE'] = 0;
			$browser['Firefox'] = 0;
			$browser['Netscape'] = 0;
			$browser['Opera'] = 0;
			$browser['Konqueror'] = 0;
			$browser['Lynx'] = 0;
			$browser['Bot'] = 0;
			$browser['Other'] = 0;
			
			$DB->query("INSERT INTO ".root_table."cache (name, value) VALUES ('browser', '". serialize($browser) ."')");
		}
		else
		{
			$browser = unserialize($cache_browser[1]);
			
			if ( !is_array($browser) ) 
			{
				$browser = array();
			}

			$browser[$user_browser] = $browser[$user_browser] + 1;
			
			$DB->query("UPDATE ".root_table."cache SET value='". serialize($browser) ."' WHERE name='browser'");

		}

		//----------------------------------------
		// User Operating System
		//----------------------------------------
		
		if(ereg("Win", $_SERVER["HTTP_USER_AGENT"])) $user_os = "Windows";
		elseif((ereg("Mac", $_SERVER["HTTP_USER_AGENT"])) || (ereg("PPC", $_SERVER["HTTP_USER_AGENT"]))) $user_os = "Mac";
		elseif(ereg("Linux", $_SERVER["HTTP_USER_AGENT"])) $user_os = "Linux";
		elseif(ereg("FreeBSD", $_SERVER["HTTP_USER_AGENT"])) $user_os = "FreeBSD";
		elseif(ereg("SunOS", $_SERVER["HTTP_USER_AGENT"])) $user_os = "SunOS";
		elseif(ereg("IRIX", $_SERVER["HTTP_USER_AGENT"])) $user_os = "IRIX";
		elseif(ereg("BeOS", $_SERVER["HTTP_USER_AGENT"])) $user_os = "BeOS";
		elseif(ereg("OS/2", $_SERVER["HTTP_USER_AGENT"])) $user_os = "OS/2";
		elseif(ereg("AIX", $_SERVER["HTTP_USER_AGENT"])) $user_os = "AIX";
		else $user_os = "Other";
		
		$DB->query("SELECT * FROM ".root_table."cache WHERE name='os'");
		$cache_os = $DB->fetch_array();
		
		if ( !$cache_os )
		{
			$os = array();
			$os['Windows'] = 0;
			$os['Linux'] = 0;
			$os['Mac'] = 0;
			$os['FreeBSD'] = 0;
			$os['SunOS'] = 0;
			$os['IRIX'] = 0;
			$os['BeOS'] = 0;
			$os['OS/2'] = 0;
			$os['AIX'] = 0;
			$os['Other'] = 0;
			
			$DB->query("INSERT INTO ".root_table."cache (name, value) VALUES ('os', '". serialize($os) ."')");
		}
		else
		{
			$os = unserialize($cache_os[1]);
			
			if ( !is_array($os) ) 
			{
				$os = array();
			}

			$os[$user_os] = $os[$user_os] + 1;
			
			$DB->query("UPDATE ".root_table."cache SET value='". serialize($os) ."' WHERE name='os'");

		}
				
		//----------------------------------------
		// User Hour
		//----------------------------------------
				
		$DB->query("SELECT * FROM ".root_table."cache WHERE name='hour'");
		$cache_hour = $DB->fetch_array();
		
		if ( !$cache_hour )
		{
			$hour = array();
			for ( $i = 0; $i < 24; $i++ )
			{
				$hour[$i] = 0;
			}
		
			$DB->query("INSERT INTO ".root_table."cache (name, value) VALUES ('hour', '". serialize($hour) ."')");
		}
		else
		{
			$hour = unserialize($cache_hour[1]);
			
			if ( !is_array($hour) ) 
			{
				$hour = array();
			}

			$hour[$this->today['hours']] = $hour[$this->today['hours']] + 1;
			
			$DB->query("UPDATE ".root_table."cache SET value='". serialize($hour) ."' WHERE name='hour'");
		
		}
		
		//----------------------------------------
		// User Day
		//----------------------------------------
		
		$DB->query("SELECT * FROM ".root_table."cache WHERE name='mday'");
		$cache_day = $DB->fetch_array();
		
		if ( !$cache_day )
		{
			$day = array();
			for ( $i = 1; $i < 32; $i++ )
			{
				$day[$i] = 0;
			}
		
			$DB->query("INSERT INTO ".root_table."cache (name, value) VALUES ('mday', '". serialize($day) ."')");
		}
		else
		{
			$day = unserialize($cache_day[1]);
			
			if ( !is_array($day) ) 
			{
				$day = array();
			}

			$day[$this->today['mday']] = $day[$this->today['mday']] + 1;
			
			$DB->query("UPDATE ".root_table."cache SET value='". serialize($day) ."' WHERE name='mday'");
		
		}
		
		//----------------------------------------
		// User Week
		//----------------------------------------
		
		$DB->query("SELECT * FROM ".root_table."cache WHERE name='wday'");
		$cache_week = $DB->fetch_array();
		
		if ( !$cache_week )
		{
			$week = array();
			for ( $i = 0; $i < 7; $i++ )
			{
				$week[$i] = 0;
			}
		
			$DB->query("INSERT INTO ".root_table."cache (name, value) VALUES ('wday', '". serialize($week) ."')");
		}
		else
		{
			$week = unserialize($cache_week[1]);
			
			if ( !is_array($week) ) 
			{
				$week = array();
			}

			$week[$this->today['wday']] = $week[$this->today['wday']] + 1;
			
			$DB->query("UPDATE ".root_table."cache SET value='". serialize($week) ."' WHERE name='wday'");
		
		}
		
		//----------------------------------------
		// User Month
		//----------------------------------------
		
		$DB->query("SELECT * FROM ".root_table."cache WHERE name='month'");
		$cache_month = $DB->fetch_array();
		
		if ( !$cache_month )
		{
			$month = array();
			for ( $i = 1; $i < 13; $i++ )
			{
				$month[$i] = 0;
			}
		
			$DB->query("INSERT INTO ".root_table."cache (name, value) VALUES ('month', '". serialize($month) ."')");
		}
		else
		{
			$month = unserialize($cache_month[1]);
			
			if ( !is_array($month) ) 
			{
				$month = array();
			}

			$month[$this->today['mon']] = $month[$this->today['mon']] + 1;
			
			$DB->query("UPDATE ".root_table."cache SET value='". serialize($month) ."' WHERE name='month'");
		
		}
		
		//----------------------------------------
		// User Year
		//----------------------------------------
		
		$DB->query("SELECT * FROM ".root_table."cache WHERE name='year'");
		$cache_year = $DB->fetch_array();
		
		if ( !$cache_year )
		{
			$year = array();
			for ( $i = 2005; $i < 2011; $i++ )
			{
				$year[$i] = 0;
			}
		
			$DB->query("INSERT INTO ".root_table."cache (name, value) VALUES ('year', '". serialize($year) ."')");
		}
		else
		{
			$year = unserialize($cache_year[1]);
			
			if ( !is_array($year) ) 
			{
				$year = array();
			}
			
			$year[$this->today['year']] = $year[$this->today['year']] + 1;
			
			$DB->query("UPDATE ".root_table."cache SET value='". serialize($year) ."' WHERE name='year'");
		
		}
		
		
	}
	
	function counter_days( $month_days )
	{
		$day_info = "";

		for( $i = 0; $i < $this->today['mday']; $i++ )
		{
			if ( $i == $this->today['mday']-1 )
			{
				$day_info .= $month_days[$i] + 1 ."|";
			}
			else if ( $month_days[$i] != 0 )
			{
				$day_info .= "{$month_days[$i]}|";
			}
			else
			{
				$day_info .= "0|";
			}
		}
		
		return $day_info;
	}
		
	function counter()
	{
		global $CMS, $DB, $func;

		$DB->query( $CMS->driver->sess_checkonline( $CMS->class->session->ip_address ) );
		
		$checkonline = $DB->fetch_array();
		$checkonline = $checkonline[0];
		
		if ( $checkonline )
		{	
			$useronline = 0;
		
			$DB->query( $CMS->driver->sess_members_online( $CMS->class->session->time_out ) );
			
			while($result = $DB->fetch_array())
			{
				++$useronline;
			}
		}

		$DB->query("SELECT * FROM ".root_table."counter WHERE year='{$this->today['year']}' AND month='{$this->today['mon']}'");  
		$result = $DB->fetch_array();

		$month_days = explode("|", $result['visitors']);

		if ( $DB->num_rows() == 0 )
		{
			$day_info = $this->counter_days( $month_days );

			$DB->query("INSERT INTO ".root_table."counter( visitors, month, year, visitors_total ) VALUES('{$day_info}', '{$this->today['mon']}', '{$this->today['year']}', 1)");
		}
		else if ( isset($this->update_time) && ($this->update_time < $this->time_out ) )
		{
			$day_info = $this->counter_days( $month_days );
			
			$DB->query("UPDATE ".root_table."counter SET visitors='{$day_info}', visitors_total=visitors_total+1 where year='{$this->today['year']}' and month='{$this->today['mon']}'");
		}
		
		$pages_view = explode("|", $result['pages']);
		$pages_info = $this->counter_days( $pages_view );
		
		$DB->query("UPDATE ".root_table."counter SET pages='{$pages_info}', pages_total=pages_total+1 where year='{$this->today['year']}' and month='{$this->today['mon']}'");
		
		$DB->query("SELECT SUM(visitors_total) FROM ".root_table."counter") or die("Query failed");  
		$result = $DB->fetch_array();
		
		$CMS->vars['counter_today'] = $this->total_day[$this->today['mday']-1]+$inc;
		$CMS->vars['counter_now'] = $useronline;
		$CMS->vars['counter_total'] = $CMS->class->input->number( $result[0] + 1 );
		$CMS->vars['counter_visited']=$this->countvisted();
	}
	function countvisted()
	{
		global $DB,$CMS;		
		$DB->query("SELECT SUM(visitors_total) as visited FROM ".root_table."counter");  
		$count=$DB->fetch_array();
		return $count['visited'];
	}
}

?>