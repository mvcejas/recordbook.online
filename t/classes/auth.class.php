<?php

class auth {

  public static function login_teacher($email, $password) {
    global $dbh;
    $pass = md5($password);
    $stmt = $dbh->prepare("SELECT * FROM teachers WHERE teacher_email=:email AND teacher_password=:pass");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    $row  = $stmt->fetchColumn();

    if (!$row) {
      return false;
    }
    return $row;
  }

  public static function login_student($email, $password) {
    global $dbh;
    $pass = md5($password);
    $stmt = $dbh->prepare("SELECT * FROM students WHERE student_email=:email AND student_password=:pass");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    $row  = $stmt->fetchColumn();

    if (!$row) {
      return false;
    }
    return $row;
  }

  public static function logout() {
    foreach ($_SESSION as $key=>$val) {
      unset($_SESSION[$key]);
    }
  }
  
  public static function session(){
    if(isset($_SESSION['login_sess_id'])){
      return true;
    }
    return false;
  }
  
  public static function setSessionId($user_id) {
    $_SESSION['login_sess_id'] = $user_id;
  }
  
  public static function getSessionId() {
    return isset($_SESSION['login_sess_id']) ? $_SESSION['login_sess_id'] : null;
  }
}