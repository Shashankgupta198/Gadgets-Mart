<?php
function generateInsertQuery($table_name, $column_values) {
    $query = "insert into {$table_name} ";
    if (is_array($column_values)) {
        $keys = array_keys($column_values);
        $count = 0;
        $query .= "(";
        foreach ($keys as $key) {
            $count++;
            $query .= $key;
            if ($count != count($keys)) {
                $query .= ",";
            }
        }
        $query .=") values(";
        $count = 0;
        foreach ($keys as $key) {
            $count++;
            $value = $column_values[$key];
            if (is_string($value)) {
                $query .= "'" . $value . "'";
            } else if (is_numeric($value) || is_float($value)) {
                $query .= $value;
            } else {
                $query .= "'" . $value . "'";
            }
            if ($count != count($keys)) {
                $query .= ",";
            }
        }
        $query .= ")";
    }
    return $query;
}

function generateDeleteQuery($table_name, $column_values) {
    $query = "delete from {$table_name} ";
    if (is_array($column_values)) {
        $keys = array_keys($column_values);
        $count = 0;
        $query .= " where ";
        foreach ($keys as $key) {
            $count++;
            $query .= $key . " = ";
            $value = $column_values[$key];
            if (is_string($value)) {
                $query .= "'" . $value . "'";
            } else if (is_numeric($value) || is_float($value)) {
                $query .= $value;
            } else {
                $query .= "'" . $value . "'";
            }
            if ($count != count($keys)) {
                $query .= " and ";
            }
        }        
    }
    return $query;
}

function generateUpdateQuery($table_name, $column_values,$where_values) {
    $query = "update {$table_name} ";
    if (is_array($column_values)) {
        $keys = array_keys($column_values);
        $count = 0;
        $query .= " set ";
        foreach ($keys as $key) {
            $count++;
            $query .= $key . ' = ';
            $value = $column_values[$key];
            if (is_string($value)) {
                $query .= "'" . $value . "'";
            } else if (is_numeric($value) || is_float($value)) {
                $query .= $value;
            } else {
                $query .= "'" . $value . "'";
            }
            if ($count != count($keys)) {
                $query .= ",";
            }
        }
    }
    if (is_array($where_values)) {
        $keys = array_keys($where_values);
        $count = 0;
        $query .= " where ";
        foreach ($keys as $key) {
            $count++;
            $query .= $key . " = ";
            $value = $where_values[$key];
            if (is_string($value)) {
                $query .= "'" . $value . "'";
            } else if (is_numeric($value) || is_float($value)) {
                $query .= $value;
            } else {
                $query .= "'" . $value . "'";
            }
            if ($count != count($keys)) {
                $query .= " and ";
            }
        }        
    }
    return $query;
}

function randomString($length = 6) {
    $str = "";
    $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

function sendEmail($target_emailid, $subject, $message_text) {
    require("phpmailer/PHPMailerAutoload.php");
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "ag5444354@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "191999ag";

    //Set who the message is to be sent from
    $mail->setFrom('ag5444354@gmail.com', 'First Last');

    //Set an alternative reply-to address
    $mail->addReplyTo($target_emailid, 'Grapess Solutions');

    //Set who the message is to be sent to
    $mail->addAddress($target_emailid, 'Grapess Solutions');

    //Set the subject line
    $mail->Subject = $subject;

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($message_text);

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

?>
