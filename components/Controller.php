<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:20
 */

namespace components;
abstract class Controller
{

    private $templateDir = 'skins/';
    private $templateExt = '.php';
    private $defaultLayout = 'header';

    public function render ($template, $params = [],$head=[])
    {

		extract($params);
		extract($head);

        $templateFile = App::getAppRootDir() . $this->templateDir . $template . $this->templateExt;

        if (file_exists($templateFile)) {
            ob_start();

            include $templateFile;

            $content = ob_get_clean();

           return $content;

        } else {

            echo "Страницы не существует, но вот вам котики 🐈🐈🐈🐈🐈";
            exit();
        }

    }

    public function renderWithLayout($template=[], $params = [],$head=[], $layout = null) {

        $content = $this->render($template, $params);

        $layout = empty($layout) ? $this->defaultLayout : $layout;

        return $this->render($layout , ['content' => $content,'head'=>$head]);
    }

    public function redirect($url){

        header('Location:' . $url);
        exit;
    }

}