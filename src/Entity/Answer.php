<?php
// src/Entity/Answer.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $text;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $correctAnswer = false;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCorrectAnswer(): ?bool
    {
        return $this->correctAnswer;
    }

    public function setCorrectAnswer(bool $correctAnswer): self
    {
        $this->correctAnswer = $correctAnswer;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
