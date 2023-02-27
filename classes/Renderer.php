<?php

namespace ILIAS\Plugins\NewExampleQuestion;

use ILIAS\UI\Implementation\Render\AbstractComponentRenderer;
use ILIAS\UI\Component\Component;
use ilComponentFactory;
use ilUtil;
use ILIAS\DI\Container;
use ilLegacyFormElementsUtil;

class Renderer extends AbstractComponentRenderer
{
    /** @var Container */
    protected $dic;

    /** @var \ilNewExampleQuestionPlugin */
    protected $plugin;

    protected function loadPluginDependencies()
    {
        global $DIC;
        $this->dic = $DIC;

        /** @var ilComponentFactory $component_factory */
        $component_factory = $DIC['component.factory'];
        $this->plugin = $component_factory->getPlugin('nexmqst');
    }

    protected function getComponentInterfaceName() : array
    {
        return [
            InactivePresentation::class
        ];

    }

    public function render(Component $component, \ILIAS\UI\Renderer $default_renderer) : string
    {
        $this->loadPluginDependencies();

        if ($component instanceof InactivePresentation) {
            return $this->renderInactive($component, $default_renderer);
        }
        return $default_renderer->render($component);
    }

    public function renderInactive(InactivePresentation $component, \ILIAS\UI\Renderer $default_renderer) : string
    {
        $template = $this->plugin->getTemplate("tpl.il_as_qpl_nexmqst_output_solution.html");

        /** @var TypeFeedback $feedback */
        $feedback = $component->getFeedback();
        $settings = $component->getBaseSettings();

        if (isset($feedback)) {
            // output of ok/not ok icons for user entered solutions
            // in this example we have ony one relevant input field (points)
            // so we just need to set the icon beneath this field
            // question types with partial answers may have a more complex output
            if ($feedback->isPointsOk())
            {
                $template->setCurrentBlock("icon_ok");
                $template->setVariable("ICON_OK", ilUtil::getImagePath("icon_ok.svg"));
                $template->setVariable("TEXT_OK", $this->dic->language()->txt("answer_is_right"));
                $template->parseCurrentBlock();
            }
            else
            {
                $template->setCurrentBlock("icon_ok");
                $template->setVariable("ICON_NOT_OK", ilUtil::getImagePath("icon_not_ok.svg"));
                $template->setVariable("TEXT_NOT_OK", $this->dic->language()->txt("answer_is_wrong"));
                $template->parseCurrentBlock();
            }
        }

        if (!empty($solution = $component->getSolution())) {

            $value1 = null;
            $value2 = null;

            foreach ($solution->toValuePairs() as $pair) {
                $value1 = $pair->getValue1();
                $value2 = $pair->getValue2();
            }
            $template->setVariable("LABEL_VALUE1", $this->plugin->txt('label_value1'));
            $template->setVariable("LABEL_VALUE2", $this->plugin->txt('label_value2'));

            $template->setVariable("VALUE1", empty($value1) ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : ilLegacyFormElementsUtil::prepareFormOutput($value1));
            $template->setVariable("VALUE2", empty($value2) ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : ilLegacyFormElementsUtil::prepareFormOutput($value2));
        }


        if (!empty($settings->getQuestion())) {
            $template->setVariable("QUESTIONTEXT", ilLegacyFormElementsUtil::prepareTextareaOutput($settings->getQuestion(), TRUE));
        }

        return $template->get();
    }
}