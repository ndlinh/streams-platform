<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Button;

use Anomaly\Streams\Platform\Ui\Button\ButtonRegistry;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class ButtonLookup
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class ButtonLookup
{

    /**
     * The button registry.
     *
     * @var ButtonRegistry
     */
    protected $buttons;

    /**
     * Create a new ButtonLookup instance.
     *
     * @param ButtonRegistry $buttons
     */
    public function __construct(ButtonRegistry $buttons)
    {
        $this->buttons = $buttons;
    }

    /**
     * Merge in registered properties.
     *
     * @param TreeBuilder $builder
     */
    public function merge(TreeBuilder $builder)
    {
        $buttons = $builder->getButtons();

        foreach ($buttons as &$parameters) {
            if ($button = $this->buttons->get(array_get($parameters, 'button'))) {
                $parameters = array_replace_recursive($button, $parameters);
            }
        }

        $builder->setButtons($buttons);
    }
}