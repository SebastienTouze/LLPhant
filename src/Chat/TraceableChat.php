<?php

namespace LLPhant\Chat;

use LLPhant\Chat\FunctionInfo\FunctionInfo;
use LLPhant\Traces\ChatTrace;
use Psr\Http\Message\StreamInterface;

abstract class TraceableChat implements ChatInterface {

    /** @var ChatTrace[] $traces  */
    private array $traces;

    public function __construct(private readonly ChatInterface $chat) { }

    /**
     * @return ChatTrace[]
     */
    public function getTraces(): array {
        return $this->traces;
    }

    public abstract function saveTraces(): void;

    public function generateText(string $prompt): string {
        $trace = (new ChatTrace())->setPrompt($prompt);
        $answer = $this->chat->generateText($prompt);
        $trace->setAnswer($answer);
        $this->traces[] = $trace;

        return $answer;
    }

    public function generateTextOrReturnFunctionCalled(string $prompt): string|FunctionInfo {
        return $this->chat->generateTextOrReturnFunctionCalled($prompt);
    }

    public function generateStreamOfText(string $prompt): StreamInterface {
        return $this->chat->generateStreamOfText($prompt);
    }

    /**
     * @inheritDoc
     */
    public function generateChat(array $messages): string {
        return $this->chat->generateChat($messages);
    }

    /**
     * @inheritDoc
     */
    public function generateChatStream(array $messages): StreamInterface {
        return $this->chat->generateChatStream($messages);
    }

    public function setSystemMessage(string $message): void {
        $this->chat->setSystemMessage($message);
    }

    /**
     * @inheritDoc
     */
    public function setTools(array $tools): void {
        $this->chat->setTools($tools);
    }

    public function addTool(FunctionInfo $functionInfo): void {
        $this->addTool($functionInfo);
    }

    /**
     * @inheritDoc
     */
    public function setFunctions(array $functions): void {
        $this->setFunctions($functions);
    }

    public function addFunction(FunctionInfo $functionInfo): void {
        $this->chat->addFunction($functionInfo);
    }

    public function setModelOption(string $option, mixed $value): void {
        $this->chat->setModelOption($option, $value);
    }
}
