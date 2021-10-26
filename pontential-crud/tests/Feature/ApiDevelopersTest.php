<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiDevelopersTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $dados = [];
    private $baseUrl;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();

        $this->baseUrl = "/api/developers/";
        $this->dados = [
            "nome" => $this->faker->name,
            "idade" => $this->faker->numberBetween(0, 70),
            "sexo" => 'M',
            "hobby" => $this->faker->text,
            "dataNascimento" => $this->faker->date
        ];
    }

    public function testListarDesenvolvedores()
    {
        $this->get($this->baseUrl)
            ->assertStatus(200)
            ->json();
    }

    public function testeSalvarDesenvolvedor()
    {
        $this->post($this->baseUrl, $this->dados)
            ->assertStatus(201);

        $this->get($this->baseUrl)
            ->assertSee($this->dados);
    }

    public function testeVisualizarDesenvolvedorCadastrado()
    {
        $this->post($this->baseUrl, $this->dados);
        $this->get($this->baseUrl)->assertSee($this->dados);
        $this->get("{$this->baseUrl}?nome={$this->dados['nome']}")->assertSee($this->dados);
    }

    public function testDeletarDesevolvedor()
    {
        $this->post($this->baseUrl, $this->dados);

        $request = $this->get("{$this->baseUrl}?nome={$this->dados['nome']}")->json('data');
        $desenvolvedor = (object)$request["0"];

        $this->delete($this->baseUrl . "" . $desenvolvedor->id)
            ->assertStatus(204);

        $this->get("{$this->baseUrl}?nome={$this->dados['nome']}")
            ->assertDontSee($this->dados);
    }

    public function testAtualizarInformacaoDesenvolvedor()
    {
        $this->post($this->baseUrl, $this->dados);
        $request = $this->get("{$this->baseUrl}?nome={$this->dados['nome']}")->json('data');
        $desenvolvedor = (object)$request["0"];

        $updateDev = [
            "nome" => $this->faker->name,
            "idade" => $this->faker->numberBetween(0, 70),
            "sexo" => 'M',
            "hobby" => $this->faker->text,
            "dataNascimento" => $this->faker->date
        ];

        $this->put($this->baseUrl . $desenvolvedor->id, $updateDev)
            ->assertSee($updateDev)
            ->assertStatus(200)
            ->assertJson($updateDev);
    }

    public function testErroPostSemInformacaoStore()
    {
        $this->post($this->baseUrl, [])
            ->assertStatus(400);
    }

    public function testErroDesenvolverNaoEncontradoUpdate()
    {
        $this->put($this->baseUrl . "999999", [])
            ->assertStatus(404)
            ->assertExactJson([
                "Erro" => "desenvolvedor não encontrado"
            ]);
    }

    public function testErroDesenvolvedorIdInvalidoShow()
    {
        $this->get($this->baseUrl . "aaa")
            ->assertStatus(400)
            ->assertExactJson([
                "Erro" => "o código do desenvolvedor é inválido"
            ]);
    }

    public function testErroDesenolvedorNaoEncontradoShow()
    {
        $this->get($this->baseUrl . random_int(0, 10000))
            ->assertStatus(404)
            ->assertExactJson([
                "Erro" => "desenvolvedor não encontrado"
            ]);
    }

    public function testErroDesenvolvedorIdInvalidoDestroy()
    {
        $this->delete($this->baseUrl . "aaa")
            ->assertStatus(400)
            ->assertExactJson([
                "Erro" => "o código do desenvolvedor é inválido"
            ]);
    }

    public function testErroDesenolvedorNaoEncontradoDestroy()
    {
        $this->delete($this->baseUrl . random_int(0, 10000))
            ->assertStatus(404)
            ->assertExactJson([
                "Erro" => "desenvolvedor não encontrado"
            ]);
    }
}
