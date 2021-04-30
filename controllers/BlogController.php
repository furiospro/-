<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:30
 */

namespace controllers;
use components\Auth;
use components\Controller;

use components\Request;
use models\Blog;

class BlogController extends Controller
{

    public function actionIndex() {

        $blogModel = new Blog();

        echo $this->renderWithLayout ('blog/index', [ 'articles' => $blogModel->getBlogsOrderedByViews() ]);

    }


    public function actionView( Request $request ) {

        $blogModel = new Blog();

        $id = (int) $request->getParams['id'];

        $article = $blogModel->getById( $id );

        $blogModel->updateById($id,[ 'views' => $article['views'] + 1 ]);

        echo $this->renderWithLayout ( 'blog/view', ['article' => $article]);
    }



    public function actionAdd( Request $request ) {

        if(!empty($request->postParams)) {

            $blogModel = new Blog();

            $blogModel->insert($request->postParams);

            $this->redirect('/blog');
        }

        echo $this->renderWithLayout ( 'blog/add');

    }

    public function actionEdit( Request $request ) {

        $blogModel = new Blog();

        $id = (int)$request->getParams['id'];

        if(!empty($request->postParams)) {

            $blogModel = new Blog();

            $blogModel->updateById($id,$request->postParams);

            $this->redirect('/blog');
        }

        echo $this->renderWithLayout ( 'blog/edit', ['article' => $blogModel->getById( $id )]);
    }

    public function actionDelete( Request $request ) {

        $id = (int)$request->getParams['id'];

        $blogModel = new Blog();

        $blogModel->deleteById($id);

        $this->redirect('/blog');

    }
}