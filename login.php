<form action = "index.php?accion=login" method = "post" name = "login_form" style="text-align: center">
    <table>
        <tr>
            <th colspan="2"><h1>Login</h1></th>
        </tr>
        <tr>
            <td>Usuario: </td>
            <td><input type = "text" name = "usuario" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type = "password" name = "password" id = "password"/></td>
        </tr>
        <tr>
            <td colspan="2"><input type = "button" value = "Login" onclick = "formhash(this.form, this.form.password);" /></td>
        </tr>
    </table>
</form>