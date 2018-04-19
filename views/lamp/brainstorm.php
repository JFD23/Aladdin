<? if ($brainstorm->parent) : ?>
    <a href="<?= PluginEngine::getLink($plugin, array(), "lamp/brainstorm/".$brainstorm->parent->getId()) ?>" class="parent_brainstorm">
        <div class="title"><?= htmlReady($brainstorm->parent->title) ?></div>
        <div class="body">
            <?= formatReady($brainstorm->parent->text) ?>
        </div>
    </a>
<? else : ?>
    <a href="<?= PluginEngine::getLink($plugin, array(), "lamp/index") ?>">
        <?= Icon::create("arr_1up", "clickable")->asImg(20, array("class" => "text-bottom")) ?>
        <?= _("Zur �bersicht") ?>
    </a>
<? endif ?>
<div class='brainstorm'>
    <div class="brainstorm_body">
        <? if ($brainstorm->title) : ?>
            <h1><?= htmlReady($brainstorm->title) ?></h1>
        <? endif ?>
        <div class="body">
            <?= formatReady($brainstorm->text) ?>
        </div>
        <? if ($GLOBALS['perm']->have_studip_perm("tutor", $_SESSION['SessionSeminar']) || $GLOBALS['user']->id === $brainstorm['user_id']) : ?>
            <a class="edit" href="<?= PluginEngine::getLink($plugin, array(), "lamp/edit/".$brainstorm->getId()) ?>" data-dialog>
                <?= Icon::create("edit", "clickable")->asImg(20) ?>
            </a>
            <a class="delete" href="<?= PluginEngine::getLink($plugin, array(), "lamp/delete/".$brainstorm->getId()) ?>" onClick="return window.confirm('<?= _("Wirklich l�schen?") ?>');">
                <?= Icon::create("trash", "clickable")->asImg(20) ?>
            </a>
        <? endif ?>
    </div>

    <hr style="display: block; border: 0px; height: 2px; background-color: #dddddd; width: 50%; margin: 30px; margin-left: auto; margin-right: auto;">

    <?= $this->render_partial("lamp/_subbrainstorms.php") ?>

    <? if (!$brainstorm['closed']) : ?>
        <form class='default' method='post' action="<?= $controller->url_for('lamp/edit') ?>" onSubmit="STUDIP.Aladdin.postBrainstorm.call(this); return false;">
            <?= CSRFProtection::tokenTag() ?>
            <input type="hidden" name="range_id" value="<?= $brainstorm->getId() ?>">
            <textarea type='text' name='brainstorm[text]' rows='0' cols='30' placeholder="Brainstorming ..."></textarea>
            <?= \Studip\Button::create(_('Absenden'), 'create') ?>
        </form>
    <? endif ?>
</div>