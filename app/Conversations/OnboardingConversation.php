<?php
namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class OnboardingConversation extends Conversation
{
    protected $name;

    public function askName()
    {
        $this->ask('Hello! What is your name?', function(Answer $answer) {
            // Save the user's name
            $this->name = $answer->getText();

            $this->reply('Nice to meet you, ' . $this->name);

            // Proceed to the next question
            $this->askPurpose();
        });
    }

    public function askPurpose()
    {
        $this->ask('How can I assist you today?', function(Answer $answer) {
            // Process the user's response
            $purpose = $answer->getText();
            $this->say('You said: ' . $purpose);

            // Continue the conversation or handle the purpose
        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askName();
    }
}
