<?php
class UsersController extends AppController {
    public $helpers = array('Html', 'Form','Ajax','Javascript');

    var $scaffold;

    function login()
    {
        $this->layout = 'login';
        if (!empty($this->data)){
            $someone = $this->User->findByUsername($this->data['User']['username']);
            if(!empty($someone['User']['password']) && $someone['User']['password'] == md5($this->data['User']['password']))
            {
                $this->Session->write('User', $someone['User']);
                $this->Session->setFlash(__('WELCOME '.$this->data['User']['username']));
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }else{
                $this->Session->setFlash(__('Your username or password is wrong！'));
            }
        }
    }

    function userNameUnique(){
        $someone = $this->User->findByUsername($_POST['username']);
        if(!empty($someone['User']))
        {
            $this->done("用户名已存在",1);
        }
    }

    function check(){
        $someone = $this->User->findByUsername($_POST['username']);
        if(empty($someone['User']['password'])){
            $this->done("用户名不存在",0);
        }elseif($someone['User']['password'] == md5($_POST['pwd'])){
            $this->done("验证通过",1);
        }else{
            $this->done("用户名与密码匹配不正确",0);
        }
    }

    function success(){
        $this->layout = 'login';
        $url = base64_decode(base64_decode( $_GET['url']));
        $user_meg = explode('/',$url);
        $data = $this->User->findByEmail($user_meg[1]);
        $data['User']['is_activate'] = 1;
        if($this->User->save($data)){
            $this->tixing(__('您已经成功激活您的账户！'));
        }else{
            $this->tixing(__('您的账户激活失败！ !'));
        }
    }
    function register(){
        $this->layout = 'login';
        if (!empty($this->data)){
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('恭喜！注册成功！'));
                return $this->redirect(array('action' => 'login'));
            }else{
                $this->Session->setFlash(__('注册失败！'));
            }
        }
    }
    function emailUnique(){
        $someone = $this->User->findByEmail($_POST['email']);
        if(empty($someone['User'])){
            $this->done("邮箱可用",1);
        }else{
            $this->done("邮箱已存在！",0);
        }
    }
    function doregister(){
        $_POST['password'] = md5($_POST['password']);
        $this->User->create();
        if ($this->User->save($_POST)) {
            $title = $_POST['username'].',MyTime用户注册成功提醒邮件';
            $username = $_POST['username'];
            $to_email = $_POST['email'];
            $time = time();
            $rel = $username."/".$to_email."/".$time;
            $rel = base64_encode(base64_encode($rel));
            $message=<<<start
                尊敬的用户:<br/>
                您好！<br/>
                您已成功成为MyTime一员，您的账户为  $username ；请点击下面的链接激活您的账户。<br/>
                <a target="_blank" href="www.mycake.com/users/success/?url=$rel">www.mycake.com/users/success/?url=$rel</a><br/>
                <br/>
                <br/>
                MyTime软件项目任务管理系统<a target="_blank" href="http://www.mytime.com">www.MyTime.com</a><br/>
start;
            if($this->sendMail($to_email,$title,$message)){
                $this->done("注册成功！",1);
            }else{
                $this->done("注册失败！",0);
            }
            /*App::uses('CakeEmail','Network/Email');
            $Email = new CakeEmail('gmail');
            try {
                $Email->from(array('mytime_cake@126.com' => 'MyTime'))
                    ->to($to_email)
                    ->subject($title)
                    ->send($message);
            }catch (phpmailerException $e){
                $this->done("注册失败！",0);
            }
                $this->done("注册成功！",1);*/
        }else{
            $this->done("注册失败！",0);
        }
    }
    function loginout()
    {
        $this->Session->delete('User');
        $this->redirect(array('action' => 'login'));
    }

    /**
     * 发送邮件
     * @string type $address  邮件地址
     * @string type $title     标题
     * @string type $message   邮件信息
     * @return boolean
     */
    function sendMail($address,$title,$message){
        //创建mail对象
        App::uses('PhpMailerComponent','Controller/Component');
        $mail = new PhpMailerComponent();

        $mail->IsSMTP(); //设置使用SMTP服务器发送
        $mail->Host = "smtp.126.com";  //设置126邮箱服务
        $mail->SMTPAuth = true;     // 设置需要验证
        $mail->Username = "mytime_cake@126.com";  // 发件人使用邮箱
        $mail->Password = "gj931120"; // 设置发件人密码

        $mail->From = "mytime_cake@126.com";// 发件人邮箱
        $mail->FromName = "Mytime"; //发送者名称
        $mail->AddAddress($address); // 添加发送地址

        $mail->IsHTML(true); //指定支持html格式
        $mail->CharSet="UTF-8";

        $mail->Subject = $title;
        $mail->Body = $message;

        if($mail->Send()){
            return true;
        }else{
            return false;
        }
    }

}