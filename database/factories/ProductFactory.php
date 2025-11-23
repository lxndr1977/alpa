<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Gera nome único adicionando número aleatório
        $name = $this->faker->unique()->words(3, true) . ' ' . $this->faker->numberBetween(1000, 9999);
        
        return [
            'code' => strtoupper(Str::random(3)) . '-' . $this->faker->unique()->numerify('###'),
            'name' => ucfirst($name),
            'description' => $this->faker->paragraphs(3, true),
            'short_description' => $this->faker->sentence(15),
            'content_blocks' => $this->generateContentBlocks(),
            'is_active' => $this->faker->boolean(90), // Corrigido de is_active para active

            'slug' => Str::slug($name), // Slug único porque o nome é único
            'meta_title' => ucfirst($name),
            'meta_description' => $this->faker->sentence(20),
            'meta_keywords' => implode(', ', $this->faker->words(5)),
        ];
    }

    /**
     * Gera blocos de conteúdo de exemplo
     */
    protected function generateContentBlocks(): array
    {
        $blocks = [];
        
        // Número aleatório de blocos (1 a 4)
        $numBlocks = $this->faker->numberBetween(1, 4);
        
        $availableTypes = [
            'specifications',
            'benefits',
            'dimensions',
            'downloads',
            'faq',
            'free_text',
        ];
        
        // Embaralha e pega os tipos únicos
        $selectedTypes = $this->faker->randomElements($availableTypes, $numBlocks);
        
        foreach ($selectedTypes as $type) {
            $blocks[] = $this->generateBlockByType($type);
        }
        
        return $blocks;
    }

    /**
     * Gera conteúdo específico por tipo de bloco
     */
    protected function generateBlockByType(string $type): array
    {
        $titles = [
            'specifications' => 'Especificações Técnicas',
            'benefits' => 'Benefícios e Diferenciais',
            'dimensions' => 'Dimensões e Acabamentos',
            'downloads' => 'Documentação Técnica',
            'faq' => 'Perguntas Frequentes',
            'free_text' => 'Informações Adicionais',
        ];

        $baseBlock = [
            'type' => $type,
            'title' => $titles[$type],
            'visible' => $this->faker->boolean(90),
        ];

        return match($type) {
            'specifications' => array_merge($baseBlock, [
                'data' => [
                    'sections' => [
                        [
                            'section_title' => 'Características Gerais',
                            'fields' => [
                                'Material' => 'Alumínio 6063-T5',
                                'Norma' => 'ABNT NBR 6834',
                                'Tratamento' => 'Anodização',
                                'Acabamento' => 'Natural',
                            ],
                        ],
                        [
                            'section_title' => 'Dimensões',
                            'fields' => [
                                'Espessura' => $this->faker->randomElement(['0,5mm', '1,0mm', '1,5mm', '2,0mm']),
                                'Largura' => $this->faker->randomElement(['1000mm', '1220mm', '1500mm']),
                                'Comprimento' => $this->faker->randomElement(['2000mm', '2440mm', '3000mm']),
                            ],
                        ],
                    ],
                ],
            ]),

            'benefits' => array_merge($baseBlock, [
                'data' => [
                    'items' => array_map(function($i) {
                        $benefits = [
                            ['icon' => 'shield-check', 'title' => 'Alta Durabilidade', 'description' => 'Resistente à corrosão e intempéries'],
                            ['icon' => 'zap', 'title' => 'Leveza', 'description' => 'Material leve facilitando instalação'],
                            ['icon' => 'star', 'title' => 'Qualidade Premium', 'description' => 'Produto certificado e testado'],
                            ['icon' => 'leaf', 'title' => 'Sustentável', 'description' => '100% reciclável'],
                            ['icon' => 'clock', 'title' => 'Longa Vida Útil', 'description' => 'Mínimo de 20 anos de garantia'],
                        ];
                        return $this->faker->randomElement($benefits);
                    }, range(1, $this->faker->numberBetween(3, 5))),
                ],
            ]),

            'dimensions' => array_merge($baseBlock, [
                'data' => [
                    'available_dimensions' => implode("\n", [
                        '1000 x 2000mm',
                        '1220 x 2440mm',
                        '1500 x 3000mm',
                    ]),
                    'finishes' => implode("\n", [
                        'Anodizado Natural',
                        'Anodizado Bronze',
                        'Pintado Branco',
                        'Pintado Preto',
                        'Escovado',
                    ]),
                    'notes' => 'Dimensões e acabamentos customizados sob consulta.',
                ],
            ]),

            'downloads' => array_merge($baseBlock, [
                'data' => [
                    'files' => [
                        [
                            'name' => 'Catálogo Técnico ' . date('Y'),
                            'type' => 'catalog',
                            'file' => null,
                            'description' => 'Catálogo completo com todas as especificações técnicas',
                        ],
                        [
                            'name' => 'Ficha Técnica',
                            'type' => 'datasheet',
                            'file' => null,
                            'description' => 'Informações detalhadas do produto',
                        ],
                    ],
                ],
            ]),

            'faq' => array_merge($baseBlock, [
                'data' => [
                    'questions' => [
                        [
                            'question' => 'Qual a garantia do produto?',
                            'answer' => 'Oferecemos garantia de ' . $this->faker->numberBetween(5, 20) . ' anos contra defeitos de fabricação.',
                        ],
                        [
                            'question' => 'Como fazer a instalação?',
                            'answer' => 'Recomendamos instalação por profissional qualificado. Manual de instalação disponível para download.',
                        ],
                        [
                            'question' => 'É possível fazer sob medida?',
                            'answer' => 'Sim, trabalhamos com medidas customizadas. Entre em contato para orçamento.',
                        ],
                    ],
                ],
            ]),

            'free_text' => array_merge($baseBlock, [
                'data' => [
                    'content' => '<h2>Sobre o Produto</h2>' .
                        '<p>' . $this->faker->paragraph(5) . '</p>' .
                        '<h3>Aplicações</h3>' .
                        '<ul>' .
                        '<li>' . $this->faker->sentence() . '</li>' .
                        '<li>' . $this->faker->sentence() . '</li>' .
                        '<li>' . $this->faker->sentence() . '</li>' .
                        '</ul>',
                ],
            ]),

            default => $baseBlock,
        };
    }

    /**
     * Estado com blocos mínimos (apenas especificações)
     */
    public function minimal(): static
    {
        return $this->state(fn (array $attributes) => [
            'content_blocks' => [
                [
                    'type' => 'specifications',
                    'title' => 'Especificações Técnicas',
                    'visible' => true,
                    'data' => [
                        'sections' => [
                            [
                                'section_title' => 'Características Gerais',
                                'fields' => [
                                    'Material' => 'Alumínio',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Estado com todos os tipos de blocos
     */
    public function complete(): static
    {
        return $this->state(fn (array $attributes) => [
            'content_blocks' => [
                $this->generateBlockByType('specifications'),
                $this->generateBlockByType('benefits'),
                $this->generateBlockByType('dimensions'),
                $this->generateBlockByType('downloads'),
                $this->generateBlockByType('faq'),
                $this->generateBlockByType('free_text'),
            ],
        ]);
    }

    /**
     * Estado inativo
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Estado sem SEO
     */
    public function noSeo(): static
    {
        return $this->state(fn (array $attributes) => [
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
            'index' => false,
            'follow' => false,
        ]);
    }
}