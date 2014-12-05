<?php namespace Anomaly\Streams\Platform\Ui\Form;

use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\Events\DispatchableTrait;

class FormBuilder
{

    use CommanderTrait;
    use DispatchableTrait;

    protected $standardizerCommand = 'Anomaly\Streams\Platform\Ui\Form\Command\StandardizeInputCommand';

    protected $buildCommand = 'Anomaly\Streams\Platform\Ui\Form\Command\BuildFormCommand';

    protected $handleCommand = 'Anomaly\Streams\Platform\Ui\Form\Command\HandleFormCommand';

    protected $makeCommand = 'Anomaly\Streams\Platform\Ui\Form\Command\MakeFormCommand';

    protected $model = 'FooBarModel';

    protected $sections = [
        [
            'fields' => [
                'test',
                'test'
            ]
        ]
    ];

    protected $actions = [
        'save' => [
            'text' => 'Save',
        ]
    ];

    protected $buttons = [
        'edit' => 'Testing',
    ];

    protected $form;

    function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function build()
    {
        $this->execute($this->standardizerCommand, ['builder' => $this]);
        $this->execute($this->buildCommand, ['builder' => $this]);

        if (app('request')->isMethod('post')) {

            $this->execute($this->handleCommand, ['builder' => $this]);
        }
    }

    public function make()
    {
        $this->build();

        if ($this->form->getResponse() === null) {

            $this->execute($this->makeCommand, ['builder' => $this]);
        }
    }

    public function render()
    {
        $this->make();

        if ($this->form->getResponse() === null) {

            $content = $this->form->getContent();

            return view($this->form->getWrapper(), compact('content'));
        }

        return $this->form->getResponse();
    }

    public function getForm()
    {
        return $this->form;
    }

    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setSections(array $sections)
    {
        $this->sections = $sections;

        return $this;
    }

    public function getSections()
    {
        return $this->sections;
    }

    public function setActions(array $actions)
    {
        $this->actions = $actions;

        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function setButtons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    public function getButtons()
    {
        return $this->buttons;
    }
}
 