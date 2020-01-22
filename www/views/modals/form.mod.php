<?php
// Contient le formulaire.
print_r($data);
?>

<form
method="<? $data['config']['method'] ?>"
action="<? $data['config']['action'] ?>"
class="<? $data['config']['class'] ?>"
id="<? $data['config']['id'] ?>"
>
    <?php foreach ($data['fields'] as $name => $configField) :?>
        <div class="col-sm-12">

            <?php if($configField['type'] == 'captcha') ?>
                <!-- code dynamic form -->
            <?php  ?>

            <input  type = "<?= $configField['type']  ?>"
                    name = "<?= $name ?>"
                    placeholder = "<?= $configField['placeholder'] ??  ''  ?>"
                    class = "<?= $configField['class'] ??  ''  ?>"
                    id = "<?= $configField['id'] ??  ''  ?>"
                    <?php ($configField['required']) ? "required = 'required'" : '' ?>
                    value = "<?= (( !empty($dataSubmit[$name] )  ) ) ?>"
            >

        </div>
    <?php endforeach;?>

    <button><? $data['config']['submit'] ?></button>
</form>