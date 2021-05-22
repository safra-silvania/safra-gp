<div class="modal fade" tabindex="-1" role="dialog" id="sessionTimeoutModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Sua sessão expirou</h4>
        </div>
        <div class="modal-body">
            <?= $this->Flash->render() ?>

            <?php $this->Form->setTemplates(['inputContainer' => '{{content}}','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

            <?= $this->Form->create(null, ['id' => 'form-session-timeout']) ?>

            <div class="current-user text-center">
              <img id="LockUserPicture" src="data:image/png;base64,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" alt="<?=$myself->name?>" class="img-circle user-image" width="100">
              <h2 id="LockUserName" class="user-name text-dark m-none"><?=$myself->name?></h2>
              <p id="LockUserEmail" class="user-email m-none"><?=$myself->email?></p>
            </div>

                <?= $this->Form->hidden('email', ['value' => $myself->email, 'label' => false]) ?>
                <br />

                <div class="form-group mb-lg">
                    <div class="clearfix">
                        <label class="pull-left">Senha</label>
                    </div>
                    <div class="input-group input-group-icon">
                        <?= $this->Form->control('password', ['empty' => false, 'required' => true, 'class' => 'form-control input-lg', 'label' => false, 'autocomplete'=>'off']) ?>
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
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Logar</button>
        </div> -->
        </div>
    </div>
</div>