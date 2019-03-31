<?php

include_once "core/mysql.php";

function do_auth($login, $passwd)
{
	$con = connect();
	$query = "SELECT id, login, rank FROM users WHERE login=? AND passwd=?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		$hash = hash('whirlpool', $passwd);
		mysqli_stmt_bind_param($stmt, "ss", $login, $hash);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		if (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) === NULL)
			return (FALSE);
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
		return $row;
	}
	else
		return FALSE;
}

function do_register($login, $passwd, $rank = 'user')
{
	$con = connect();
	$query = "INSERT INTO users (login, passwd, `rank`) VALUES (?, ?, ?)";
	if ($stmt = mysqli_prepare($con, $query))
	{
		$hash = hash('whirlpool', $passwd);
		mysqli_stmt_bind_param($stmt, "sss", $login, $hash, $rank);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return TRUE;
	}
	else
		return FALSE;
}

?>
