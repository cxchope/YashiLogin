<?php
class nyainfomsg {
    public $imsg = array(
        /*
        ABBCCDD
        A: 1成功 2失败
        BB: 模块，例如「安全类」
        CC: 错误类型
        DD: 详细错误
        */
        // A=1 : 正常
        /// A=1\BB=00 : 通用成功类型
        //// A=1\BB=00\CC=00 : 通用成功
        ///// A=1\BB=00\CC=00\DD=00 :
        1000000 => '执行成功。',
        /// A=1\BB=01 : 数据库类
        //// A=1\BB=01\CC=00 : 数据库相关
        ///// A=1\BB=01\CC=00\DD=00 :
        1010000 => 'SQL语句成功执行。',
        ///// A=1\BB=01\CC=00\DD=01 :
        1010001 => 'SQL语句成功执行，但没有查询到数据。',
        /// A=1\BB=02 : 用户操作
        //// A=1\BB=02\CC=00 : 用户注册
        ///// A=1\BB=02\CC=00\DD=00 :
        1020000 => '注册成功。',
        ///// A=1\BB=02\CC=00\DD=01 :
        1020001 => '注册成功，进一步验证邮件已发送到邮箱',
        ///// A=1\BB=02\CC=00\DD=02 :
        1020002 => '注册成功，请查收手机验证码进行进一步验证',
        //// A=1\BB=02\CC=01 : 用户登录
        ///// A=1\BB=02\CC=01\DD=00 :
        1020100 => '登录成功。',
        ///// A=1\BB=03\CC=01\DD=01 :
        1020101 => '登录成功。提示：',
        ///// A=1\BB=03\CC=01\DD=02 :
        1020102 => '登录成功。你的账户没有对邮箱或手机号进行验证，请尽快验证以确保正常使用。',
        //// A=1\BB=03\CC=02 : 用户登录状态
        ///// A=1\BB=03\CC=02\DD=00 :
        1030200 => '已登录。',
        ///// A=1\BB=03\CC=02\DD=01 :
        1030201 => '登录状态已过期。',
        // A=2 : 错误
        /// A=2\BB=00 : 通用
        //// A=2\BB=00\CC=00 : 未知问题
        ///// A=2\BB=00\CC=00\DD=00 :
        2000000 => '内部错误：出现未知错误。',
        //// A=2\BB=00\CC=01 : 参数相关
        ///// A=2\BB=00\CC=01\DD=00 :
        2000100 => '内部错误：没有参数。',
        ///// A=2\BB=00\CC=01\DD=01 :
        2000101 => '内部错误：需要更多参数。',
        ///// A=2\BB=00\CC=01\DD=02 :
        2000102 => '内部错误：参数无效。',
        ///// A=2\BB=00\CC=01\DD=03 :
        2000103 => '内部错误：不支持的提交方式。',
        ///// A=2\BB=00\CC=01\DD=04 :
        2000104 => '内部错误：参数没有请求的选项。',
        /// A=2\BB=01 : 数据库类
        //// A=2\BB=01\CC=01 : MySQL 数据库连接
        ///// A=2\BB=01\CC=01\DD=00 :
        2010100 => '内部错误：未能连接到数据库。',
        ///// A=2\BB=01\CC=01\DD=01 :
        2010101 => '内部错误：数据库错误。',
        ///// A=2\BB=01\CC=01\DD=02 :
        2010102 => '内部错误：数据库未能返回正确的数据。',
        ///// A=2\BB=01\CC=01\DD=03 :
        2010103 => '内部错误：缺少数据库配置。',
        //// A=2\BB=01\CC=02 : MySQL 数据库非预期数据
        ///// A=2\BB=01\CC=02\DD=00 :
        2010200 => '内部错误：查询数据量超出预期',
        //// A=2\BB=01\CC=02 : Redis 数据库连接
        ///// A=2\BB=01\CC=02\DD=00 :
        2010200 => '内部错误：Redis 数据库插件初始化失败',
        ///// A=2\BB=01\CC=02\DD=01 :
        2010201 => '内部错误：Redis 数据库连接失败',
        ///// A=2\BB=01\CC=02\DD=02 :
        2010202 => '内部错误：Redis 数据库认证失败',
        /// A=2\BB=02 : 安全类
        //// A=2\BB=02\CC=01 : 字符串规则检查
        ///// A=2\BB=02\CC=01\DD=00 :
        2020100 => '错误：无效字符串。',
        ///// A=2\BB=02\CC=01\DD=01 :
        2020101 => '错误：字符格式不正确。',
        ///// A=2\BB=02\CC=01\DD=02 :
        2020102 => '内部错误：SQL语句不正确。',
        ///// A=2\BB=02\CC=01\DD=03 :
        2020103 => '错误：不应包含HTML代码。',
        //// A=2\BB=02\CC=02 : 字符串格式检查
        ///// A=2\BB=02\CC=02\DD=01 :
        2020201 => '错误：不是有效的电子邮件地址。',
        ///// A=2\BB=02\CC=02\DD=02 :
        2020202 => '错误：不是有效的 IPv4 地址。',
        ///// A=2\BB=02\CC=02\DD=03 :
        2020203 => '错误：不是有效的 IPv6 地址。',
        ///// A=2\BB=02\CC=02\DD=04 :
        2020204 => '错误：不是有效的整数数字。',
        ///// A=2\BB=02\CC=02\DD=05 :
        2020205 => '错误：不是有效的中国电话号码。',
        ///// A=2\BB=02\CC=02\DD=06 :
        2020206 => '错误：不是有效的邮箱地址或中国电话号码。',
        ///// A=2\BB=02\CC=02\DD=07 :
        2020207 => '错误：不受支持的电子邮件地址。',
        //// A=2\BB=02\CC=03 : 合规性检查
        ///// A=2\BB=02\CC=03\DD=00 :
        2020300 => '错误：包含可能违禁的词汇。',
        ///// A=2\BB=02\CC=03\DD=01 :
        2020301 => '内部错误：违禁词汇数据库设置不正确。',
        ///// A=2\BB=02\CC=03\DD=02 :
        2020302 => '内部错误：违禁词汇文件加载失败。',
        ///// A=2\BB=02\CC=03\DD=03 :
        2020303 => '内部错误：违禁词汇资料库加载失败。',
        //// A=2\BB=02\CC=04 : 加密通信和IP验证
        ///// A=2\BB=02\CC=04\DD=00 :
        2020400 => '内部错误：参数解码失败',
        ///// A=2\BB=02\CC=04\DD=01 :
        2020401 => '内部错误：此应用不可用',
        ///// A=2\BB=02\CC=04\DD=02 :
        2020402 => '内部错误：无法验证IP地址',
        ///// A=2\BB=02\CC=04\DD=03 :
        2020403 => '错误：IP地址处于封禁状态',
        ///// A=2\BB=02\CC=04\DD=04 :
        2020404 => '内部错误：写入历史记录失败',
        ///// A=2\BB=02\CC=04\DD=05 :
        2020405 => '内部错误：重置加密传输失败',
        ///// A=2\BB=02\CC=04\DD=06 :
        2020406 => '内部错误：创建加密过程失败',
        ///// A=2\BB=02\CC=04\DD=07 :
        2020407 => '错误：访问过于频繁',
        ///// A=2\BB=02\CC=04\DD=08 :
        2020408 => '内部错误：没有提供应用令牌',
        ///// A=2\BB=02\CC=04\DD=09 :
        2020409 => '内部错误：应用令牌不正确',
        ///// A=2\BB=02\CC=04\DD=10 :
        2020410 => '内部错误：json解析失败',
        ///// A=2\BB=02\CC=04\DD=11 :
        2020411 => '内部错误：加密json解析失败',
        ///// A=2\BB=02\CC=04\DD=12 :
        2020412 => '错误：客户端版本不匹配',
        ///// A=2\BB=02\CC=04\DD=13 :
        2020413 => '错误：客户端和服务器时差较大，请校准时间',
        ///// A=2\BB=02\CC=04\DD=14 :
        2020414 => '内部错误：单次提交数据过大',
        ///// A=2\BB=02\CC=04\DD=15 :
        2020415 => '内部错误：服务器要求必须加密传输',
        ///// A=2\BB=02\CC=04\DD=16 :
        2020416 => '内部错误：检查设备信息失败',
        //// A=2\BB=02\CC=05 : 图形验证码
        ///// A=2\BB=02\CC=05\DD=01 :
        2020501 => '错误：图形验证码检查失败',
        ///// A=2\BB=02\CC=05\DD=02 :
        2020502 => '错误：图形验证码超时，再试一次',
        ///// A=2\BB=02\CC=05\DD=03 :
        2020503 => '错误：图形验证码不匹配，再试一次',
        ///// A=2\BB=02\CC=06\DD=04 :
        2020504 => '内部错误：图形验证码生成失败',
        /// A=2\BB=03 : 验证信息问题
        //// A=2\BB=03\CC=01 : 密码
        ///// A=2\BB=03\CC=01\DD=00 :
        2030100 => '错误：密码只能包括指定的字符',
        ///// A=2\BB=03\CC=01\DD=01 :
        2030101 => '错误：密码不够复杂',
        ///// A=2\BB=03\CC=01\DD=02 :
        2030102 => '错误：密码长度不符合要求',
        //// A=2\BB=03\CC=02 : 电子邮件
        ///// A=2\BB=03\CC=02\DD=00 :
        2030200 => '内部错误：邮件发送失败',
        ///// A=2\BB=03\CC=02\DD=01 :
        2030201 => '内部错误：邮件发送历史记录存储失败',
        /// A=2\BB=04 : 用户账户操作
        //// A=2\BB=04\CC=01 : 用户注册
        ///// A=2\BB=04\CC=01\DD=00 :
        2040100 => '内部错误：检查是否已有登录凭据失败',
        ///// A=2\BB=04\CC=01\DD=01 :
        2040101 => '内部错误：检查到多个重复的凭据',
        ///// A=2\BB=04\CC=01\DD=02 :
        2040102 => '错误：输入的登录凭据已经存在',
        ///// A=2\BB=04\CC=01\DD=03 :
        2040103 => '错误：不允许使用这种方式注册',
        ///// A=2\BB=04\CC=01\DD=04 :
        2040104 => '错误：电子邮件地址太长',
        ///// A=2\BB=04\CC=01\DD=05 :
        2040105 => '错误：昵称太长',
        ///// A=2\BB=04\CC=01\DD=06 :
        2040106 => '内部错误：生成用户编号没有成功',
        ///// A=2\BB=04\CC=01\DD=07 :
        2040107 => '内部错误：未能生成用户标识码',
        ///// A=2\BB=04\CC=01\DD=08 :
        2040108 => '内部错误：注册用户没有成功',
        ///// A=2\BB=04\CC=01\DD=09 :
        2040109 => '内部错误：将用户添加到用户组没有成功',
        ///// A=2\BB=04\CC=01\DD=10 :
        2040110 => '内部错误：创建密码保护没有成功',
        ///// A=2\BB=04\CC=01\DD=11 :
        2040111 => '内部错误：创建用户信息没有成功',
        ///// A=2\BB=04\CC=01\DD=12 :
        2040112 => '内部错误：未能写入操作历史记录',
        ///// A=2\BB=04\CC=01\DD=13 :
        2040113 => '内部错误：未能生成用户令牌',
        //// A=2\BB=04\CC=2 : 用户登入
        ///// A=2\BB=04\CC=02\DD=00 :
        2040200 => '内部错误：查询用户是否存在没有成功',
        ///// A=2\BB=04\CC=02\DD=01 :
        2040201 => '错误：用户不存在',
        ///// A=2\BB=04\CC=02\DD=02 :
        2040202 => '需要更多信息：请提供验证码',
        ///// A=2\BB=04\CC=02\DD=03 :
        2040203 => '内部错误：不受支持的验证方式',
        ///// A=2\BB=04\CC=02\DD=04 :
        2040204 => '错误：用户名或密码不正确', //下次不会被要求验证码
        ///// A=2\BB=04\CC=02\DD=05 :
        2040205 => '错误：账户已被锁定。', //同时返回：封禁到日期和原因
        ///// A=2\BB=04\CC=02\DD=06 :
        2040206 => '内部错误：获取用户个人资料失败。',
        ///// A=2\BB=04\CC=02\DD=07 :
        2040207 => '内部错误：主用户资料数据有问题。',
        ///// A=2\BB=04\CC=02\DD=08 :
        2040208 => '错误：用户名或密码不正确', //下次会被要求验证码
        ///// A=2\BB=04\CC=02\DD=09 :
        2040209 => '内部错误：检查已有登录会话没有成功。',
        ///// A=2\BB=04\CC=02\DD=10 :
        2040210 => '内部错误：取得设备ID失败。',
        ///// A=2\BB=04\CC=02\DD=11 :
        2040211 => '内部错误：自动登出旧客户端失败。',
        ///// A=2\BB=04\CC=02\DD=12 :
        2040212 => '内部错误：自动登出旧客户端信息获取失败。',
        ///// A=2\BB=04\CC=02\DD=13 :
        2040213 => '内部错误：获得当前设备型号失败。',
        ///// A=2\BB=04\CC=02\DD=14 :
        2040214 => '内部错误：不支持的设备类型。',
        //// A=2\BB=04\CC=3 : 两步验证
        ///// A=2\BB=04\CC=03\DD=00 :
        2040300 => '需要更多信息：需要进行两步验证。', //同时返回：支持的两步验证方式
        ///// A=2\BB=04\CC=03\DD=01 :
        2040301 => '内部错误：读取密码提示问题失败。',
        ///// A=2\BB=04\CC=03\DD=02 :
        2040302 => '内部错误：未开启此项两步验证方式。',
        ///// A=2\BB=04\CC=03\DD=03 :
        2040303 => '错误：动态验证码不正确',
        ///// A=2\BB=04\CC=03\DD=04 :
        2040304 => '错误：密码提示答案不正确',
        ///// A=2\BB=04\CC=03\DD=05 :
        2040305 => '错误：无效的恢复代码',
        //// A=2\BB=04\CC=4 : 状态查询
        ///// A=2\BB=04\CC=04\DD=00 :
        2040400 => '内部错误：无效的 token',
        ///// A=2\BB=04\CC=04\DD=01 :
        2040401 => '内部错误：登录状态查询失败',
        //// A=2\BB=04\CC=5 : 搜索
        ///// A=2\BB=04\CC=05\DD=00 :
        2040500 => '内部错误：用户搜索没有成功',
        /// A=2\BB=05 : 文件系统操作
        //// A=2\BB=05\CC=01 : 文件上传
        ///// A=2\BB=05\CC=01\DD=00 :
        2050100 => '错误：文件上传失败',
        ///// A=2\BB=05\CC=01\DD=01 :
        2050101 => '错误：文件体积超过上限',
        ///// A=2\BB=05\CC=01\DD=02 :
        2050102 => '错误：不支持的文件类型',
        ///// A=2\BB=05\CC=01\DD=03 :
        2050103 => '错误：视频太长',
        ///// A=2\BB=05\CC=01\DD=04 :
        2050104 => '错误：需要上传一个文件',
        ///// A=2\BB=05\CC=01\DD=05 :
        2050105 => '内部错误：文件复制失败',
        // A=3 : 警告
        /// A=3\BB=00 : 用户
        //// A=3\BB=00\CC=00 : 允许用户登录
        ///// A=3\BB=00\CC=00\DD=00 :
        3000000 => 1020102, //连接到
        //// A=3\BB=00\CC=01 : 不允许用户登录
        ///// A=3\BB=00\CC=01\DD=00 :
        3000100 => "提示：由于你在使用中有不友好或违规行为，你的账户已被冻结。",
        ///// A=3\BB=00\CC=01\DD=01 :
        3000101 => "提示：根据相关法律法规或政策，无法继续操作。",
    );
    /**
     * @description: 创建异常信息提示JSON
     * @param Int msgmode 错误信息输出方式：0返回数组，1返回JSON
     * @param String msgmode 输入 totp secret 而不是数字的话，会用此 secret 加密并返回。
     * @param Int code 错误代码
     * @param String/Array info 附加错误信息
     * @param String totpsecret 加密用secret（不加则自动）
     * @return String 返回由 msgmode 设置的 null / json / 加密 json
     */
    function m($msgmode = 0,$code = 2000000,$info = null) {
        $returnarr = array(
            "code" => $code,
            "msg" => $this->imsg[$code]
        );
        if (is_numeric($returnarr["msg"])) $returnarr["msg"] = $this->imsg[$returnarr["msg"]];
        if ($info) $returnarr["info"] = $info;
        if (is_numeric($msgmode) && $msgmode === 0) {
            return $returnarr;
        } else if (is_numeric($msgmode) && $msgmode === 1) {
            return json_encode($returnarr);
        } else {
            global $nlcore;
            return $nlcore->safe->encryptargv($returnarr,$msgmode);
        }
    }
    /**
     * @description: 返回信息，或抛出403错误，结束程序
     * @param Int code 错误代码
     * @param String totpsecret 加密用secret（可选，不加则明文返回）
     * @param String str 附加错误信息
     * @param Bool showmsg 是否显示错误信息（否则直接403）
     */
    function stopmsg($code=null,$totpsecret=null,$str="",$showmsg=true) {
        if ($code && $showmsg > 0) {
            global $nlcore;
            $msgmode = $totpsecret ? $totpsecret : 1;
            $json = $this->m($msgmode,$code,$str,$totpsecret);
            header('Content-Type:application/json;charset=utf-8');
            echo $json;
        } else {
            header('HTTP/1.1 403 Forbidden');
        }
        die();
    }
    function __destruct() {
        $this->imsg = null;
        unset($this->imsg);
    }
}
?>