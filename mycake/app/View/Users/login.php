<div class='container'>
    <form action="/users/login" method="post" id="form1" class="log_frm">
        <div class="clearfix">
            <input type="text" name="data[User][username]" id="username" value="用户名"/>
            <span id="uname_msg" style="display: none;position: absolute;color: red;font-size: 12px;"></span>
        </div>
        <div class="clearfix">
            <span class="default">密码</span>
            <input type="password" name="data[User][password]" id="pwd"/>
            <span id="pwd_msg" style="display: none;position: absolute;color: red;font-size: 12px;"></span>
        </div>
            <input type="submit" class="dologin" value="登录"/>
    </form>
    <div class="tozhuce">
        没有账号，
        <a href='/users/register'>立即注册</a>
    </div>
</div>
<script type="text/javascript">
    inputInit();
    function inputInit(){
        $("#username").focus(function(e) {
            $(this).css("color","#000");
            if(this.value == "用户名"){
                $(this).val("");
                $("#uname_msg").css("display","none");
            }
        });
        $("#pwd").focus(function(e){
            $(this).prev("span").css("display","none");
            $("#pwd_msg").css("display","none");
        });
        $("#pwd").blur(function(e){
            if(this.value == ""){
                $(this).prev("span").css("display","block");
                $(this).prev("span").css("margin-left","10px");
            }
        })
        $("#username").blur(function(e) {
            if(this.value == ""){
                $(this).css("color","#ccc");
                $(this).val("用户名");
            }
        });
    }
    $(function(){
        $("#username").focus();
        $("#form1").submit(function(){
            var username = $("#username").val();
            var pwd = $("#pwd").val();
            if(username == '' || username == '用户名'){
                $("#uname_msg").css("display","block").html("用户名不能为空");
                return false;
            }else if(pwd == ''){
                $("#pwd_msg").css("display","block").html("密码不能为空");
                return false;
            }
            $.post("/users/check",{'username':username,'pwd':pwd},function(jsonData){
                if(jsonData.flag == 1){
                    return true;
                }else{
                    $("#uname_msg").css("display","block").html(jsonData.data);
                    return false;
                }
            },'json');
            return false;
        })
    })
</script>