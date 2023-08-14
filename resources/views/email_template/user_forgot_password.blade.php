<html>

<head>
	<title>Welcome to Masterstroke</title>
</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #455560; color:#3c4e5a;padding:5px 10px;">
		<tr>
			<td align="left" valign="middle">Hello {{ $user['name'] }}</td>
		</tr>
		<tr>
			<td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="middle">You have requested a password for the account {{ $user['email'] }} </td>
		</tr>
		<tr>
			<td align="left" valign="middle">&nbsp;</td>
		</tr>		
		
		<tr>
			<td align="left" valign="middle">Please follow the link to reset your password <?= $user['urlParam'] ?>

			</td>
		</tr>
		<tr>
			<td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="middle">Best regards,</td>
		</tr>
		<tr>
			<td>Your masterstroke team</td>
		</tr>

	</table>
</body>

</html>