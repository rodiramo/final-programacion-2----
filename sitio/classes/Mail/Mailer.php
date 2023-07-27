<?php
namespace Classes\Mail;

use PHPMailer\PHPMailer\PHPMailer;


class Mailer
{
	private PHPMailer $mailer;

	public function __construct()
	{
		$this->mailer = new PHPMailer(true);
	}

	public function useMailHog(): self
	{
		$this->mailer->isSMTP();
	    $this->mailer->Host       = '127.0.0.1';
	    $this->mailer->Port       = 1025;

		return $this;
	}

	public function useMailtrap(): self
	{
		$this->mailer->isSMTP();
		$this->mailer->Host = 'smtp.mailtrap.io';
		$this->mailer->SMTPAuth = true;
		$this->mailer->Port = 2525;
		// No olviden cambiar estas credenciales por las de su cuenta.
		$this->mailer->Username = 'fc9f733a9d9127';
		$this->mailer->Password = '5a92dec24e188d';

		return $this;
	}

	public function setFrom(string $from, string $name = ''): self
	{
		$this->mailer->setFrom($from, $name);

		return $this;
	}

	public function addAddress(string $email, string $name = ''): self
	{
		$this->mailer->addAddress($email, $name);

		return $this;
	}

	public function loadHTMLAsBody(string $filepath, array $data): self
	{
		$contenido = file_get_contents($filepath);

		foreach($data as $key => $value) {
			$contenido = str_replace($key, $value, $contenido);
		}

		$this->mailer->Body = $contenido;

		return $this;
	}

	public function setTextBody(string $content, bool $alt = true): self
	{
		if($alt) {
			$this->mailer->AltBody = $content;
		} else {
			$this->mailer->Body = $content;
		}

		return $this;
	}

	public function setSubject(string $subject): self
	{
		$this->mailer->Subject = $subject;

		return $this;
	}

	public function send()
	{
		$this->mailer->send();
	}

	public function getMailer(): PHPMailer
	{
		return $this->mailer;
	}
}