<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   

        $habits = [
            "Acordar cedo",
            "Praticar exercícios físicos",
            "Ler diariamente",
            "Beber bastante água",
            "Manter uma alimentação equilibrada",
            "Planejar o dia com antecedência",
            "Estabelecer metas realistas",
            "Evitar o uso excessivo de redes sociais",
            "Dormir bem",
            "Manter o ambiente limpo e organizado",
            "Ser pontual",
            "Economizar dinheiro",
            "Praticar a gratidão",
            "Desenvolver habilidades constantemente",
            "Ouvir mais do que falar",
            "Evitar procrastinação",
            "Meditar ou praticar mindfulness",
            "Ajudar os outros sempre que possível",
            "Fazer pausas durante o trabalho",
            "Refletir sobre o dia antes de dormir"
        ];

        return [
            'user_id'=>User::factory(),
            'title'=>fake()->randomElement($habits)
        ];
    }
}
