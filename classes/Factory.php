<?php

namespace ILIAS\Plugins\NewExampleQuestion;

use ilQuestionFactory;
use ilNewExampleQuestionPlugin;

use ILIAS\UI\Implementation\Render\ComponentRenderer;
use ILIAS\UI\Implementation\Render\TemplateFactory;
use ILIAS\UI\Implementation\Render\JavaScriptBinding;
use ILIAS\UI\Implementation\Render\ImagePathResolver;
use ILIAS;
use ilQuestionBaseSettings;
use ilQuestionTypeSettings;
use ilQuestionSolution;
use ilQuestionSolutionHandler;
use ilQuestionGrader;

class Factory implements ilQuestionFactory
{
    protected $dic;
    protected ilNewExampleQuestionPlugin $plugin;


    public function __construct(ilNewExampleQuestionPlugin $plugin)
    {
        global $DIC;
        $this->dic = $DIC;
        $this->plugin = $plugin;
    }

    public function getTypeTag() : string
    {
        return 'NewExampleQuestion';
    }

    public function getTypeTranslation() : string
    {
        return $this->plugin->txt('new_example_question');
    }

    public function getTypeSettings(int $question_id) : ilQuestionTypeSettings
    {
        // dummy - no specific settings yet
        return new TypeSettings();
    }

    public function getBackendGrader(
        ilQuestionBaseSettings $base_settings,
        ilQuestionTypeSettings $type_settings) : ilQuestionGrader
    {
        return new BackendGrader($base_settings, $type_settings);
    }

    public function getSolutionHandler() : ilQuestionSolutionHandler
    {
        return new SolutionHandler();
    }

    public function getRenderer() : ComponentRenderer
    {
        return new Renderer(
            $this->dic['ui.factory'],
            $this->dic['ui.template_factory'],
            $this->dic['lng'],
            $this->dic["ui.javascript_binding"],
            $this->dic["refinery"],
            $this->dic["ui.pathresolver"]
        );
    }

    public function getInactivePresentation(
        ilQuestionBaseSettings $base_settings,
        ilQuestionTypeSettings $type_settings,
        ?ilQuestionSolution $solution,
        ?\ilQuestionTypeFeedback $feedback
    ) : ILIAS\UI\Component\Question\Presentation\Inactive {
        return new InactivePresentation(
            $base_settings,
            $type_settings,
            $solution,
            $feedback
        );
    }

}