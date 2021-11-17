<?php
namespace Phppot;

class Member
{

    private $ds;

    private $applicationUrl = 'https://agoncillo-rpt.online/res/forgot/';

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }

    /**
     * to get member record by username
     *
     * @param string $username
     * @return array
     */
    public function getMember($username)
    {
        $query = 'SELECT * FROM accounts where Username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    /**
     * main function that handles the forgot password
     *
     * @return string[]
     */
    public function handleForgot()
    {
        if (! empty($_POST["username"])) {
            $memberRecord = $this->getMember($_POST["username"]);
            require_once __DIR__ . "/PasswordReset.php";
            $passwordReset = new PasswordReset();
            $token = $this->generateRandomString(97);
            if (! empty($memberRecord)) {
                $passwordReset->insert($memberRecord[0]['ID'], $token);
                $this->sendResetPasswordEmail($memberRecord, $token);
            } else {
                // the input username is invalid
                // do not display a message saying 'username as invalid'
                // that is a security issue. Instead,
                // sleep for 2 seconds to mimic email sending duration
                sleep(2);
            }
        }
        // whatever be the case, show the same message for security purposes
        $displayMessage = array(
            "status" => "success",
            "message" => "Check your email to reset password."
        );
        return $displayMessage;
    }

    /**
     * to send password recovery email
     * you may substitute this code with SMTP based email
     * Refer https://phppot.com/php/send-email-in-php-using-gmail-smtp/ to send smtp
     * based email
     *
     * @param array $memberListAry
     * @param string $token
     */
    public function sendResetPasswordEmail($memberListAry, $token)
    {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Agoncillo RPT<admin@agoncillo-rpt.online>'."\r\n";
        $resetUrl = '' . $this->applicationUrl . 'reset-password.php?token=' . $token . '';
        $emailBody = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr"> 
<head>
<style type="text/css">
 .link:link, .link:active, .link:visited {
       color:#2672ec !important;
       text-decoration:none !important;
 }

 .link:hover {
       color:#4284ee !important;
       text-decoration:none !important;
 }
 .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<title></title>
</head>
<body>
<table dir="ltr">
      <tr><td id="i1" style="padding:0; font-family:Segoe UI Semibold, Segoe UI Bold, Segoe UI, Helvetica Neue Medium, Arial, sans-serif; font-size:17px; color:#707070;"><img src="https://agoncillo-rpt.online/images/ROP.png" width="100px" height="100px"></td></tr>
      <tr><td id="i2" style="padding:0; font-family:Segoe UI Light, Segoe UI, Helvetica Neue Medium, Arial, sans-serif; font-size:41px; color:#2672ec;">Password reset for your account</td></tr>
      
      <tr><td style="padding:0; padding-top:25px; font-family:Segoe UI, Tahoma, Verdana, Arial, sans-serif; font-size:14px; color:#2a2a2a;">To finish resetting your <b>Agoncillo RPT</b> account password. Click the password reset link below: <span style="font-family:Segoe UI Bold, Segoe UI Semibold, Segoe UI, Helvetica Neue Medium, Arial, sans-serif; font-size:14px; font-weight:bold; color:#2a2a2a;"><br><br><a class="button" style="color:white;" href="'.$resetUrl.'">Reset Password</a></span></td></tr>

      <tr><td id="i6" style="padding:0; padding-top:25px; font-family:Segoe UI, Tahoma, Verdana, Arial, sans-serif; font-size:14px; color:#2a2a2a;">If you didn&apos;t request this, you can safely ignore this email. Someone else might have typed your email address by mistake.</td></tr>
      <tr><td style="padding:0; padding-top:25px; font-family:Segoe UI, Tahoma, Verdana, Arial, sans-serif; font-size:14px; color:#2a2a2a;">Thanks,</td></tr>
      <tr><td id="i8" style="padding:0; font-family:Segoe UI, Tahoma, Verdana, Arial, sans-serif; font-size:14px; color:#2a2a2a;">The Developer team</td></tr>
</table>
</body>
</html>';
        $to = $memberListAry[0]["email"];
        $subject = 'Reset password';
        mail($to, $subject, $emailBody,$headers);
    }

    public function updatePassword($id, $password)
    {
        //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedPassword = md5($password);
        $query = 'UPDATE accounts SET Password = ? WHERE ID = ?';
        $paramType = 'si';
        $paramValue = array(
            $hashedPassword,
            $id
        );
        $this->ds->execute($query, $paramType, $paramValue);

        $displayMessage = array(
            "status" => "success",
            "message" => "Password reset successfully."
        );
        return $displayMessage;
    }

    /**
     * use this function if you have PHP version 7 or greater
     * else use the below fuction generateRandomString
     *
     * @param int $length
     * @param string $keyspace
     * @throws \RangeException
     * @return string
     */
    function getRandomString(int $length = 64, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++ $i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    /**
     * this generates predictable random strings.
     * So the best
     * option is to use the above function getRandomString
     * and to use that, you need PHP 7 or above
     *
     * @param number $length
     * @return string
     */
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i ++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
