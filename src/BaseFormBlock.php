<?php

namespace trk\uikit;

use Yii;
use luya\cms\base\PhpBlock;
use luya\cms\helpers\BlockHelper;
use trk\uikit\blockgroups\FormGroup;
use trk\uikit\helpers\ArrayHelper;
use luya\helpers\Url;
use luya\helpers\Html;

/**
 * Base Form block
 *
 * The BaseFormBlock helps to allocate the view files for the blocks without using an alias.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
abstract class BaseFormBlock extends PhpBlock
{
    /**
     * @inheritdoc
     */
    protected $request;

    /**
     * @inheritdoc
     */
    protected $hasError = false;

    /**
     * @inheritdoc
     */
    protected $fields = [];

    /**
     * @inheritdoc
     */
    protected $labels = [];

    /**
     * @inheritdoc
     */
    protected $required = [];

    /**
     * @inheritdoc
     */
    protected $validations = [];

    /**
     * @inheritdoc
     */
    protected $rules = [];

    /**
     * @inheritdoc
     */
    public $cacheEnabled = false;

    /**
     * Initialize
     */
    public function init() {
        $this->request = Yii::$app->request;
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function blockGroup()
    {
        return FormGroup::class;
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function addLabel($field = "", $label = "") {
        if($field && $label) {
            $this->labels[$field] = $label;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function addRequired($field = "", $required = true) {
        if($field) {
            $this->required[$field] = $required;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function addValidatior($field = "", $validator = "") {
        if($field && $validator) {
            $this->validations[$field] = $validator;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function addRule($field = "", $rule = []) {
        if($field && !empty($rule)) {
            $this->rules[$field] = $rule;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function config()
    {
        return [
            'vars' => [
                ['var' => 'emailAddress', 'label' => Module::t('block.form.email_address'), 'type' => self::TYPE_TEXT],
                ['var' => 'sendToResponder', 'label' => Module::t('block.form.email_to_sender'), 'type' => self::TYPE_CHECKBOX],
                ['var' => 'style', 'label' => Module::t('block.form.style'), 'type' => self::TYPE_SELECT, 'options' => [
                    ['value' => '', 'label' => Module::t('block.form.none')],
                    ['value' => 'stacked', 'label' => Module::t('block.form.stacked')],
                    ['value' => 'horizontal', 'label' => Module::t('block.form.horizontal')]
                ]]
            ],
        ];
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function extraVars()
    {
        $response = $this->getPostResponse();
        return array_merge([
            'csrf' => $this->request->csrfToken,
            'mailerResponse' => $response
        ], $this->buildFieldsData($response));
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function getPostResponse()
    {
        if ($this->request->isPost) {
            $data = $this->buildFieldsData();
            if(!$this->hasError) {
                return $this->sendMail($data['fields']);
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Build fields rules, values, validations
     *
     * @return array
     */
    protected function buildFieldsData($response = "") {
        $data = [
            'fields' => []
        ];
        foreach ($this->fields as $field => $type) {

            $required = in_array($field, $this->required) ? true : false;
            $validator = ArrayHelper::element($field, $this->validations, "");
            $value = $this->request->isPost ? $this->request->post($field) : '';

            $label = ArrayHelper::element($field, $this->labels, "");
            $baseLabel = Yii::t('app', $label);
            $label = $baseLabel == $label ? Module::t('block.form.label.' . $field) : $baseLabel;

            $data['fields'][$field] = [
                'type' => $type,
                'label' => $label,
                'value' => $value
            ];

            if($required && $this->request->isPost) {
                $flag = !$value ? 0 : 1;
                if($validator) {
                    $validator = ucfirst($validator);
                    $namespaces = [
                        'yii',
                        'validators',
                        $validator . 'Validator'
                    ];
                    $validator = implode('\\', $namespaces);
                    if(class_exists($validator)) {
                        $validator = new $validator();
                        if(!$validator->validate($value, $error)) $flag = 0;
                    }
                }
                if($flag == 0) $this->hasError = true;
                $data[$field] = $response == 'success' ? '' : $value;
                $data[$field . 'ErrorFlag'] = $flag;
            } else {
                $data[$field . 'ErrorFlag'] = 1;
            }
        }

        return $data;
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function sendMail(array $fields = [])
    {
        $mail = Yii::$app->mail;

        $html = "<p>" . Module::t('block.form.mail.body') . "</p>";
        $html .= "<p>" . Module::t('block.form.mail.website') . Url::base(true) . "</p>";
        if($this->name()) $html .= "<p>" . Module::t('block.form.mail.form_name') . '<b>' . $this->name() . '</b></p>';
        $html .= "<p>" . Module::t('block.form.mail.submission_time') . date("d.m.Y - H:i") . "</p>";

        $responderEmail = "";
        $responderName = "";
        foreach ($fields as $name => $data) {
            switch ($data['type']) {
                case 'email':
                    $html .= "<p>" . $data["label"] . ": " . Html::encode($data["value"]) . "</p>";
                    $responderEmail = Html::encode($data["value"]);
                    break;
                case 'textarea':
                    $html.= "<p>" . $data["label"] . "<br/>" . nl2br(Html::encode($data["value"])) . "</p>";
                    break;
                default:
                    $html.= "<p>" . $data["label"] . ": " . Html::encode($data["value"]) . "<p>";
                    if($name == "name") {
                        $responderName = $responderName ? Html::encode($data["value"]) . " " . $responderName : Html::encode($data["value"]);
                    }
                    if($name == "surname") {
                        $responderName = $responderName ? $responderName . " " . Html::encode($data["value"]) : Html::encode($data["value"]);
                    }
                    break;
            }
        }

        $mail->compose(Module::t('block.form.mail.subject'), $html);
        $mail->address($this->getVarValue('emailAddress'));
        if($this->getVarValue('sendToResponder') && $responderEmail) {
            $mail->address($responderEmail, $responderName);
        }
        if (!$mail->send()) {
            return 'Error: '.$mail->error;
        } else {
            return 'success';
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getVarValue('emailAddress')) {
            return parent::frontend($params);
        } else {
            return "";
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function admin()
    {
        if($output = $this->frontend()) {
            return $output;
        } else {
            return '<div><span class="block__empty-text">' . Module::t('block.form.no_content') . '</span></div>';
        }
    }

    /**
     * @inheritdoc
     */
    public function getViewPath()
    {
        return  dirname(__DIR__) . '/src/views/blocks';
    }
}