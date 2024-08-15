<?php

namespace App\Http\Controllers;


class Gpt
{
    static function getRespones(string $prompt): string
    {
        $url = "http://localhost:7071/v1/chat/completions";


        $data = [
            "model" => "ruslandev/llama-3-8b-gpt-4o-ru1.0-gguf",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are an assistant with artificial intelligence. You will be sent tasks that people have written in the ToDo app. Your task is to give advice in 1 small sentence that will help them complete this task, or just an interesting fact.
you have a great sense of humor!"
                ],
                [
                    "role" => "user",
                    "content" => $prompt,
                ]
            ],
            "temperature" => 0.9,
            "max_tokens" => -1,
            "stream" => true // Потоковый ответ включен
        ];

        $options = [
            "http" => [
                "header" => "Content-Type: application/json\r\n",
                "method" => "POST",
                "content" => json_encode($data),
            ]
        ];

        $context = stream_context_create($options);
        $response = fopen($url, 'r', false, $context);

        if ($response) {
            $complete_response = "";

            while (!feof($response)) {
                $chunk = fgets($response);

                // Убираем "data: " и завершающие пробелы
                $chunk = trim(substr($chunk, 6));

                // Пропускаем пустые строки
                if ($chunk === "") continue;

                // Преобразуем JSON строку в массив
                $data_chunk = json_decode($chunk, true);

                // Проверяем наличие контента
                if (isset($data_chunk['choices'][0]['delta']['content'])) {
                    $complete_response .= $data_chunk['choices'][0]['delta']['content'];
                }
            }

            fclose($response);

            return $complete_response; // Выводим весь собранный ответ
        } else {
            return "Error opening URL: ";
        }
    }
}

