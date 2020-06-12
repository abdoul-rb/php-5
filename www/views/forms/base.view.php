<form action="<?= $form->getConfig()['action'] ?>" method="<?= $form->getConfig()['method'] ?>" name="<?= $form->getName()?>">
    <?php foreach ($form->getConfig()['attr'] as $attr => $value) {
        echo "$attr = '$value'";
    } ?>
    <?php if($form->isValid()) {
        foreach ($form->getErrors() as $key => $errorsPerField) {
            foreach ($errorsPerField as $error) {
                echo "Erreur : $error <br>";
            }
        }
        }
        echo '<br><br>';
    ?>
    <?php foreach ($form->getElements() as $key => $field): ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <?php if($field->getType() == 'submit'): ?>
                    <button <?php if (isset($field->getOptions()['attr'])) {
                        foreach ($form->getOptions()['attr'] as $attr => $value) {
                            echo "$attr = '$value'";
                        }
                    } ?> ><?= $field->getOptions()['label'] ?? '' ?></button>
                <?php endif; ?>
                <?php if($field->getType() == 'text'): ?>
                    <label <?php if (isset($field->getOptions()['attr_label'])) {
                        foreach ($form->getOptions()['attr_label'] as $attr => $value) {
                            echo "$attr = '$value'";
                        }
                    } ?> ><?= $field->getOptions()['label'] ?? '' ?><br><br></label>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</form>