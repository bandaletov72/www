<script Language="JavaScript"><!--
function check()
{

  if (document.forms[0].name.value == "")
  {
    alert("Пожалуйста введите имя!");
    document.forms[0].name.focus();

  } else {

  if (document.forms[0].message.value == "")
  {
    alert("Введите сообщение!");
    document.forms[0].message.focus();

  } else {
  document.forms[0].submit();
  }
  }
}
//--></script>
<form method="POST" action="add.phtml" name="form1">
    <h4><b><font color=#0069DD><small>Вы можете оставить свое сообщение в нашей книге отзывов:</small></font></b></h4>
    <table border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td valign="top" align="left"><b><small>Ваше имя:</small></b></td>
        <td colspan="2" valign="top">
        <input type="text" name="name" size="70"></td>
      </tr>
      <tr>
        <td valign="top" align="left"><small><b>Сообщение:</b><br><br><small>Использование HTML:<br><b>Отключено</b></small></small></td>
        <td colspan="2" valign="top">
        <textarea rows="11" name="message" cols="33"></textarea></td>
      </tr>
      <tr>
        <td valign="top"></td>
        <td valign="top"><input type="reset" value="Очистить"></td>
        <td valign="top">
          <p align="right"><input type="button" value="Отправить отзыв" onClick="javascript:check()"></td>
      </tr>
    </table>


</form>

