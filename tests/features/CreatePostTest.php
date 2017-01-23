<?php

class CreatePostTest extends FeatureTestCase
{
    public function test_a_user_create_post()
    {
        // Having
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $user = $this->defaultUser();
        $this->actingAs($user);

        // When
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');

        // Then
        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
        ]);

        // Test a user is redirected to the posts details after creating it.
        $this->see($title);
    }

    public function test_creating_a_post_requires_authentication()
    {
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));
    }

    public function test_create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeErrors(([
                'title' => 'The title field is required',
                'content' => 'The content field is required',
            ]));
            //->seeInElement('#field_title.has-error .help-block', 'The title field is required')
            //->seeInElement('#field_content.has-error .help-block', 'The content field is required');
    }

}