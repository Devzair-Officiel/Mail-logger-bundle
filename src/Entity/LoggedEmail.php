<?php

declare(strict_types=1);

namespace DevZair\MailLoggerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="email_logs")
 */
class LoggedEmail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(name="`from`", type="json")
     * @Assert\NotBlank
     */
    private array $from = [];

    /**
     * @ORM\Column(name="`to`", type="json")
     * @Assert\NotBlank
     */
    private array $to = [];

    /**
     * @ORM\Column(name="`cc`", type="json", nullable=true)
     */
    private ?array $cc = [];

    /**
     * @ORM\Column(name="`bcc`", type="json", nullable=true)
     */
    private ?array $bcc = [];

    /**
     * @ORM\Column(name="`reply_to`", type="json", nullable=true)
     */
    private ?array $replyTo = [];

    /**
     * @ORM\Column(name="`return_path`", type="string", length=255, nullable=true)
     */
    private ?string $returnPath = null;

    /**
     * @ORM\Column(name="`subject`", type="string", length=255, nullable=true)
     */
    private ?string $subject = null;

    /**
     * @ORM\Column(name="`body`", type="text")
     * @Assert\NotBlank
     */
    private string $body;

    /**
     * @ORM\Column(name="`sent_at`", type="datetime")
     */
    private \DateTimeInterface $sentAt;

    /**
     * @ORM\Column(name="`result`", type="string", length=127)
     * @Assert\Choice({"success", "failed"})
     */
    private string $result;

    /**
     * @ORM\Column(name="`failed_recipients`", type="json", nullable=true)
     */
    private ?array $failedRecipients = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrom(): array
    {
        return $this->from;
    }

    public function setFrom(array $from): self
    {
        $this->from = $from;
        return $this;
    }

    public function getTo(): array
    {
        return $this->to;
    }

    public function setTo(array $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function getCc(): ?array
    {
        return $this->cc;
    }

    public function setCc(?array $cc): self
    {
        $this->cc = $cc;
        return $this;
    }

    public function getBcc(): ?array
    {
        return $this->bcc;
    }

    public function setBcc(?array $bcc): self
    {
        $this->bcc = $bcc;
        return $this;
    }

    public function getReplyTo(): ?array
    {
        return $this->replyTo;
    }

    public function setReplyTo(?array $replyTo): self
    {
        $this->replyTo = $replyTo;
        return $this;
    }

    public function getReturnPath(): ?string
    {
        return $this->returnPath;
    }

    public function setReturnPath(?string $returnPath): self
    {
        $this->returnPath = $returnPath;
        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function getSentAt(): \DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;
        return $this;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function setResult(string $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function getFailedRecipients(): ?array
    {
        return $this->failedRecipients;
    }

    public function setFailedRecipients(?array $failedRecipients): self
    {
        $this->failedRecipients = $failedRecipients;
        return $this;
    }
}
