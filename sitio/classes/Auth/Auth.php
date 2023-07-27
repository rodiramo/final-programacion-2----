<?php
namespace Classes\Auth;

use Classes\Models\User;

class Auth
{
	private ?User $user = null;

	public function login(string $email, string $password): bool
	{
		$user = (new User)->bringByEmail($email);

		if(!$user) return false;

		if(!password_verify($password, $user->getPassword())) return false;

		$this->authenticate($user);
		return true;
	}

	public function logout()
	{
		unset($_SESSION['user_id'], $SESSION['rol']);
	}


	public function authenticate(User $user)
	{
		$_SESSION['user_id'] = $user->getUserId();
		$_SESSION['rol'] = $user->getRolFk();
	}

	public function authenticated(): bool
	{
		return isset($_SESSION['user_id']);
	}

	
	public function admin(): bool
	{
		return $this->authenticated() && $_SESSION['rol'] === 1;
	}

	public function getUserId(): ?int
	{
		return $this->authenticated() ? $_SESSION['user_id'] : null;
	}

	public function getUser(): ?User
	{
		$id = $this->getUserId();
		
		if(!$id) return false;

		if(!$this->user) {
			$this->user = (new User)->bringById($id);
		}

		return $this->user;
	}
}