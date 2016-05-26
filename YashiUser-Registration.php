<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>YashiUser-Registration</title>
<link href="YashiUser-Registration.css" rel="stylesheet" type="text/css">
<script type="text/ecmascript" src="md5.js"></script>
<script language="JavaScript" src="YashiUser-Registration.js"></script>
</head>

<body>
<center><h2>雅诗通用用户登录后台测试接口</h2>
<h3>用户注册</h3><?php echo $_SERVER['SERVER_PROTOCOL']." HTTPS=".$_SERVER['HTTPS']; ?></center>
<form action="?" id="form1" name="form1" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
      <tr>
        <td align="right" width="50%">ID*(uint11)：</td>
        <td><input type="text" name="id" disabled id="id" value="(自增)"></td>
      </tr>
      <tr>
        <td align="right">配置文件版本(uint5)：</td>
        <td><input type="text" name="userversion" disabled id="userversion" value="1"></td>
      </tr>
      <tr>
        <td align="right">用户名*(text)：</td>
        <td><input type="text" name="username" id="username" value="testuser"></td>
      </tr>
      <tr>
        <td align="right">昵称*(text)：</td>
        <td><input type="text" name="usernickname" id="usernickname" value="测试用户"></td>
      </tr>
      <tr>
        <td align="right">电子邮件*(text)：</td>
        <td><input type="text" name="useremail" id="useremail" value="test@test.test"></td>
      </tr>
      <tr>
        <td align="right">密码*(text)：</td>
        <td><input type="password" name="userpassword" id="userpassword" value="testpass"></td>
      </tr>
      <tr>
        <td align="right">验证密码*(text)：</td>
        <td><input type="password" name="userpasswordr" id="userpasswordr" value="testpass"></td>
      </tr>
      <tr>
        <td align="right">二级密码(text)：</td>
        <td><input type="password" name="userpassword2" id="userpassword2"></td>
      </tr>
      <tr>
        <td align="right">验证二级密码(text)：</td>
        <td><input type="password" name="userpassword2r" id="userpassword2r"></td>
      </tr>
      <tr>
        <td align="right">密码有效*(tinyint1)：</td>
        <td><input name="userpasswordenabled" type="checkbox" id="userpasswordenabled" checked disabled></td>
      </tr>
      <tr>
        <td align="right">用户启用*(tinyint1)：</td>
        <td><input name="userenable" type="checkbox" id="userenable" checked disabled></td>
      </tr>
      <tr>
        <td align="right">权限等级*(uint11)：</td>
        <td><input type="text" name="userjurisdiction" id="userjurisdiction" value="1" disabled></td>
      </tr>
      <tr>
        <td align="right">密码提示问题1(text)：</td>
        <td><input type="text" name="userpasswordquestion1" id="userpasswordquestion1" value="问题1"></td>
      </tr>
      <tr>
        <td align="right">密码提示答案1(text)：</td>
        <td><input type="text" name="userpasswordanswer1" id="userpasswordanswer1" value="答案1"></td>
      </tr>
      <tr>
        <td align="right">密码提示问题2(text)：</td>
        <td><input type="text" name="userpasswordquestion2" id="userpasswordquestion2" value="问题2"></td>
      </tr>
      <tr>
        <td align="right">密码提示答案2(text)：</td>
        <td><input type="text" name="userpasswordanswer2" id="userpasswordanswer2" value="答案2"></td>
      </tr>
      <tr>
        <td align="right">密码提示问题3(text)：</td>
        <td><input type="text" name="userpasswordquestion3" id="userpasswordquestion3" value="问题3"></td>
      </tr>
      <tr>
        <td align="right">密码提示答案3(text)：</td>
        <td><input type="text" name="userpasswordanswer3" id="userpasswordanswer3" value="答案3"></td>
      </tr>
      <tr>
        <td align="right">性别*(int2)：</td>
        <td><select name="usersex" id="usersex">
          <?php
          require "yaloginGlobal.php";          
          $globalsett = new YaloginGlobal();
          $sexArrin = $globalsett->sexArr;
          for ($i=0; $i < count($sexArrin); $i++) { 
            echo "<option value=\"".$i."\">".$sexArrin[$i]."</option>";
          }
          date_default_timezone_set("PRC");
          $datetime = "\"".date("Y-m-d h:i:s")."\"";
          $userip = "\"".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']."/".$_SERVER['REMOTE_HOST']."\"";
          ?>
        </select></td>
      </tr>
      <tr>
        <td align="right">生日*(date)：</td>
        <td><input type="text" name="userbirthday" id="userbirthday" value="2016-04-21"></td>
      </tr>
      <tr>
        <td align="right">用户注册时间*(datetime)：</td>
        <td><input type="text" name="userregistertime" id="userregistertime" value=<?php echo $datetime; ?> disabled></td>
      </tr>
      <tr>
        <td align="right">用户注册IP*(text)：</td>
        <td><input type="text" name="userregisterip" id="userregisterip" value=<?php echo $userip; ?> disabled></td>
      </tr>
      <tr>
        <td align="right">用户上次登录时间*(datetime)：</td>
        <td><input type="text" name="userlogintime" id="userlogintime" value=<?php echo $datetime; ?> disabled></td>
      </tr>
      <tr>
        <td align="right">用户上次登录IP*(text)：</td>
        <td><input type="text" name="userloginip" id="userloginip" value=<?php echo $userip; ?> disabled></td>
      </tr>
      <tr>
        <td align="right">用户上次登录使用的应用*(text)：</td>
        <td><input type="text" name="userloginapp" id="userloginapp" value="test-dev"></td>
      </tr>
      <tr>
        <td></td>
        <td><img id="vcodeimg" title="点击刷新" src="./getvalidateimage.gif" align="absbottom" onclick="this.src='./validate_image.php?'+Math.random();" alt="点击刷新"></img> ←点击可以刷新</td>
      </tr>
      <tr>
        <td align="right">验证码*(text)：</td>
        <td><input type="text" name="vcode" id="vcode"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right"><input type="reset" name="reset" id="reset" value="取消"></td>
        <td><input type="button" name="submitbutton" id="submitbutton" value="注册新用户"  onclick="toVaild('yaloginRegistration.php')"></td>
      </tr>
    </tbody>
  </table>
</form>
<center><p>© Kagurazaka Yashi</p></center>
</body>
</html>
