<section class="body-sign">
    <div class="center-sign">
        <?php
            echo $this->Html->link(
                //'<h2>Safra&nbsp;<small>consultoria</small></h2>',
                '<img src="img/logo-planilha-bg.png" height="54" alt="logo" />',
                ['controller' => 'pages', 'action' => 'index'],
                ['escape' => false, 'class' => 'logo pull-left', 'title' => '']
            );
        ?>
        <!-- <a href="/" class="logo pull-left">
            <img src="/assets/images/logo.png" height="54" alt="logo" />
            <h2>Safra&nbsp;<small>consultoria</small></h2>
        </a> -->

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Acesso Restrito</h2>
            </div>

            <div class="panel-body">

                <?= $this->Flash->render() ?>

                <?php $this->Form->setTemplates(['inputContainer' => '{{content}}','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

                <?= $this->Form->create() ?>
                    <div class="form-group mb-lg">
                        <label>E-mail</label>
                        <div class="input-group input-group-icon">
                            <?= $this->Form->control('email', ['class' => 'form-control input-lg', 'label' => false]) ?>
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-user"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-lg">
                        <div class="clearfix">
                            <label class="pull-left">Senha</label>
                            <!-- <a href="pages-recover-password.html" class="pull-right">Lost Password?</a> -->
                        </div>
                        <div class="input-group input-group-icon">
                            <?= $this->Form->control('password', ['empty' => false, 'required' => true, 'class' => 'form-control input-lg', 'label' => false]) ?>
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary hidden-xs"><?=__('Login')?></button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg"><?=__('Login')?></button>
                        </div>
                    </div>

                <?= $this->Form->end() ?>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">
            <?= $this->Html->image('/img/responsive-icon-100.png', ['alt' => 'Responsive Design', 'title' => 'Design Responsivo']); ?>
        </p>
    </div>
</section>