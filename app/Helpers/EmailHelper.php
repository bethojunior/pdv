<?php


namespace App\Helpers;


class EmailHelper
{
    private $template;
    private $body;
    private $paramsView;

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return EmailHelper
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParamsView()
    {
        return $this->paramsView;
    }

    /**
     * @param mixed $paramsView
     * @return EmailHelper
     */
    public function setParamsView($paramsView)
    {
        $this->paramsView = $paramsView;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return EmailHelper
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

}
