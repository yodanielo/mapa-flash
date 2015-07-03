<%
Dim sDestintatario, sAsunto, sMensaje
Dim oMail	'el objeto CDO
sDestinatario="prueba09@edmultimedia.net"
sAsunto="CONTACTO"
sMensaje=""
sMensaje = sMensaje + "<style type='text/css'>.titulo { font-family: Trebuchet MS, tahoma, arial, sanserif; font-size:12px; font-weight:bold; color:#9974a5 } \n .label { font-family: Trebuchet MS, tahoma, arial, sanserif; font-size:11px; color:#9974a5 } \n .datos { font-family: Trebuchet MS, tahoma, arial, sanserif; font-size:11px; color:#383737; background-color:#F4F3F0; }</style>" + VbCrLf
sMensaje = sMensaje + "<table width=478 border=0 cellspacing=0 cellpadding=0>" + VbCrLf
sMensaje = sMensaje + "<tr><td colspan=2 align=center class='titulo' width=200>CONTACTO</td></tr><tr><td width=159></td><td width=319>&nbsp;</td></tr>" + VbCrLf
sMensaje = sMensaje + "<tr><td align=left class='label'>Nombre:</td><td class='datos' align=left>" + Request.Form("nombre") + "</td></tr><tr><td height=20></td></tr>" + VbCrLf
sMensaje = sMensaje + "<tr><td align=left class='label'>Email:</td><td class='datos' align=left>" + Request.Form("email") + "</td></tr><tr><td height=20></td></tr>" + VbCrLf
sMensaje = sMensaje + "<tr><td align=left class='label'>Message:</td><td class='datos' align=left>" + Request.Form("message") + "</td></tr><tr><td height=20></td></tr>" + VbCrLf
sMensaje = sMensaje + "</table>"
set oMail = server.createObject("Persits.MailSender")
oMail.host = "smtp.edmultimedia.net"
oMail.Subject = "CONTACTO"
oMail.From = "prueba09@edmultimedia.net"
oMail.addAddress sDestinatario
oMail.body = sMensaje
oMail.IsHTML = True
oMail.send
%>
