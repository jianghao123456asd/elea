<?php
header("Access-Control-Allow-Origin: *");
/**
 * name:用户名
 * password:密码
 */
echo <<<JSON
    {
        "status":"true",
        "message":"登录成功",
        "user_id":"44",
        "username":"123"
    }
    

JSON;
