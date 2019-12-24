<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswersRepository")
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumn(name="questions_id_id", referencedColumnName = "id",nullable=false)
     */
    private $question_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_true;

    /**
     * @ORM\Column(type="text")
     */
    private $answers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionId(): ?Question
    {
        return $this->question_id;
    }

    public function setQuestionId(?Question $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function isTrue(): ?bool
    {
        return $this->is_true;
    }

    public function setIsTrue(bool $is_true): self
    {
        $this->is_true = $is_true;

        return $this;
    }

    public function getAnswers(): ?string
    {
        return $this->answers;
    }

    public function setAnswers(string $answers): self
    {
        $this->answers = $answers;
        $a = [];
        $r = rand(1, 10);
        $a = array_fill(1,$r, 7);
        $cal = count($a,[7]);
        $result = array_count_values($a);



        return $this;
    }

}