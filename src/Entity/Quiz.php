<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 */
class Quiz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quiz;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="quiz_id", cascade = {"persist"})
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuiz(): ?string
    {
        return $this->quiz;
    }

    public function setQuiz(string $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuizId($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getQuizId() === $this) {
                $question->setQuizId(null);
            }
        }

        return $this;
    }
}
