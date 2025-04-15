<?php

namespace App\MailLoggerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'email_logs')]
class LoggedEmail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: '`from`', type: 'json')]
    #[Assert\NotBlank]
    private array $from = [];

    #[ORM\Column(name: '`to`', type: 'json')]
    #[Assert\NotBlank]
    private array $to = [];

    #[ORM\Column(name: '`cc`', type: 'json', nullable: true)]
    private ?array $cc = [];

    #[ORM\Column(name: '`bcc`', type: 'json', nullable: true)]
    private ?array $bcc = [];

    #[ORM\Column(name: '`reply_to`', type: 'json', nullable: true)]
    private ?array $replyTo = [];

    #[ORM\Column(name: '`return_path`', type: 'string', length: 255, nullable: true)]
    private ?string $returnPath = null;

    #[ORM\Column(name: '`subject`', type: 'string', length: 255, nullable: true)]
    private ?string $subject = null;

    #[ORM\Column(name: '`body`', type: 'text')]
    #[Assert\NotBlank]
    private string $body;

    #[ORM\Column(name: '`sent_at`', type: 'datetime')]
    private \DateTimeInterface $sentAt;

    #[ORM\Column(name: '`result`', type: 'string', length: 127)]
    #[Assert\Choice(['success', 'failed'])]
    private string $result;

    #[ORM\Column(name: '`failed_recipients`', type: 'json', nullable: true)]
    private ?array $failedRecipients = [];


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of from
     */ 
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the value of from
     *
     * @return  self
     */ 
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the value of to
     */ 
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to
     *
     * @return  self
     */ 
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get the value of cc
     */ 
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set the value of cc
     *
     * @return  self
     */ 
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get the value of bcc
     */ 
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Set the value of bcc
     *
     * @return  self
     */ 
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * Get the value of replyTo
     */ 
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * Set the value of replyTo
     *
     * @return  self
     */ 
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * Get the value of returnPath
     */ 
    public function getReturnPath()
    {
        return $this->returnPath;
    }

    /**
     * Set the value of returnPath
     *
     * @return  self
     */ 
    public function setReturnPath($returnPath)
    {
        $this->returnPath = $returnPath;

        return $this;
    }

    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of result
     */ 
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the value of result
     *
     * @return  self
     */ 
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get the value of failedRecipients
     */ 
    public function getFailedRecipients()
    {
        return $this->failedRecipients;
    }

    /**
     * Set the value of failedRecipients
     *
     * @return  self
     */ 
    public function setFailedRecipients($failedRecipients)
    {
        $this->failedRecipients = $failedRecipients;

        return $this;
    }

    /**
     * Get the value of sentAt
     */ 
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Set the value of sentAt
     *
     * @return  self
     */ 
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }
}
