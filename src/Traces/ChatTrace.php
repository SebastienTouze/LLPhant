<?php

namespace LLPhant\Traces;

class ChatTrace {

    private string $prompt;
    private string $answer;

    public function setPrompt(string $prompt): ChatTrace {
        $this->prompt = $prompt;
        return $this;
    }

    public function getPrompt(): string {
        return $this->prompt;
    }

    public function setAnswer(string $answer): ChatTrace {
        $this->answer = $answer;
        return $this;
    }

    public function getAnswer(): string {
        return $this->answer;
    }

}
