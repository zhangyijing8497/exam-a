<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登陆</title>
</head>
<body>
    <center>
        <table>
            <h3>欢迎登陆</h3>
            <form action="{{url('/login')}}" method="post">
            @csrf
                <tr>
                    <td>用户名</td>
                    <td><input type="text" name="u" placeholder="请输入用户名/邮箱/手机号"></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input type="password" name="pwd" placeholder="请输入密码"></td>
                </tr>
                <tr>
                    <td>-></td>
                    <td><input type="submit" value="登陆"></td>
                </tr>
            </form>
        </table>
    </center>
</body>
</html>