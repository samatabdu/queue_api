<?php

namespace App\Validation;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class QueueValidation
{
    #[Assert\NotBlank(message: "Item field is required")]
    #[Assert\Type(type: "string", message: "Item must be a string")]
    private ?string $item;

    private bool $isValid = true;
    private array $errors = [];

    public function __construct(array $item, ValidatorInterface $validator)
    {
        $this->item = $item['item'] ?? null;
        $this->validate($validator);
    }

    public function getItem(): ?string
    {
        return $this->item;
    }

    public function validate(ValidatorInterface $validator): void
    {
        $errors = $validator->validate($this);

        if (count($errors) > 0) {
            $this->isValid = false;
            $this->errors = $this->formatErrors($errors);
        }
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function formatErrors($errors): array
    {
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[$error->getPropertyPath()] = $error->getMessage();
        }
        return $errorMessages;
    }
}