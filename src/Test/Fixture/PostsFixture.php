<?php

namespace App\Test\Fixture;

use Gourmet\Faker\TestSuite\Fixture\TestFixture;

class PostsFixture extends TestFixture {

    public $fields = [
        'id' => ['type' => 'integer'],
        'title' => ['type' => 'string', 'length' => 255, 'null' => false],
        'body' => 'text',
        'published' => ['type' => 'integer', 'default' => '0', 'null' => false],
        'created' => 'datetime',
        'updated' => 'datetime',
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
        ]
    ];

    public $records = [
        [
            'id' => 1,
            'title' => 'First Article',
            'body' => 'First Article Body',
            'published' => '1',
            'created' => '2007-03-18 10:39:23',
            'updated' => '2007-03-18 10:41:31'
        ],
        [
            'id' => 2,
            'title' => 'Second Article',
            'body' => 'Second Article Body',
            'published' => '1',
            'created' => '2007-03-18 10:41:23',
            'updated' => '2007-03-18 10:43:31'
        ],
        [
            'id' => 3,
            'title' => 'Third Article',
            'body' => 'Third Article Body',
            'published' => '1',
            'created' => '2007-03-18 10:43:23',
            'updated' => '2007-03-18 10:45:31'
        ]
    ];

    public $number = 20;
    public $guessers = ['\Faker\Guesser\Name'];

    public function init() {
        $this->customColumnFormatters = [
            'id' => function () { return $this->faker->numberBetween(count($this->records) + 2); },
            'published' => function () { return rand(0,3); }
        ];
        parent::init();
    }
}