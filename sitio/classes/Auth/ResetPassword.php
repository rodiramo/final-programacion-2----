<?php
namespace Classes\Auth;

use DateTime;
use Exception;
use Classes\DB\DB;
use Classes\Mail\Mailer;
use Classes\Models\User;

class resetPassword
{
	private User $user;
	private string $token;
	private DateTime $expirationDate;

	/**
	 * data for reset password and sends email
	 */
	public function requestReset(User $user)
	{
		$this->user = $user;
		$this->token = $this->createToken();
		$this->expirationDate = $this->createExpirationDate();

		$this->deleteToken();
		$this->saveToken();
		$this->sendEmail();
	}

	/**
	 * token with random_bytes
	 */
	private function createToken(int $bytes = 32): string
	{
	
		return bin2hex(random_bytes($bytes));
	}

	/**
	 * expiration date
	 */
	private function createExpirationDate(): DateTime
	{

		$date = new DateTime;

		$date->modify('+1 hour');

		return $date;
	}

	/*
	 * saves Token to database
	 */
	private function saveToken()
	{
		$db = DB::getConexion();
		$query = "INSERT INTO reset_passwords (user_id, token, expiration_date) 
				VALUES (:user_id, :token, :expiration_date)";
		$stmt = $db->prepare($query);
		$stmt->execute([
			'user_id' 		    => $this->user->getUserId(),
			'token' 			=> $this->token,
			'expiration_date' 	=> $this->expirationDate->format('Y-m-d H:i:s'),
		]);
	}

	/**
	 * Send email
	 */
	private function sendEmail()
	{
		try {
						$mailer = new Mailer;
			$mailer
				->useMailHog()
				->setFrom('dontreply@blomma.com', 'Blomma Admin')
				->addAddress($this->user->getEmail())
				->setSubject('reset password :: Blomma')
				->loadHTMLAsBody($this->getMailHTMLTemplate(), [
					'@@EMAIL@@' => $this->user->getEmail(),
					'@@URL@@' => $this->getURL(),
				])
				->setTextBody($this->getMailBody())
				->send();
		} catch (Exception $e) {
			//we save a txt to see if it works
			$this->saveToFile($mailer->getMailer()->Body, '.html');
			$this->saveToFile($mailer->getMailer()->AltBody, '.txt');

			throw $e;
		}
	}

	private function getMailHTMLTemplate(): string
	{
		return __DIR__ . '/../../email/email-templates/reset-password.html';
	}

	private function getURL(): string
	{
		return 'http://localhost/diazramos_rocio/sitio/index.php?s=new-password&token=' . $this->token . '&email=' . $this->user->getEmail();
	}

	/**
	 * mail body html
	 */
	private function getMailBodyHTML(): string
	{
		$url = 'http://localhost/diazramos_rocio/sitio/index.php?s=new-password&token=' . $this->token . '&email=' . $this->user->getEmail();

		$template = __DIR__ . '/../../email/email-templates/reset-password.html';
		$content = file_get_contents($template);

		$content = str_replace('@@EMAIL@@', $this->user->getEmail(), $content);
		$content = str_replace('@@URL@@', $url, $content);

		return $content;
	}

	/**
	 * prepares mail body.
	 */
	private function getMailBody(): string
	{
		$url = 'http://localhost/diazramos_rocio/sitio/index.php?s=new-password&token=' . $this->token . '&email=' . $this->user->getEmail();

		return 'Hi ' . $this->user->getEmail() . '

		We received a request for a new password, if that wasnt you please ignore this email

		To continue the process pleace click on the following link:

			' . $url . '
Greetings.
		';
	}

	/**
	 * txt
	 */
	private function saveToFile(string $content, string $extension = '.txt')
	{
		$filepath = __DIR__ . '/../../email/failed-emails/';
		$filename = $filepath . 'reset-password_' . $this->user->getEmail() . '_' . date('YmdHis') . $extension;
		file_put_contents($filename, $content);
	}

	/**
	 * checks if the token belongs to user
	 */
	public function validToken(string $token, user $user): bool
	{
		$this->token = $token;
		$this->user = $user;
		if($this->tokenBelongsUser() && $this->tokenIsCurrent()) {
			$this->deleteToken();
			return true;
		}

		return false;
	}

	/**
	 * deletes the token from the user 
	 */
	private function deleteToken()
	{
		$db = DB::getConexion();
		$query = "DELETE FROM reset_passwords 
				WHERE user_id = :user_id";
		$stmt = $db->prepare($query);
		$stmt->execute([
			'user_id' => $this->user->getUserId(),
		]);
	}

	/**
	 * checks if token belongs to user
	 */
	private function tokenBelongsUser(): bool
	{
		$db = DB::getConexion();
		$query = "SELECT * FROM reset_passwords 
				WHERE token = :token
				AND user_id = :user_id";
		$stmt = $db->prepare($query);
		$stmt->execute([
			'token' => $this->token,
			'user_id' => $this->user->getUserId(),
		]);

		$row = $stmt->fetch(\PDO::FETCH_ASSOC);

		if(!$row) return false;

		$this->expirationDate = new DateTime($row['expiration_date']);

		return true;
	}

	/**
	 * token is not expired
	 */
	private function tokenIsCurrent(): bool
	{
		
		$currentDate = new DateTime();

		if($this->expirationDate <= $currentDate) {
			$this->deleteToken();
			return false;
		}

		return true;
	}
}