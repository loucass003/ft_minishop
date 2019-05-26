<?php 

include_once "models/auth.php";

function login($args)
{
	if ($_POST['submit'] == 'Connexion')
	{
		if ($user = do_auth($_POST['login'], $_POST['passwd']))
		{
			$_SESSION['user'] = $user;
			redirect('/home');
			return ;
		}
		$error = "Invalid credentials";
	}
	$GLOBALS['title'] = "HOME";
	include "views/auth/login.php";
}

function register($args)
{
	if ($_POST['submit'] == 'Inscription')
	{
		if (!$_POST['login'] || !$_POST['passwd'] || !$_POST['confirm'])
			$error = "Un des champs est vide !";
		if ($_POST['passwd'] != $_POST['confirm'])
			$error = "Les mots de passe ne correspondent pas !";
		if (!isset($error) && $reister = do_register($_POST['login'], $_POST['passwd']))
		{
			redirect('/auth/login');
			return ;
		}
		if (!$register)
			$error = "Impossible de creer le compte";
	}
	$GLOBALS['title'] = "HOME";
	include "views/auth/register.php";
}

function modif_pwd()
{
	if ($_POST['submit'] == 'Comfirm')
	{
		if (!$_POST['login'] || !$_POST['oldpasswd'] || !$_POST['confirm'] || !$_POST['newpasswd'])
			$error = "Un des champs est vide !";
		if ($_POST['newpasswd'] != $_POST['confirm'])
			$error = "Les mots de passe ne correspondent pas !";
		if ($user = do_auth($_POST['login'], $_POST['oldpasswd']))
		{
			if($modif = do_modif_pwd($_POST['login'], $_POST['oldpasswd'], $_POST['newpasswd']))
			{
				$_SESSION['user'] = NULL;
				message('Your password has changed!', 'Return to login', '/auth/login');
				return ;
			}
			else
				$error = "FAILED";
		}
		else
			$error = "Wrong old password!";
	}
	$GLOBALS['title'] = "HOME";
	include "views/auth/modif_pwd.php";
}

function logout($args)
{
	if (!isset($_SESSION['user']))
	{
		redirect('/home');
		return ;
	}
	$_SESSION['user'] = NULL;
	redirect('/home');
}

?>
