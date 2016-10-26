<div class="container">
    <form action="" method="post" class="reg_frm w450" id="form1">
        <p class="clearfix">
            <span class="item w100">用户名：</span>
            <input type="text" value="" name="username" id="username"/>
        </p>
        <span class="note font12">4-20位字符，支持汉子、字母、数字及"-" "."组合</span>
        <p class="clearfix">
            <span class="item w100">密码：</span>
            <input type="password" value="" name="password" id="password"/>
        </p>
        <span class="note font12">6-20位字符，建议由字母，数字和符号两种以上组合</span>
        <p class="clearfix">
            <span class="item w100">确认密码：</span>
            <input type="password" value="" name="repassword"/>
        </p>
        <p class="clearfix">
            <span class="item w100">邮箱：</span>
            <input type="text" value="" name="email" id="email"/>
        </p>
        <span class="note font12">请输入正确的邮箱账号！</span>
        <p class="clearfix">
            <input class="subbtn" type="button" value="立即注册"/>
        </p>
    </form>
</div>
<script type="text/javascript">
    inputInit();
    function inputInit(){
        $("#form1 input").focus(function(e){
            $(this).parent().next("span").css("color","#000");
            $(this).parent().next("span").css("visibility","visible");
        });
        $("#form1 input").blur(function(e){
            var obj = $(this).attr("name");
            if(this.value == ''){
                $(this).parent().next("span").css("visibility","hidden");
            }else{
                if(checkinput(obj)){
                    $(this).parent().next("span").css("color","#000");
                    $(this).parent().next("span").css("visibility","hidden");
                }else{
                    $(this).parent().next("span").css("visibility","visible");
                    $(this).parent().next("span").css("color","red");
                }
            }
        });

    }
    function checkinput(obj){
        if(obj == "username"){
            if(!$("#username").attr("value").match(/^[\u4e00-\u9fa5a-zA-Z_0-9-.]{4,20}$/)){
                $("#username").focus();
                return false;
            }else{
                $.post("/users/userNameUnique",{"username":$("#username").attr("value")},function(json){
                      if(json.flag == 1){
                          alert("用户名已存在！")
                      }
                },'json')
            }
        }
        if(obj == "password"){
            if(!$("#password").attr("value").match(/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]$/)){
                $("#password").focus();
                return false;
            }
        }
        if(obj == "email"){
            if(!$("#email").attr("value").match(/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/)){
                $("#email").focus();
                return false;
            }else{
                $.post("/users/emailUnique",{"email":$("#email").attr("value")},function(json){
                    if(!json.flag){
                        alert("邮箱已存在！")
                    }
                },'json')
            }
        }
        return true;
    }

    $(function(){
        $(".subbtn").click(function(){
            var username = $("#username").val();
            var pwd = $("#password").val();
            var repwd = $("input[name=repassword]").val();
            var email = $("#email").val();
            if(!username.match(/^[\u4e00-\u9fa5a-zA-Z_0-9-.]{4,20}$/)){
                $("#username").focus();
                return false;
            }
            if(!pwd.match(/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]$/)){
                $("#password").focus();
                return false;
            }
            if(!email.match(/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/)){
                $("#email").focus();
                return false;
            }
            if(pwd == repwd){
                $.post("/users/emailUnique",{'email':email},function(json){
                    if(json.flag == 1){
                        $.post("/users/doregister",{'username':username,'password':pwd,'email':email},function(jsonData){
                            if(jsonData.flag == 1){
                                alert("恭喜您注册成功！");
                            }
                        },'json');
                    }else{
                        alert(json.data);
                    }
                },'json');
            }else{
                alert("确认密码不正确！");
                $("#password").val('');
                $("#password").focus();
                $("input[name=repassword]").val('');
                return false;
            }
        })
    })
</script>